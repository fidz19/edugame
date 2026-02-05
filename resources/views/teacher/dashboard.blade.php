<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor - Portal Guru</title>
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

        /* Welcome Card */
        .welcome-card {
            background: linear-gradient(135deg, #4B8BF4 0%, #3B7DE0 100%);
            color: white;
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(75, 139, 244, 0.3);
        }

        .welcome-card h1 {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .welcome-card p {
            font-size: 1rem;
            opacity: 0.9;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border-left: 4px solid;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-card.students {
            border-color: #4B8BF4;
        }

        .stat-card.games {
            border-color: #f093fb;
        }

        .stat-card.score {
            border-color: #fbbf24;
        }

        .stat-card.accuracy {
            border-color: #22c55e;
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Section Card */
        .section-card {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Filter Buttons */
        .filter-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .btn-filter {
            padding: 0.5rem 1rem;
            border: 2px solid #e2e8f0;
            background: white;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            cursor: pointer;
            text-decoration: none;
            color: #64748b;
        }

        .btn-filter:hover {
            border-color: #4B8BF4;
            color: #4B8BF4;
        }

        .btn-filter.active {
            background: #4B8BF4;
            color: white;
            border-color: #4B8BF4;
        }

        /* Top Performer */
        .top-performer-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 12px;
            margin-bottom: 0.75rem;
            transition: all 0.3s ease;
        }

        .top-performer-item:hover {
            background: #f1f5f9;
            transform: translateX(5px);
        }

        .performer-rank {
            font-size: 1.25rem;
            font-weight: 800;
            color: #4B8BF4;
            margin-right: 1rem;
            min-width: 35px;
        }

        .performer-info {
            flex: 1;
        }

        .performer-name {
            font-weight: 600;
            color: #1e293b;
        }

        .performer-stats {
            font-size: 0.85rem;
            color: #64748b;
        }

        .performer-score {
            font-size: 1.2rem;
            font-weight: 700;
            color: #4B8BF4;
        }

        /* Table */
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
        }

        table {
            width: 100%;
            margin-bottom: 0;
        }

        thead {
            background: #4B8BF4;
            color: white;
        }

        thead th {
            padding: 1rem;
            font-weight: 600;
            border: none;
        }

        tbody td {
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .badge-class {
            background: linear-gradient(135deg, #4B8BF4 0%, #3B7DE0 100%);
            color: white;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .progress-bar-custom {
            height: 6px;
            background: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 0.4rem;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #22c55e 0%, #16a34a 100%);
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #94a3b8;
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
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

            .welcome-card h1 {
                font-size: 1.5rem;
            }

            .search-box {
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
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
            <a href="{{ route('teacher.dashboard') }}" class="nav-item active">
                <span class="nav-icon">📊</span>
                <span>Dasbor</span>
            </a>
            <a href="{{ route('teacher.classes') }}" class="nav-item">
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
                <input type="text" placeholder="Cari siswa...">
            </div>
            <div class="header-actions">
            </div>
        </div>

        <!-- Welcome Card -->
        <div class="welcome-card">
            <h1>Selamat datang kembali, {{ $teacher->name }}! 👋</h1>
            <p>{{ $teacher->subject ? 'Guru ' . $teacher->subject : 'Guru' }} | Pantau perkembangan siswa Anda
                here</p>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card students">
                <div class="stat-icon">👥</div>
                <div class="stat-value">{{ $totalStudents }}</div>
                <div class="stat-label">Total Siswa</div>
            </div>

            <div class="stat-card games">
                <div class="stat-icon">🎮</div>
                <div class="stat-value">{{ $totalGamesPlayed }}</div>
                <div class="stat-label">Game Dimainkan</div>
            </div>

            <div class="stat-card score">
                <div class="stat-icon">⭐</div>
                <div class="stat-value">{{ $averageScore }}</div>
                <div class="stat-label">Rata-rata Skor</div>
            </div>

            <div class="stat-card accuracy">
                <div class="stat-icon">🎯</div>
                <div class="stat-value">{{ $overallAccuracy }}%</div>
                <div class="stat-label">Overall Accuracy</div>
            </div>
        </div>

        <!-- Class Distribution -->
        <div class="section-card">
            <div class="section-title">
                📊 Distribusi Siswa per Kelas
            </div>
            <div class="filter-buttons">
                <a href="{{ route('teacher.dashboard') }}" class="btn-filter {{ !$filterClass ? 'active' : '' }}">
                    Semua Kelas ({{ $totalStudents }})
                </a>
                @for ($i = 1; $i <= 6; $i++)
                    <a href="{{ route('teacher.dashboard', ['class' => $i]) }}"
                        class="btn-filter {{ $filterClass == $i ? 'active' : '' }}">
                        Kelas {{ $i }} ({{ $classStats[$i] ?? 0 }})
                    </a>
                @endfor
            </div>
        </div>

        <!-- Top Performers -->
        @if(count($topPerformers) > 0)
            <div class="section-card">
                <div class="section-title">
                    🏆 5 Siswa Terbaik
                </div>
                @foreach($topPerformers as $index => $performer)
                    <div class="top-performer-item">
                        <div class="performer-rank">#{{ $index + 1 }}</div>
                        <div class="performer-info">
                            <div class="performer-name">{{ $performer['student']->nama_anak }}</div>
                            <div class="performer-stats">
                                Kelas {{ $performer['student']->kelas }} •
                                {{ $performer['games_played'] }} games played
                            </div>
                        </div>
                        <div class="performer-score">{{ $performer['avg_score'] }}</div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Students List -->
        <div class="section-card">
            <div class="section-title">
                📋 Daftar Siswa {{ $filterClass ? '(Kelas ' . $filterClass . ')' : '' }}
            </div>

            @if($students->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Game Dimainkan</th>
                                <th>Rata-rata Skor</th>
                                <th>Accuracy</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $index => $student)
                                @php
                                    $studentSessions = \App\Models\GameSession::where('student_id', $student->id)
                                        ->whereNotNull('completed_at')
                                        ->get();
                                    $gamesPlayed = $studentSessions->count();
                                    $avgScore = $gamesPlayed > 0 ? round($studentSessions->avg('total_score'), 2) : 0;
                                    $totalQ = $studentSessions->sum('total_questions');
                                    $totalC = $studentSessions->sum('correct_answers');
                                    $accuracy = $totalQ > 0 ? round(($totalC / $totalQ) * 100, 2) : 0;
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $student->nama_anak }}</strong></td>
                                    <td><span class="badge-class">Kelas {{ $student->kelas }}</span></td>
                                    <td>{{ $gamesPlayed }} games</td>
                                    <td><strong>{{ $avgScore }}</strong></td>
                                    <td>
                                        {{ $accuracy }}%
                                        <div class="progress-bar-custom">
                                            <div class="progress-fill" style="width: {{ $accuracy }}%"></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">📚</div>
                    <p>Tidak ada siswa {{ $filterClass ? 'di kelas ' . $filterClass : '' }}</p>
                </div>
            @endif
        </div>

        <!-- Recent Activities -->
        @if($recentSessions->count() > 0)
            <div class="section-card">
                <div class="section-title">
                    🕐 Recent Activities
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Siswa</th>
                                <th>Game</th>
                                <th>Skor</th>
                                <th>Accuracy</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentSessions as $session)
                                <tr>
                                    <td><strong>{{ $session->student->nama_anak }}</strong></td>
                                    <td>{{ $session->game->title }}</td>
                                    <td><strong>{{ $session->total_score }}</strong></td>
                                    <td>
                                        {{ $session->total_questions > 0 ? round(($session->correct_answers / $session->total_questions) * 100, 2) : 0 }}%
                                    </td>
                                    <td>{{ $session->completed_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>