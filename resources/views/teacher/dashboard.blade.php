<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - World Languages Games</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            padding: 1rem 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .navbar-text {
            color: rgba(255, 255, 255, 0.9);
            margin-right: 1rem;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: white;
            color: #f5576c;
        }

        .container-main {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .welcome-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2.5rem;
            border-radius: 20px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .welcome-card h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .welcome-card p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.8rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-left: 5px solid;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        .stat-card.students {
            border-color: #667eea;
        }

        .stat-card.games {
            border-color: #f093fb;
        }

        .stat-card.score {
            border-color: #ffd700;
        }

        .stat-card.accuracy {
            border-color: #4ade80;
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 0.3rem;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.95rem;
            font-weight: 600;
        }

        .section-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }

        .btn-filter {
            padding: 0.5rem 1.2rem;
            border: 2px solid #e2e8f0;
            background: white;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-filter:hover {
            border-color: #f093fb;
            color: #f093fb;
        }

        .btn-filter.active {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border-color: transparent;
        }

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }

        table {
            width: 100%;
            margin-bottom: 0;
        }

        thead {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
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
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .badge-class {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .progress-bar-custom {
            height: 8px;
            background: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 0.5rem;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #4ade80 0%, #22c55e 100%);
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        .top-performer-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 10px;
            margin-bottom: 0.8rem;
            transition: all 0.3s ease;
        }

        .top-performer-item:hover {
            background: #f1f5f9;
            transform: translateX(5px);
        }

        .performer-rank {
            font-size: 1.5rem;
            font-weight: 800;
            color: #f093fb;
            margin-right: 1rem;
        }

        .performer-info {
            flex: 1;
        }

        .performer-name {
            font-weight: 700;
            color: #1e293b;
        }

        .performer-stats {
            font-size: 0.85rem;
            color: #64748b;
        }

        .performer-score {
            font-size: 1.3rem;
            font-weight: 700;
            color: #f093fb;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #94a3b8;
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .welcome-card h1 {
                font-size: 2rem;
            }

            .container-main {
                padding: 0 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('teacher.dashboard') }}" style="text-decoration: none;">
                👨‍🏫 Dashboard Guru
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                style="border-color: rgba(255,255,255,0.5);">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto" style="margin-left: 2rem;">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('teacher.dashboard') }}"
                            style="color: white !important; font-weight: 600; padding: 0.5rem 1rem; border-radius: 25px; background: rgba(255,255,255,0.2);">📊
                            Statistik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('teacher.games') }}"
                            style="color: rgba(255,255,255,0.85) !important; font-weight: 600; padding: 0.5rem 1rem; border-radius: 25px; margin-left: 0.5rem;">🎮
                            Game Saya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('teacher.schedules') }}"
                            style="color: rgba(255,255,255,0.85) !important; font-weight: 600; padding: 0.5rem 1rem; border-radius: 25px; margin-left: 0.5rem;">📅
                            Jadwal</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <span class="navbar-text">
                        {{ $teacher->name }}
                    </span>
                    <a href="{{ route('teacher.logout') }}" class="btn btn-logout">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-main">
        <!-- Welcome Card -->
        <div class="welcome-card">
            <h1>Selamat Datang, {{ $teacher->name }}! 👋</h1>
            <p>{{ $teacher->subject ? 'Guru ' . $teacher->subject : 'Guru' }} | Monitor perkembangan siswa Anda di sini
            </p>
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
                <div class="stat-label">Akurasi Keseluruhan</div>
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
                    🏆 Top 5 Siswa Terbaik
                </div>
                @foreach($topPerformers as $index => $performer)
                    <div class="top-performer-item">
                        <div class="performer-rank">#{{ $index + 1 }}</div>
                        <div class="performer-info">
                            <div class="performer-name">{{ $performer['student']->nama_anak }}</div>
                            <div class="performer-stats">
                                Kelas {{ $performer['student']->kelas }} •
                                {{ $performer['games_played'] }} game dimainkan
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
                                <th>Akurasi</th>
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
                                    <td>{{ $gamesPlayed }} game</td>
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
                    <p>Belum ada siswa {{ $filterClass ? 'di kelas ' . $filterClass : '' }}</p>
                </div>
            @endif
        </div>

        <!-- Recent Activities -->
        @if($recentSessions->count() > 0)
            <div class="section-card">
                <div class="section-title">
                    🕐 Aktivitas Terbaru
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Siswa</th>
                                <th>Game</th>
                                <th>Skor</th>
                                <th>Akurasi</th>
                                <th>Waktu</th>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>