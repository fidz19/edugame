<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Saya - Portal Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: white;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #4B8BF4 0%, #3B7DE0 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
        }

        .brand-name {
            font-weight: 700;
            font-size: 1.25rem;
            color: #1e293b;
        }

        .brand-subtitle {
            font-size: 0.7rem;
            color: #4B8BF4;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            padding: 1rem 0;
            flex: 1;
        }

        .nav-item {
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .nav-item:hover {
            background: #f8fafc;
            color: #1e293b;
        }

        .nav-item.active {
            background: #EBF3FF;
            color: #4B8BF4;
            border-left-color: #4B8BF4;
        }

        .nav-icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #f0f0f0;
        }



        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            min-width: 40px;
            min-height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            flex-shrink: 0;
            aspect-ratio: 1;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: #1e293b;
        }

        .user-email {
            font-size: 0.75rem;
            color: #64748b;
        }

        .btn-logout {
            width: 100%;
            margin-top: 0.75rem;
            padding: 0.5rem 1rem;
            background: #fee2e2;
            color: #dc2626;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-logout:hover {
            background: #fecaca;
            color: #b91c1c;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 1.5rem 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .search-box {
            position: relative;
            width: 350px;
        }

        .search-box input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.9rem;
            background: white;
            transition: all 0.2s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: #4B8BF4;
            box-shadow: 0 0 0 3px rgba(75, 139, 244, 0.1);
        }

        .search-box .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .header-btn:hover {
            background: #f1f5f9;
            color: #1e293b;
        }

        .page-title-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 0.95rem;
        }

        .btn-create-game {
            background: linear-gradient(135deg, #4B8BF4 0%, #3B7DE0 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-create-game:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(75, 139, 244, 0.3);
            color: white;
        }

        /* Tabs */
        .tabs-container {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .tab-item {
            padding: 0.75rem 1.25rem;
            color: #64748b;
            font-weight: 500;
            text-decoration: none;
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
            transition: all 0.2s ease;
        }

        .tab-item:hover {
            color: #1e293b;
        }

        .tab-item.active {
            color: #4B8BF4;
            border-bottom-color: #4B8BF4;
        }

        /* Games Grid */
        .games-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .game-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .game-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .game-thumbnail {
            height: 160px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .game-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .game-thumbnail-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            opacity: 0.9;
        }

        .game-thumbnail-icon {
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }

        .game-thumbnail-text {
            font-weight: 700;
            font-size: 1.25rem;
        }

        .game-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.35rem 0.75rem;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-published {
            background: #4B8BF4;
            color: white;
        }

        .badge-draft {
            background: #FF9A5C;
            color: white;
        }

        .badge-inactive {
            background: #94a3b8;
            color: white;
        }

        .game-content {
            padding: 1.25rem;
        }

        .game-category {
            font-size: 0.75rem;
            font-weight: 600;
            color: #4B8BF4;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .game-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.75rem;
        }

        .game-stats {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #64748b;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }

        .game-stat {
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .game-actions {
            display: flex;
            gap: 0.75rem;
        }

        .btn-action {
            flex: 1;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background: #1e293b;
            color: white;
        }

        .btn-edit:hover {
            background: #334155;
            color: white;
        }

        .btn-results {
            background: white;
            color: #4B8BF4;
            border: 2px solid #4B8BF4;
        }

        .btn-results:hover {
            background: #EBF3FF;
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-delete:hover {
            background: #fecaca;
        }

        /* New Activity Card */
        .new-activity-card {
            background: white;
            border: 2px dashed #d1d5db;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            min-height: 280px;
        }

        .new-activity-card:hover {
            border-color: #4B8BF4;
            background: #f8fafc;
        }

        .new-activity-icon {
            width: 50px;
            height: 50px;
            background: #f1f5f9;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .new-activity-title {
            font-weight: 600;
            font-size: 1rem;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .new-activity-subtitle {
            font-size: 0.85rem;
            color: #64748b;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #64748b;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        /* Alert */
        .alert-container {
            margin-bottom: 1.5rem;
        }

        .alert {
            border-radius: 12px;
            border: none;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                width: 80px;
            }

            .sidebar-brand .brand-text,
            .nav-item span,
            .sidebar-footer .pro-card,
            .sidebar-footer .user-info {
                display: none;
            }

            .sidebar-brand {
                justify-content: center;
                padding: 1rem;
            }

            .nav-item {
                justify-content: center;
                padding: 1rem;
            }

            .user-profile {
                justify-content: center;
            }

            .main-content {
                margin-left: 80px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                flex-direction: row;
                padding: 0.5rem 1rem;
            }

            .sidebar-nav {
                display: flex;
                padding: 0;
            }

            .nav-item {
                padding: 0.5rem 1rem;
            }

            .sidebar-footer {
                display: none;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            body {
                flex-direction: column;
            }

            .page-title-section {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .search-box {
                width: 100%;
            }

            .games-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">📚</div>
            <div class="brand-text">
                <div class="brand-name">EduPlay</div>
                <div class="brand-subtitle">Portal Guru</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('teacher.dashboard') }}" class="nav-item">
                <span class="nav-icon">📊</span>
                <span>Dasbor</span>
            </a>
            <a href="{{ route('teacher.classes') }}" class="nav-item">
                <span class="nav-icon">👥</span>
                <span>Kelas</span>
            </a>
            <a href="{{ route('teacher.games') }}" class="nav-item active">
                <span class="nav-icon">🎮</span>
                <span>Game</span>
            </a>
            <a href="{{ route('teacher.schedules') }}" class="nav-item">
                <span class="nav-icon">📈</span>
                <span>Jadwal</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile">
                <div class="user-avatar">{{ substr($teacher->name, 0, 1) }}</div>
                <div class="user-info">
                    <div class="user-name">{{ $teacher->name }}</div>
                    <div class="user-email">{{ $teacher->email ?? 'guru@sekolah.edu' }}</div>
                </div>
            </div>
            <a href="{{ route('teacher.logout') }}" class="btn-logout">
                🚪 Keluar
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="search-box">
                <span class="search-icon">🔍</span>
                <input type="text" id="searchInput" placeholder="Cari game Anda...">
            </div>
            <div class="header-actions">
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert-container">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert-container">
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Page Title -->
        <div class="page-title-section">
            <div>
                @if(isset($filterClass) && $filterClass)
                    <h1 class="page-title">Game Saya - Kelas {{ $filterClass }}</h1>
                    <p class="page-subtitle">
                        Anda memiliki {{ $games->count() }} game tersedia untuk Kelas {{ $filterClass }}.
                        <a href="{{ route('teacher.games') }}"
                            style="color: #4B8BF4; text-decoration: none; font-weight: 600;">← Lihat Semua Game</a>
                    </p>
                @else
                    <h1 class="page-title">Game Saya</h1>
                    <p class="page-subtitle">Anda memiliki {{ $games->count() }} game tersedia.</p>
                @endif
            </div>
            <a href="{{ route('teacher.games.create') }}" class="btn-create-game">
                <span>➕</span>
                Buat Game Baru
            </a>
        </div>

        <!-- Class Filter Info -->
        @if(isset($filterClass) && $filterClass)
            <div class="alert alert-info d-flex align-items-center justify-content-between mb-4"
                style="background: #EBF3FF; border: 1px solid #4B8BF4; border-radius: 12px; padding: 1rem;">
                <div>
                    <strong>🎯 Filter Aktif:</strong> Menampilkan game untuk <strong>Kelas {{ $filterClass }}</strong>
                </div>
                <a href="{{ route('teacher.games') }}" class="btn btn-sm btn-outline-primary" style="border-radius: 6px;">✕
                    Hapus Filter</a>
            </div>
        @endif

        <!-- Tabs -->
        <div class="tabs-container">
            <a href="{{ route('teacher.games') }}" class="tab-item active" data-filter="all">Semua Game</a>
            <a href="#" class="tab-item" data-filter="published">Dipublikasikan</a>
            <a href="#" class="tab-item" data-filter="draft">Draf</a>
            <a href="#" class="tab-item" data-filter="shared">Dibagikan ke Saya</a>
        </div>

        <!-- Games Grid -->
        <div class="games-grid" id="gamesGrid">
            @if($games->count() > 0)
                @foreach($games as $game)
                    <div class="game-card" data-status="{{ $game->is_active ? 'published' : 'draft' }}"
                        data-title="{{ strtolower($game->title) }}">
                        <div class="game-thumbnail">
                            @php
                                $templateColors = [
                                    'math' => 'linear-gradient(135deg, #4ECDC4 0%, #44A08D 100%)',
                                    'history' => 'linear-gradient(135deg, #C7A17A 0%, #8B7355 100%)',
                                    'science' => 'linear-gradient(135deg, #1a1a2e 0%, #16213e 100%)',
                                    'english' => 'linear-gradient(135deg, #2D5016 0%, #4A7C23 100%)',
                                    'default' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)'
                                ];
                                $templateName = strtolower($game->template->name ?? 'default');
                                $bgColor = $templateColors[$templateName] ?? $templateColors['default'];
                            @endphp
                            <div class="game-thumbnail-placeholder"
                                style="background: {{ $bgColor }}; width: 100%; height: 100%;">
                                <div class="game-thumbnail-icon">{{ $game->template->icon ?? '🎯' }}</div>
                                <div class="game-thumbnail-text">{{ strtoupper($game->template->name ?? 'GAME') }}</div>
                            </div>
                            <span class="game-badge {{ $game->is_active ? 'badge-published' : 'badge-draft' }}">
                                {{ $game->is_active ? 'Dipublikasikan' : 'Draf' }}
                            </span>
                        </div>
                        <div class="game-content">
                            <div class="game-category">
                                KELAS {{ rand(1, 6) }} - {{ strtoupper($game->template->name ?? 'UMUM') }}
                            </div>
                            <h3 class="game-title">{{ $game->title }}</h3>
                            <div class="game-stats">
                                <div class="game-stat">
                                    <span>📝</span>
                                    {{ $game->questions->count() }} soal
                                </div>
                                <div class="game-stat">
                                    <span>📅</span>
                                    {{ $game->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <div class="game-actions">
                                <a href="{{ route('teacher.games.edit', $game->id) }}" class="btn-action btn-edit">
                                    <span>✏️</span> Ubah
                                </a>
                                <button class="btn-action btn-results">
                                    <span>📊</span> Hasil
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            <!-- New Activity Card -->
            <a href="{{ route('teacher.games.create') }}" class="new-activity-card">
                <div class="new-activity-icon">➕</div>
                <div class="new-activity-title">Aktivitas Belajar Baru</div>
                <div class="new-activity-subtitle">Rancang tantangan interaktif baru</div>
            </a>
        </div>

        @if($games->count() == 0)
            <div class="empty-state mt-4">
                <div class="empty-state-icon">🎮</div>
                <p>Anda belum membuat game apa pun.<br>Mulailah dengan membuat game pertama Anda!</p>
                <a href="{{ route('teacher.games.create') }}" class="btn-create-game">
                    ➕ Buat Game Pertama
                </a>
            </div>
        @endif
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tab filtering
        document.querySelectorAll('.tab-item').forEach(tab => {
            tab.addEventListener('click', function (e) {
                e.preventDefault();

                // Update active tab
                document.querySelectorAll('.tab-item').forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                const filter = this.dataset.filter;
                const cards = document.querySelectorAll('.game-card');

                cards.forEach(card => {
                    if (filter === 'all' || card.dataset.status === filter) {
                        card.style.display = 'block';
                    } else if (filter === 'shared') {
                        card.style.display = 'none';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function (e) {
            const query = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.game-card');

            cards.forEach(card => {
                const title = card.dataset.title;
                if (title.includes(query)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Delete confirmation (for future use if delete buttons are added)
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: '🗑️ Hapus Game?',
                    html: '<p style="font-size: 1.1rem; color: #64748b;">Game ini beserta semua soalnya akan dihapus permanen!</p>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#94a3b8',
                    confirmButtonText: '✓ Ya, Hapus!',
                    cancelButtonText: '✗ Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Show success/error messages
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '✅ Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#22c55e',
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: '❌ Gagal!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#ef4444'
            });
        @endif
    </script>
</body>

</html>