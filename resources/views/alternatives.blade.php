<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alternatif - SILOKASI</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            color: #fff;
            overflow-x: hidden;
            min-height: 100vh;
        }

        .bg-decoration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .bg-decoration::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(249, 195, 73, 0.08) 0%, transparent 70%);
            top: -200px;
            right: -100px;
            border-radius: 50%;
            animation: float 25s ease-in-out infinite;
        }

        .bg-decoration::after {
            content: '';
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(218, 165, 32, 0.05) 0%, transparent 70%);
            bottom: -300px;
            left: -200px;
            border-radius: 50%;
            animation: float 30s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
        }

        .dashboard-layout {
            display: flex;
            position: relative;
            z-index: 1;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: rgba(15, 15, 15, 0.95);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(249, 195, 73, 0.15);
            padding: 2rem 0;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar-logo {
            padding: 0 2rem 2rem;
            border-bottom: 1px solid rgba(249, 195, 73, 0.1);
            margin-bottom: 2rem;
        }

        .logo-text {
            font-size: 1.8rem;
            font-weight: 900;
            letter-spacing: 2px;
            background: linear-gradient(135deg, #F9C349 0%, #FFD700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .logo-subtitle {
            font-size: 0.75rem;
            color: #888;
            letter-spacing: 1px;
            margin-top: 0.3rem;
        }

        .nav-menu {
            list-style: none;
            padding: 0 1rem;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-item.has-children .nav-parent {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 1rem;
            justify-content: space-between;
            /* reset default button look so it matches regular nav links when not hovered */
            background: transparent;
            border: none;
            color: inherit;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            text-align: left;
            font: inherit;
            border-radius: 12px; /* keep same radius as .nav-link */
        }

        /* keep visible keyboard focus without changing idle background */
        .nav-item.has-children .nav-parent:focus-visible {
            outline: 2px solid rgba(249, 195, 73, 0.6);
            outline-offset: 2px;
        }

        .chevron {
            margin-left: auto;
            transition: transform 0.25s ease;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .nav-item.open .chevron {
            transform: rotate(180deg);
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            color: #ccc;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #F9C349, #FFD700);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(249, 195, 73, 0.1);
            color: #F9C349;
            transform: translateX(5px);
        }

        .nav-link:hover::before {
            transform: scaleY(1);
        }

        .nav-link.active {
            background: rgba(249, 195, 73, 0.15);
            color: #F9C349;
            font-weight: 600;
        }

        .nav-link.active::before {
            transform: scaleY(1);
        }

        .nav-icon {
            font-size: 1.3rem;
            width: 24px;
            text-align: center;
        }

        /* Submenu */
        .submenu {
            list-style: none;
            padding: 0.3rem 0 0.4rem;
            margin: 0.2rem 0 0.4rem;
            display: none;
        }

        .nav-item.open > .submenu {
            display: block;
        }

        .submenu .nav-link {
            padding: 0.75rem 1.5rem 0.75rem 2.6rem; /* indent */
            background: transparent;
            color: #bbb;
        }

        .submenu .nav-link:hover {
            background: rgba(249, 195, 73, 0.08);
            color: #F9C349;
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .main-content.expanded {
            margin-left: 0;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
            padding: 1.5rem 2rem;
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            border: 1px solid rgba(249, 195, 73, 0.15);
        }

        .menu-toggle {
            display: none;
            background: rgba(249, 195, 73, 0.1);
            border: 1px solid rgba(249, 195, 73, 0.3);
            color: #F9C349;
            padding: 0.7rem 1rem;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.3rem;
            transition: all 0.3s ease;
        }

        .menu-toggle:hover {
            background: rgba(249, 195, 73, 0.2);
            transform: scale(1.05);
        }

        .page-title h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .page-title p {
            color: #888;
            font-size: 0.95rem;
        }

        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .search-box {
            flex: 1;
            min-width: 250px;
            max-width: 400px;
        }

        .search-box input {
            width: 100%;
            padding: 0.8rem 1.2rem 0.8rem 2.5rem;
            background: rgba(20, 20, 20, 0.8);
            border: 1px solid rgba(249, 195, 73, 0.15);
            border-radius: 10px;
            color: #fff;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: rgba(249, 195, 73, 0.4);
            box-shadow: 0 0 20px rgba(249, 195, 73, 0.1);
        }

        .btn-primary {
            padding: 0.8rem 1.5rem;
            background: linear-gradient(135deg, #F9C349, #FFD700);
            color: #000;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(249, 195, 73, 0.3);
        }

        .table-card {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            border: 1px solid rgba(249, 195, 73, 0.15);
            overflow: hidden;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: rgba(249, 195, 73, 0.1);
        }

        th {
            padding: 1.2rem 1.5rem;
            text-align: left;
            font-weight: 600;
            color: #F9C349;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr {
            border-bottom: 1px solid rgba(249, 195, 73, 0.1);
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: rgba(249, 195, 73, 0.05);
        }

        td {
            padding: 1.2rem 1.5rem;
            color: #ccc;
        }

        .badge {
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
        }

        .action-btns {
            display: flex;
            gap: 0.5rem;
        }

        .btn-icon {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-edit {
            background: rgba(0, 123, 255, 0.2);
            color: #4dabf7;
        }

        .btn-edit:hover {
            background: rgba(0, 123, 255, 0.3);
            transform: scale(1.1);
        }

        .btn-delete {
            background: rgba(220, 53, 69, 0.2);
            color: #ff6b6b;
        }

        .btn-delete:hover {
            background: rgba(220, 53, 69, 0.3);
            transform: scale(1.1);
        }

        .loading {
            text-align: center;
            padding: 3rem;
            color: #888;
        }

        .spinner {
            border: 3px solid rgba(249, 195, 73, 0.1);
            border-top: 3px solid #F9C349;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: rgba(20, 20, 20, 0.95);
            border: 1px solid rgba(249, 195, 73, 0.2);
            border-radius: 16px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .modal-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #F9C349;
        }

        .btn-close {
            background: none;
            border: none;
            color: #888;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-close:hover {
            color: #F9C349;
            transform: rotate(90deg);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #ccc;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem 1rem;
            background: rgba(30, 30, 30, 0.8);
            border: 1px solid rgba(249, 195, 73, 0.15);
            border-radius: 8px;
            color: #fff;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: rgba(249, 195, 73, 0.4);
            box-shadow: 0 0 20px rgba(249, 195, 73, 0.1);
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
        }

        .btn-secondary {
            padding: 0.8rem 1.5rem;
            background: rgba(100, 100, 100, 0.3);
            color: #ccc;
            border: 1px solid rgba(249, 195, 73, 0.15);
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(100, 100, 100, 0.5);
            border-color: rgba(249, 195, 73, 0.3);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }

            th, td {
                padding: 0.8rem;
                font-size: 0.85rem;
            }
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(20, 20, 20, 0.5);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(249, 195, 73, 0.3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(249, 195, 73, 0.5);
        }
    </style>
</head>
<body>
    <div class="bg-decoration"></div>

    <div class="dashboard-layout">
        <!-- Sidebar -->
        @include('components.sidebar')

        <main class="main-content" id="mainContent">
            <div class="top-bar">
                <button class="menu-toggle" id="menuToggle">☰</button>
                <div class="page-title">
                    <h1>Manajemen Alternatif 📍</h1>
                    <p>Kelola alternatif lokasi untuk evaluasi</p>
                </div>
            </div>

            <div class="action-bar">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="🔍 Cari alternatif...">
                </div>
                <button class="btn-primary" id="btnAdd">
                    <span>➕</span>
                    <span>Tambah Alternatif</span>
                </button>
            </div>

            <div class="table-card">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Lokasi</th>
                                <th>Kode</th>
                                <th>Alamat</th>
                                <th>Koordinat</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr>
                                <td colspan="7" class="loading">
                                    <div class="spinner"></div>
                                    <p>Memuat data...</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <div class="modal" id="alternativeModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Tambah Alternatif</h2>
                <button class="btn-close" id="btnCloseModal">×</button>
            </div>
            <form id="alternativeForm">
                <input type="hidden" id="alternativeId">
                
                <div class="form-group">
                    <label for="name">Nama Lokasi *</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="code">Kode *</label>
                    <input type="text" id="code" name="code" required placeholder="Contoh: A1">
                </div>

                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea id="address" name="address" rows="2" placeholder="Alamat lengkap lokasi..."></textarea>
                </div>

                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input type="number" id="latitude" name="latitude" step="0.000001" placeholder="-6.200000">
                </div>

                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input type="number" id="longitude" name="longitude" step="0.000001" placeholder="106.816666">
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" rows="3" placeholder="Deskripsi alternatif..."></textarea>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-secondary" id="btnCancel">Batal</button>
                    <button type="submit" class="btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const API_URL = 'http://localhost:8000/api';
        let alternativesData = [];

        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const btnAdd = document.getElementById('btnAdd');
        const alternativeModal = document.getElementById('alternativeModal');
        const btnCloseModal = document.getElementById('btnCloseModal');
        const btnCancel = document.getElementById('btnCancel');
        const alternativeForm = document.getElementById('alternativeForm');
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('expanded');
        });

        // Sidebar submenu toggle and active state
        (function initSidebar() {
            const parents = document.querySelectorAll('.nav-item.has-children .nav-parent');
            parents.forEach(btn => {
                btn.addEventListener('click', () => {
                    const item = btn.closest('.nav-item.has-children');
                    const isOpen = item.classList.toggle('open');
                    btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
            });

            // Active link highlight + auto-open parent
            const current = window.location.pathname.replace(/\/$/, ''); // trim trailing slash
            // mark exact match in submenu first
            let activeLink = document.querySelector(`.submenu a.nav-link[href='${current}'], .submenu a.nav-link[href='${current}/']`);
            if (!activeLink) {
                // try top-level
                activeLink = document.querySelector(`.nav-menu > .nav-item > a.nav-link[href='${current}'], .nav-menu > .nav-item > a.nav-link[href='${current}/']`);
            }

            if (activeLink) {
                activeLink.classList.add('active');
                const parentItem = activeLink.closest('.nav-item.has-children');
                if (parentItem) {
                    parentItem.classList.add('open');
                    const parentBtn = parentItem.querySelector('.nav-parent');
                    if (parentBtn) parentBtn.setAttribute('aria-expanded', 'true');
                }
            } else {
                // Default active for /alternatives
                if (current === '' || current === '/alternatives') {
                    const alternativesLink = document.querySelector("a.nav-link[href='/alternatives']");
                    if (alternativesLink) alternativesLink.classList.add('active');
                }
            }
        })();

        btnAdd.addEventListener('click', () => openModal());
        btnCloseModal.addEventListener('click', closeModal);
        btnCancel.addEventListener('click', closeModal);
        alternativeModal.addEventListener('click', (e) => {
            if (e.target === alternativeModal) closeModal();
        });

        function openModal(data = null) {
            if (data) {
                document.getElementById('modalTitle').textContent = 'Edit Alternatif';
                document.getElementById('alternativeId').value = data.id;
                document.getElementById('name').value = data.name;
                document.getElementById('code').value = data.code;
                document.getElementById('address').value = data.address || '';
                document.getElementById('latitude').value = data.latitude || '';
                document.getElementById('longitude').value = data.longitude || '';
                document.getElementById('description').value = data.description || '';
            } else {
                document.getElementById('modalTitle').textContent = 'Tambah Alternatif';
                alternativeForm.reset();
                document.getElementById('alternativeId').value = '';
            }
            alternativeModal.classList.add('active');
        }

        function closeModal() {
            alternativeModal.classList.remove('active');
            alternativeForm.reset();
        }

        async function fetchAlternatives() {
            try {
                const response = await fetch(`${API_URL}/alternatives`);
                const result = await response.json();
                
                if (result.success) {
                    alternativesData = result.data;
                    renderTable(alternativesData);
                } else {
                    showError('Gagal memuat data alternatif');
                }
            } catch (error) {
                console.error('Error fetching alternatives:', error);
                showError('Terjadi kesalahan saat memuat data');
            }
        }

        function renderTable(data) {
            if (data.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 3rem; color: #888;">
                            Belum ada data alternatif
                        </td>
                    </tr>
                `;
                return;
            }

            tableBody.innerHTML = data.map(item => `
                <tr>
                    <td>${item.id}</td>
                    <td><strong>${item.name}</strong></td>
                    <td><span class="badge" style="background: rgba(249, 195, 73, 0.2); color: #F9C349;">${item.code}</span></td>
                    <td>${item.address || '-'}</td>
                    <td>${item.latitude && item.longitude ? `${item.latitude}, ${item.longitude}` : '-'}</td>
                    <td>${item.description || '-'}</td>
                    <td>
                        <div class="action-btns">
                            <button class="btn-icon btn-edit" onclick="editAlternative(${item.id})">✏️</button>
                            <button class="btn-icon btn-delete" onclick="deleteAlternative(${item.id})">🗑️</button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            const filtered = alternativesData.filter(item => 
                item.name.toLowerCase().includes(searchTerm) ||
                item.code.toLowerCase().includes(searchTerm) ||
                (item.address && item.address.toLowerCase().includes(searchTerm))
            );
            renderTable(filtered);
        });

        alternativeForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const id = document.getElementById('alternativeId').value;
            const formData = {
                name: document.getElementById('name').value,
                code: document.getElementById('code').value,
                address: document.getElementById('address').value || null,
                latitude: document.getElementById('latitude').value || null,
                longitude: document.getElementById('longitude').value || null,
                description: document.getElementById('description').value || null
            };

            try {
                const url = id ? `${API_URL}/alternatives/${id}` : `${API_URL}/alternatives`;
                const method = id ? 'PUT' : 'POST';
                
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData)
                });

                const result = await response.json();

                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: id ? 'Alternatif berhasil diupdate!' : 'Alternatif berhasil ditambahkan!',
                        background: 'rgba(20, 20, 20, 0.95)',
                        color: '#fff',
                        timer: 1500
                    });
                    closeModal();
                    fetchAlternatives();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.message || 'Gagal menyimpan data',
                        background: 'rgba(20, 20, 20, 0.95)',
                        color: '#fff'
                    });
                }
            } catch (error) {
                console.error('Error saving alternative:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat menyimpan data',
                    background: 'rgba(20, 20, 20, 0.95)',
                    color: '#fff'
                });
            }
        });

        window.editAlternative = function(id) {
            const alternative = alternativesData.find(item => item.id === id);
            if (alternative) {
                openModal(alternative);
            }
        };

        window.deleteAlternative = async function(id) {
            const result = await Swal.fire({
                title: 'Hapus Alternatif?',
                text: 'Apakah Anda yakin ingin menghapus alternatif ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                background: 'rgba(20, 20, 20, 0.95)',
                color: '#fff',
                confirmButtonColor: '#d33'
            });
            
            if (!result.isConfirmed) {
                return;
            }

            try {
                const response = await fetch(`${API_URL}/alternatives/${id}`, {
                    method: 'DELETE'
                });

                const result = await response.json();

                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Terhapus!',
                        text: 'Alternatif berhasil dihapus!',
                        background: 'rgba(20, 20, 20, 0.95)',
                        color: '#fff',
                        timer: 1500
                    });
                    fetchAlternatives();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.message || 'Gagal menghapus data',
                        background: 'rgba(20, 20, 20, 0.95)',
                        color: '#fff'
                    });
                }
            } catch (error) {
                console.error('Error deleting alternative:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat menghapus data',
                    background: 'rgba(20, 20, 20, 0.95)',
                    color: '#fff'
                });
            }
        };

        function showError(message) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align: center; padding: 3rem; color: #ff6b6b;">
                        ⚠️ ${message}
                    </td>
                </tr>
            `;
        }

        fetchAlternatives();
    </script>
</body>
</html>
