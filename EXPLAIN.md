---

# Panduan Penggunaan API - ANP-Borda Group Decision Support System

## Base URL
```
http://localhost:8090/api
```

## Arsitektur Sistem

Sistem ini menggunakan 4 komponen utama:
1. **ANP (Analytic Network Process)** - Untuk menangani interdependensi antar kriteria dan menghitung bobot lokal alternatif
2. **Weighted Product (WP)** - Untuk menghitung skor akhir alternatif dengan formula perkalian berpangkat
3. **Borda Count Method** - Untuk agregasi preferensi dari multiple decision makers
4. **Laravel Sanctum** - Untuk autentikasi berbasis token

---

## Alur Pengambilan Keputusan

### **FASE 1: Autentikasi**

#### 1.1 Registrasi Decision Maker (DM)
**Endpoint:** `POST /api/register`

**Request Body:**
```json
{
  "name": "Decision Maker 1",
  "email": "dm1@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "role": "decision_maker"
}
```

**Response:**
```json
{
  "success": true,
  "message": "User registered successfully",
  "data": {
    "user": {
      "id": "9d5e8c77-1234-5678-9abc-def012345678",
      "name": "Decision Maker 1",
      "email": "dm1@example.com",
      "role": "decision_maker"
    },
    "token": "1|abcdefghijklmnopqrstuvwxyz123456"
  }
}
```

**Catatan:** Ulangi registrasi untuk DM2, DM3, dst. Simpan token masing-masing DM.

---

#### 1.2 Login
**Endpoint:** `POST /api/login`

**Request Body:**
```json
{
  "email": "dm1@example.com",
  "password": "password123"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": {
      "id": "9d5e8c77-1234-5678-9abc-def012345678",
      "name": "Decision Maker 1",
      "email": "dm1@example.com"
    },
    "token": "2|xyz987654321abcdefghijklmnop"
  }
}
```

**Header untuk request selanjutnya:**
```
Authorization: Bearer 2|xyz987654321abcdefghijklmnop
```

---

### **FASE 2: Perbandingan Kriteria**

#### 2.1 Input Pairwise Comparison Kriteria (Setiap DM)
**Endpoint:** `POST /api/criteria/comparisons`

**Header:**
```
Authorization: Bearer {token_dm1}
Content-Type: application/json
```

**Request Body (Contoh untuk 3 kriteria: Harga, Luas, Lokasi):**
```json
{
  "user_id": "9d5e8c77-1234-5678-9abc-def012345678",
  "comparisons": [
    {
      "criteria_a_id": 1,
      "criteria_b_id": 2,
      "value": 3,
      "depends_on_criteria_id": null
    },
    {
      "criteria_a_id": 1,
      "criteria_b_id": 3,
      "value": 5,
      "depends_on_criteria_id": null
    },
    {
      "criteria_a_id": 2,
      "criteria_b_id": 3,
      "value": 2,
      "depends_on_criteria_id": null
    },
    {
      "criteria_a_id": 2,
      "criteria_b_id": 1,
      "value": 7,
      "depends_on_criteria_id": 3
    }
  ]
}
```

**Penjelasan:**
- `value`: Skala 1-9 Saaty
  - 1 = Sama penting
  - 3 = Sedikit lebih penting
  - 5 = Lebih penting
  - 7 = Sangat lebih penting
  - 9 = Mutlak lebih penting
- `depends_on_criteria_id`: ID kriteria yang mempengaruhi (untuk interdependensi)
- Ulangi untuk setiap DM dengan token masing-masing

**Response:**
```json
{
  "success": true,
  "message": "Comparisons saved successfully",
  "data": {
    "user_id": "9d5e8c77-1234-5678-9abc-def012345678",
    "total_comparisons": 4
  }
}
```

---

#### 2.2 Hitung Bobot Kriteria (Setiap DM)
**Endpoint:** `POST /api/criteria/calculate-weights`

**Header:**
```
Authorization: Bearer {token_dm1}
```

