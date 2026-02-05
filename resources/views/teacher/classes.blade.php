<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas - Portal Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            margin-bottom: 1.5rem;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 10px;
            padding: 0.5rem 1rem;
            width: 300px;
        }

        .search-box input {
            border: none;
            outline: none;
            width: 100%;
            margin-left: 0.5rem;
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
        }

        .page-title-section {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .page-subtitle {
            color: #64748b;
        }

        /* Class Cards */
        .class-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .class-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .class-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .class-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .class-1 {
            background: #fee2e2;
        }

        .class-2 {
            background: #fef3c7;
        }

        .class-3 {
            background: #d1fae5;
        }

        .class-4 {
            background: #dbeafe;
        }

        .class-5 {
            background: #e0e7ff;
        }

        .class-6 {
            background: #fce7f3;
        }

        .class-all {
            background: #f3f4f6;
        }

        .class-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
        }

        .class-count {
            font-size: 0.85rem;
            color: #64748b;
        }

        .class-badge {
            background: #EBF3FF;
            color: #4B8BF4;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .class-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-view-games {
            background: linear-gradient(135deg, #4B8BF4 0%, #3B7DE0 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-view-games:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(75, 139, 244, 0.3);
        }

        /* Game List in Class */
        .games-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1rem;
        }

        .game-item {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.2s ease;
            text-decoration: none;
            color: inherit;
        }

        .game-item:hover {
            background: #EBF3FF;
            transform: translateY(-2px);
        }

        .game-thumb {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .game-info {
            flex: 1;
            min-width: 0;
        }

        .game-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .game-meta {
            font-size: 0.8rem;
            color: #64748b;
        }

        .game-status {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-weight: 600;
        }

        .status-active {
            background: #d1fae5;
            color: #065f46;
        }

        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty-class {
            text-align: center;
            padding: 2rem;
            color: #94a3b8;
        }

        .empty-class-icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .btn-create {
            background: linear-gradient(135deg, #4B8BF4 0%, #3B7DE0 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-create:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(75, 139, 244, 0.3);
        }

        @media (max-width: 1024px) {
            .sidebar {
                width: 80px;
            }

            .sidebar-brand .brand-text,
            .nav-item span,
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
                min-height: auto;
            }

            .sidebar-nav {
                display: flex;
                padding: 0;
                overflow-x: auto;
            }

            .nav-item {
                padding: 0.5rem 1rem;
                white-space: nowrap;
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

            .search-box {
                width: 200px;
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
            <a href="{{ route('teacher.classes') }}" class="nav-item active">
                <span class="nav-icon">👥</span>
                <span>Kelas</span>
            </a>
            <a href="{{ route('teacher.games') }}" class="nav-item">
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
                <input type="text" id="searchInput" placeholder="Cari game...">
            </div>
            <div class="header-actions">
                <a href="{{ route('teacher.games.create') }}" class="btn-create">
                    ➕ Game Baru
                </a>
            </div>
        </div>

        <!-- Page Title -->
        <div class="page-title-section">
            <h1 class="page-title">👥 Kelas Saya</h1>
            <p class="page-subtitle">Lihat game yang Anda buat berdasarkan tingkat kelas</p>
        </div>

        @php
            $classColors = [
                1 => '#ef4444',
                2 => '#f59e0b',
                3 => '#10b981',
                4 => '#3b82f6',
                5 => '#6366f1',
                6 => '#ec4899'
            ];
            $classEmojis = [
                1 => '🔴',
                2 => '🟡',
                3 => '🟢',
                4 => '🔵',
                5 => '🟣',
                6 => '💗'
            ];
        @endphp

        <!-- Games for All Classes -->
        @if($gamesAllClasses->count() > 0)
            <div class="class-card">
                <div class="class-header">
                    <div class="class-title">
                        <div class="class-icon class-all">📚</div>
                        <div>
                            <div class="class-name">Semua Kelas</div>
                            <div class="class-count">Game tersedia untuk semua siswa</div>
                        </div>
                    </div>
                    <div class="class-actions">
                        <span class="class-badge">{{ $gamesAllClasses->count() }} Game</span>
                        <a href="{{ route('teacher.games') }}" class="btn-view-games">👁️ Lihat Game</a>
                    </div>
                </div>
                <div class="games-grid">
                    @foreach($gamesAllClasses as $game)
                        <a href="{{ route('teacher.games.edit', $game->id) }}" class="game-item">
                            <div class="game-thumb" style="background: linear-gradient(135deg, #f3f4f6, #e5e7eb);">
                                {{ $game->template->icon ?? '🎮' }}
                            </div>
                            <div class="game-info">
                                <div class="game-title">{{ $game->title }}</div>
                                <div class="game-meta">{{ $game->category ?? 'Tanpa Kategori' }} ·
                                    {{ $game->questions->count() }} Soal
                                </div>
                            </div>
                            <span class="game-status {{ $game->is_active ? 'status-active' : 'status-inactive' }}">
                                {{ $game->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Classes 1-6 -->
        @foreach($gamesByClass as $classNum => $games)
            <div class="class-card">
                <div class="class-header">
                    <div class="class-title">
                        <div class="class-icon class-{{ $classNum }}">{{ $classEmojis[$classNum] }}</div>
                        <div>
                            <div class="class-name">Kelas {{ $classNum }}</div>
                            <div class="class-count">Game untuk siswa kelas {{ $classNum }}</div>
                        </div>
                    </div>
                    <div class="class-actions">
                        <span class="class-badge">{{ $games->count() }} Game</span>
                        <a href="{{ route('teacher.games', ['class' => $classNum]) }}" class="btn-view-games">👁️ Lihat
                            Game</a>
                    </div>
                </div>

                @if($games->count() > 0)
                    <div class="games-grid">
                        @foreach($games as $game)
                            <a href="{{ route('teacher.games.edit', $game->id) }}" class="game-item">
                                <div class="game-thumb"
                                    style="background: linear-gradient(135deg, {{ $classColors[$classNum] }}22, {{ $classColors[$classNum] }}44);">
                                    {{ $game->template->icon ?? '🎮' }}
                                </div>
                                <div class="game-info">
                                    <div class="game-title">{{ $game->title }}</div>
                                    <div class="game-meta">{{ $game->category ?? 'Tanpa Kategori' }} ·
                                        {{ $game->questions->count() }} Soal
                                    </div>
                                </div>
                                <span class="game-status {{ $game->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $game->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="empty-class">
                        <div class="empty-class-icon">📭</div>
                        <p>Belum ada game untuk kelas {{ $classNum }}</p>
                        <a href="{{ route('teacher.games.create') }}" class="btn-create" style="margin-top: 0.5rem;">
                            ➕ Buat Game Pertama
                        </a>
                    </div>
                @endif
            </div>
        @endforeach
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Search functionality
        document.getElementById('searchInput')?.addEventListener('input', function (e) {
            const query = e.target.value.toLowerCase();
            document.querySelectorAll('.game-item').forEach(item => {
                const title = item.querySelector('.game-title')?.textContent.toLowerCase() || '';
                const meta = item.querySelector('.game-meta')?.textContent.toLowerCase() || '';
                item.style.display = (title.includes(query) || meta.includes(query)) ? 'flex' : 'none';
            });
        });
    </script>
</body>

</html>