@extends('layouts.dashboard')

@section('title', 'Decision Makers - SILOKASI')

@push('additional-styles')
<style>
    .user-profile {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.7rem 1.2rem;
        background: rgba(249, 195, 73, 0.05);
        border-radius: 50px;
        border: 1px solid rgba(249, 195, 73, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .user-profile:hover {
        background: rgba(249, 195, 73, 0.1);
        border-color: rgba(249, 195, 73, 0.4);
        transform: translateY(-2px);
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, #F9C349, #FFD700);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.2rem;
        color: #000;
    }

    .user-info h4 {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 0.2rem;
    }

    .user-info p {
        font-size: 0.8rem;
        color: #888;
    }

    .dm-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }

    .dm-card {
        background: rgba(20, 20, 20, 0.8);
        backdrop-filter: blur(20px);
        border-radius: 16px;
        border: 1px solid rgba(249, 195, 73, 0.15);
        padding: 2rem;
        transition: all 0.3s ease;
    }

    .dm-card:hover {
        transform: translateY(-5px);
        border-color: rgba(249, 195, 73, 0.3);
        box-shadow: 0 15px 40px rgba(249, 195, 73, 0.15);
    }

    .dm-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #F9C349, #FFD700);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 800;
        color: #000;
        margin: 0 auto 1rem;
    }

    .dm-info {
        text-align: center;
    }

    .dm-info h3 {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
    }

    .dm-info p {
        color: #888;
        font-size: 0.9rem;
        margin-bottom: 0.3rem;
    }

    .dm-badge {
        display: inline-block;
        padding: 0.3rem 0.8rem;
        background: rgba(249, 195, 73, 0.2);
        color: #F9C349;
        border-radius: 6px;
        font-size: 0.8rem;
        margin-top: 0.5rem;
    }

    .loading {
        text-align: center;
        padding: 3rem;
        color: #888;
    }

    @media (max-width: 768px) {
        .top-bar {
            flex-wrap: wrap;
            gap: 1rem;
        }

        .user-info {
            display: none;
        }

        .dm-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .page-title h1 {
            font-size: 1.3rem;
        }
    }
</style>
@endpush

@section('content')
<div class="top-bar">
    <button class="menu-toggle" id="menuToggle">☰</button>
    <div class="page-title">
        <h1>Decision Makers 👥</h1>
        <p>Para pembuat keputusan dalam sistem</p>
    </div>
    <div class="user-profile">
        <div class="user-avatar" id="userAvatar">A</div>
        <div class="user-info">
            <h4 id="userFullName">Admin User</h4>
            <p>Administrator</p>
        </div>
    </div>
</div>
<div class="dm-grid" id="dmGrid">
    <div class="loading">Memuat data decision makers...</div>
</div>
@endsection

@push('additional-scripts')
<script>
    const API_URL = 'http://localhost:8000/api';
    const dmGrid = document.getElementById('dmGrid');

    // Load User Data
    window.addEventListener('load', () => {
        const user = localStorage.getItem('user');
        if (user) {
            const userData = JSON.parse(user);
            document.getElementById('userFullName').textContent = userData.name;
            document.getElementById('userAvatar').textContent = userData.name.charAt(0).toUpperCase();
        }
    });

    async function fetchDecisionMakers() {
        try {
            const response = await fetch(`${API_URL}/me`);
            const result = await response.json();

            if (result.success && result.data) {
                renderDecisionMakers([result.data]);
            } else {
                dmGrid.innerHTML = '<p class="loading">Belum ada data decision makers</p>';
            }
        } catch (error) {
            console.error('Error:', error);
            dmGrid.innerHTML = '<p class="loading" style="color: #ff6b6b;">Terjadi kesalahan saat memuat data</p>';
        }
    }

    function renderDecisionMakers(data) {
        dmGrid.innerHTML = data.map((dm, index) => `
            <div class="dm-card">
                <div class="dm-avatar">${dm.name ? dm.name.charAt(0).toUpperCase() : 'DM'}</div>
                <div class="dm-info">
                    <h3>${dm.name || 'Decision Maker ' + (index + 1)}</h3>
                    <p>📧 ${dm.email || 'No email'}</p>
                    <p>🆔 ID: ${dm.id || index + 1}</p>
                    <span class="dm-badge">Active</span>
                </div>
            </div>
        `).join('');
    }

    fetchDecisionMakers();
</script>
@endpush