**Request Body:**
```json
{
  "user_id": "9d5e8c77-1234-5678-9abc-def012345678"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Weights calculated successfully",
  "data": {
    "user_id": "9d5e8c77-1234-5678-9abc-def012345678",
    "weights": [
      {
        "criteria_id": 1,
        "criteria_name": "Harga",
        "weight": 0.5396,
        "consistency_ratio": 0.058
      },
      {
        "criteria_id": 2,
        "criteria_name": "Luas",
        "weight": 0.2970,
        "consistency_ratio": 0.058
      },
      {
        "criteria_id": 3,
        "criteria_name": "Lokasi",
        "weight": 0.1634,
        "consistency_ratio": 0.058
      }
    ],
    "is_consistent": true
  }
}
```

**Catatan:** CR (Consistency Ratio) harus ≤ 0.1 untuk konsisten.

---

#### 2.3 Agregasi Bobot Kriteria (Geometric Mean)
**Endpoint:** `GET /api/criteria/aggregated-weights`

**Header:**
```
Authorization: Bearer {token_any_dm}
```

**Response:**
```json
{
  "success": true,
  "message": "Aggregated weights calculated successfully",
  "data": {
    "aggregated_weights": [
      {
        "criteria_id": 1,
        "criteria_name": "Harga",
        "aggregated_weight": 0.5128
      },
      {
        "criteria_id": 2,
        "criteria_name": "Luas",
        "aggregated_weight": 0.3105
      },
      {
        "criteria_id": 3,
        "criteria_name": "Lokasi",
        "aggregated_weight": 0.1767
      }
    ],
    "total_decision_makers": 3
  }
}
```

---

### **FASE 3: Perbandingan Alternatif**

#### 3.1 Input Pairwise Comparison Alternatif (Setiap DM untuk Setiap Kriteria)
**Endpoint:** `POST /api/alternatives/comparisons`

**Header:**
```
Authorization: Bearer {token_dm1}
```

**Request Body (Contoh: Bandingkan 3 lokasi terhadap kriteria "Harga"):**
```json
{
  "user_id": "9d5e8c77-1234-5678-9abc-def012345678",
  "criteria_id": 1,
  "comparisons": [
    {
      "alternative_a_id": 1,
      "alternative_b_id": 2,
      "value": 4
    },
    {
      "alternative_a_id": 1,
      "alternative_b_id": 3,
      "value": 6
    },
    {
      "alternative_a_id": 2,
      "alternative_b_id": 3,
      "value": 3
    }
  ]
}
```

**Catatan:** 
- Ulangi untuk criteria_id = 2 (Luas), criteria_id = 3 (Lokasi)
- Ulangi untuk setiap DM

**Response:**
```json
{
  "success": true,
  "message": "Alternative comparisons saved successfully",
  "data": {
    "user_id": "9d5e8c77-1234-5678-9abc-def012345678",
    "criteria_id": 1,
    "total_comparisons": 3
  }
}
```

---

#### 3.2 Hitung Bobot Lokal Alternatif (Setiap DM)
**Endpoint:** `POST /api/alternatives/calculate-local-weights`

**Header:**
```
Authorization: Bearer {token_dm1}
```

**Request Body:**
```json
{
  "user_id": "9d5e8c77-1234-5678-9abc-def012345678",
  "criteria_id": 1
}
```

**Response:**
```json
{
  "success": true,
  "message": "Local weights calculated successfully",
  "data": {
    "user_id": "9d5e8c77-1234-5678-9abc-def012345678",
    "criteria_id": 1,
    "local_weights": [
      {
        "alternative_id": 1,
        "alternative_name": "Lokasi A",
        "local_weight": 0.6333,
        "consistency_ratio": 0.052
      },
      {
        "alternative_id": 2,
        "alternative_name": "Lokasi B",
        "local_weight": 0.2605,
        "consistency_ratio": 0.052
      },
      {
        "alternative_id": 3,
        "alternative_name": "Lokasi C",
        "local_weight": 0.1062,
        "consistency_ratio": 0.052
      }
    ],
    "is_consistent": true
  }
}
```

---

#### 3.3 Hitung Bobot Final ANP (Setiap DM)
**Endpoint:** `POST /api/alternatives/calculate-final-weights`

**Metode:** **Weighted Product (WP)**

**Formula:** 
```
S(Ai) = Π (rij ^ wj)
j=1 to n

dimana:
- S(Ai) = Score alternatif ke-i
- rij = Local weight alternatif i pada kriteria j
- wj = Weight kriteria j
- Π = Perkalian (product)
```

**Header:**
```
Authorization: Bearer {token_dm1}
```

**Request Body:**
```json
{
  "user_id": "9d5e8c77-1234-5678-9abc-def012345678"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Final weights calculated successfully using Weighted Product (WP) method",
  "data": {
    "user_id": "9d5e8c77-1234-5678-9abc-def012345678",
    "method": "Weighted Product (WP)",
    "final_weights": [
      {
        "alternative_id": 1,
        "alternative_name": "Lokasi A",
        "final_weight": 0.5847,
        "ranking": 1
      },
      {
        "alternative_id": 2,
        "alternative_name": "Lokasi B",
        "final_weight": 0.2789,
        "ranking": 2
      },
      {
        "alternative_id": 3,
        "alternative_name": "Lokasi C",
        "final_weight": 0.1364,
        "ranking": 3
      }
    ]
  }
}
```

**Catatan:** Final Weight = Π (Local Weight ^ Criteria Weight) untuk semua kriteria

---

### **FASE 4: Konsensus dengan Borda Count**

#### 4.1 Generate Ranking dari Setiap DM
**Endpoint:** `POST /api/consensus/generate-rankings`

**Header:**
```
Authorization: Bearer {token_any_dm}
```

**Request Body:**
```json
{
  "decision_makers": [
    "9d5e8c77-1234-5678-9abc-def012345678",
    "9d5e8c77-5678-1234-9abc-def012345679",
    "9d5e8c77-9abc-5678-1234-def012345680"
  ]
}
```

**Response:**
```json
{
  "success": true,
  "message": "Rankings generated successfully",
  "data": {
    "rankings": [
      {
        "user_id": "9d5e8c77-1234-5678-9abc-def012345678",
        "user_name": "Decision Maker 1",
        "rankings": [
          {
            "alternative_id": 1,
            "alternative_name": "Lokasi A",
            "rank": 1,
            "weight": 0.5847
          },
          {
            "alternative_id": 2,
            "alternative_name": "Lokasi B",
            "rank": 2,
            "weight": 0.2789
          },
          {
            "alternative_id": 3,
            "alternative_name": "Lokasi C",
            "rank": 3,
            "weight": 0.1364
          }
        ]
      }
    ]
  }
}
```

---

#### 4.2 Hitung Konsensus dengan Borda
**Endpoint:** `POST /api/consensus/calculate-borda`

**Header:**
```
Authorization: Bearer {token_any_dm}
```

**Request Body:**
```json
{
  "decision_makers": [
    "9d5e8c77-1234-5678-9abc-def012345678",
    "9d5e8c77-5678-1234-9abc-def012345679",
    "9d5e8c77-9abc-5678-1234-def012345680"
  ]
}
```

**Response:**
```json
{
  "success": true,
  "message": "Borda consensus calculated successfully",
  "data": {
    "consensus_ranking": [
      {
        "alternative_id": 1,
        "alternative_name": "Lokasi A",
        "borda_points": 9,
        "final_rank": 1,
        "average_rank": 1.0
      },
      {
        "alternative_id": 2,
        "alternative_name": "Lokasi B",
        "borda_points": 6,
        "final_rank": 2,
        "average_rank": 2.0
      },
      {
        "alternative_id": 3,
        "alternative_name": "Lokasi C",
        "borda_points": 3,
        "final_rank": 3,
        "average_rank": 3.0
      }
    ],
    "total_decision_makers": 3,
    "method": "borda_count"
  }
}
```

**Rumus Borda Points:** 
- Alternatif Rank 1 = (N - 1 + 1) = 3 poin × 3 DM = 9 poin
- Alternatif Rank 2 = (N - 2 + 1) = 2 poin × 3 DM = 6 poin
- Alternatif Rank 3 = (N - 3 + 1) = 1 poin × 3 DM = 3 poin

---

#### 4.3 Borda dengan Penanganan Ties (Opsional)
**Endpoint:** `POST /api/consensus/calculate-borda-with-ties`

**Header:**
```
Authorization: Bearer {token_any_dm}
```

**Request Body:**
```json
{
  "decision_makers": [
    "9d5e8c77-1234-5678-9abc-def012345678",
    "9d5e8c77-5678-1234-9abc-def012345679",
    "9d5e8c77-9abc-5678-1234-def012345680"
  ],
  "tie_handling": "average"
}
```

**tie_handling options:**
- `average`: Rata-rata poin untuk ranking yang sama
- `sequential`: Berikan ranking berikutnya

**Response:**
```json
{
  "success": true,
  "message": "Borda consensus with tie handling calculated successfully",
  "data": {
    "consensus_ranking": [
      {
        "alternative_id": 1,
        "alternative_name": "Lokasi A",
        "borda_points": 9,
        "final_rank": 1
      },
      {
        "alternative_id": 2,
        "alternative_name": "Lokasi B",
        "borda_points": 6,
        "final_rank": 2
      },
      {
        "alternative_id": 3,
        "alternative_name": "Lokasi C",
        "borda_points": 3,
        "final_rank": 3
      }
    ],
    "tie_handling_method": "average"
  }
}
```

---

#### 4.4 Dapatkan Hasil Konsensus Final
**Endpoint:** `GET /api/consensus/results`

**Header:**
```
Authorization: Bearer {token_any_dm}
```

**Response:**
```json
{
  "success": true,
  "message": "Consensus results retrieved successfully",
  "data": {
    "final_decision": {
      "winner": {
        "alternative_id": 1,
        "alternative_name": "Lokasi A",
        "borda_points": 9,
        "final_rank": 1
      },
      "complete_ranking": [
        {
          "alternative_id": 1,
          "alternative_name": "Lokasi A",
          "borda_points": 9,
          "final_rank": 1
        },
        {
          "alternative_id": 2,
          "alternative_name": "Lokasi B",
          "borda_points": 6,
          "final_rank": 2
        },
        {
          "alternative_id": 3,
          "alternative_name": "Lokasi C",
          "borda_points": 3,
          "final_rank": 3
        }
      ]
    },
    "total_decision_makers": 3,
    "timestamp": "2025-11-09T10:30:45.000000Z"
  }
}
```

---

## Endpoint Tambahan

### Lihat Profil User
**Endpoint:** `GET /api/me`

**Header:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": "9d5e8c77-1234-5678-9abc-def012345678",
    "name": "Decision Maker 1",
    "email": "dm1@example.com",
    "role": "decision_maker"
  }
}
```

---

### Logout
**Endpoint:** `POST /api/logout`

**Header:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
  "success": true,
  "message": "Logged out successfully"
}
```

---

### Refresh Token
**Endpoint:** `POST /api/refresh-token`

**Header:**
```
Authorization: Bearer {old_token}
```

**Response:**
```json
{
  "success": true,
  "message": "Token refreshed successfully",
  "data": {
    "token": "3|newtoken123456789abcdefgh"
  }
}
```

---

### Revoke All Tokens
**Endpoint:** `POST /api/revoke-all-tokens`

**Header:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
  "success": true,
  "message": "All tokens revoked successfully"
}
```

---

## Workflow Lengkap (Contoh 3 DM, 3 Kriteria, 3 Alternatif)

```
1. Register 3 Decision Makers (DM1, DM2, DM3)
   ↓
2. Login setiap DM → Simpan token

UNTUK SETIAP DM (3 kali):
3. Input perbandingan kriteria → POST /api/criteria/comparisons
   ↓
4. Hitung bobot kriteria → POST /api/criteria/calculate-weights
   ↓
5. Input perbandingan alternatif untuk Kriteria 1 → POST /api/alternatives/comparisons
   ↓
6. Input perbandingan alternatif untuk Kriteria 2 → POST /api/alternatives/comparisons
   ↓
7. Input perbandingan alternatif untuk Kriteria 3 → POST /api/alternatives/comparisons
   ↓
8. Hitung bobot lokal alternatif → POST /api/alternatives/calculate-local-weights
   ↓
9. Hitung bobot final ANP → POST /api/alternatives/calculate-final-weights

KONSENSUS:
10. Generate rankings dari semua DM → POST /api/consensus/generate-rankings
    ↓
11. Hitung Borda consensus → POST /api/consensus/calculate-borda
    ↓
12. Dapatkan hasil final → GET /api/consensus/results
```

---

## Testing dengan Postman/cURL

### Contoh cURL - Register
```bash
curl -X POST http://localhost:8090/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Decision Maker 1",
    "email": "dm1@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "role": "decision_maker"
  }'
```

### Contoh cURL - Login
```bash
curl -X POST http://localhost:8090/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "dm1@example.com",
    "password": "password123"
  }'
```

### Contoh cURL - Input Criteria Comparison
```bash
curl -X POST http://localhost:8090/api/criteria/comparisons \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "user_id": "9d5e8c77-1234-5678-9abc-def012345678",
    "comparisons": [
      {
        "criteria_a_id": 1,
        "criteria_b_id": 2,
        "value": 3,
        "depends_on_criteria_id": null
      }
    ]
  }'
```

---

## Error Handling

### Common Error Responses

**401 Unauthorized:**
```json
{
  "message": "Unauthenticated."
}
```
**Solusi:** Login ulang atau refresh token

**422 Validation Error:**
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": ["The email field is required."]
  }
}
```
**Solusi:** Perbaiki request body sesuai validasi

**500 Server Error:**
```json
{
  "success": false,
  "message": "Consistency ratio exceeds threshold",
  "data": {
    "cr": 0.15,
    "threshold": 0.1
  }
}
```
**Solusi:** Revisi perbandingan berpasangan agar konsisten

---

## Catatan Penting

1. **Consistency Ratio (CR):** Harus ≤ 0.1. Jika CR > 0.1, ulangi pairwise comparison.

2. **Interdependensi:** Gunakan `depends_on_criteria_id` untuk menunjukkan bahwa satu kriteria mempengaruhi kriteria lain (misalnya: Harga dipengaruhi oleh Luas).

3. **Skala Saaty:** Gunakan nilai 1, 3, 5, 7, 9 atau nilai tengah (2, 4, 6, 8) untuk perbandingan.

4. **Token Security:** Simpan token dengan aman. Token expired setelah waktu tertentu (default Laravel Sanctum).

5. **Multiple DM:** Setiap decision maker harus melakukan langkah 3-9 secara independen dengan token masing-masing.

6. **Borda Count:** Metode ini cocok untuk agregasi preferensi dari multiple experts tanpa bias terhadap satu DM tertentu.

---

## Referensi Algoritma

### ANP (Analytic Network Process)
- Saaty, T.L. (1996). *Decision Making with Dependence and Feedback: The Analytic Network Process*

### Borda Count Method
- Emerson, P. (2013). *The Original Borda Count and Partial Voting*

### Consistency Index (CI)
- CI = (λmax - n) / (n - 1)
- CR = CI / RI
- RI (Random Index) tergantung jumlah kriteria (n=3: RI=0.58, n=4: RI=0.90, dst.)

---

**Last Updated:** November 9, 2025  
**API Version:** 1.0  
**Framework:** Laravel 12 + Sanctum Authentication