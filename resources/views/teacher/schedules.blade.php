<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Mengajar - Dashboard Guru</title>
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
            text-decoration: none;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 600;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white !important;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-logout:hover {
            background: white;
            color: #f5576c;
        }

        .container-main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: #64748b;
        }

        .section-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .day-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .schedule-item {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 12px;
            margin-bottom: 0.75rem;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }

        .schedule-item:hover {
            transform: translateX(5px);
            background: #f1f5f9;
        }

        .schedule-time {
            font-weight: 700;
            color: #667eea;
            min-width: 100px;
            font-size: 1rem;
        }

        .schedule-info {
            flex: 1;
        }

        .schedule-student {
            font-weight: 600;
            color: #1e293b;
            font-size: 1.05rem;
        }

        .schedule-subject {
            color: #64748b;
            font-size: 0.9rem;
        }

        .schedule-location {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.3rem 0.75rem;
            background: #e0e7ff;
            color: #4338ca;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #64748b;
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .day-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .schedule-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
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
            <a class="navbar-brand" href="{{ route('teacher.dashboard') }}">
                👨‍🏫 Dashboard Guru
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('teacher.dashboard') }}">📊 Statistik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('teacher.games') }}">🎮 Game Saya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('teacher.schedules') }}">📅 Jadwal</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <span class="text-white me-3">{{ $teacher->name }}</span>
                    <a href="{{ route('teacher.logout') }}" class="btn-logout">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-main">
        <div class="page-header">
            <h1 class="page-title">📅 Jadwal Mengajar</h1>
            <p class="page-subtitle">Jadwal les yang dibuat oleh admin</p>
        </div>

        @if($schedules->count() > 0)
            @php
                $days = [
                    1 => ['name' => 'Senin', 'icon' => '📅'],
                    2 => ['name' => 'Selasa', 'icon' => '📅'],
                    3 => ['name' => 'Rabu', 'icon' => '📅'],
                    4 => ['name' => 'Kamis', 'icon' => '📅'],
                    5 => ['name' => 'Jumat', 'icon' => '📅'],
                    6 => ['name' => 'Sabtu', 'icon' => '📅'],
                    7 => ['name' => 'Minggu', 'icon' => '📅'],
                ];
                $groupedSchedules = $schedules->groupBy('day_of_week');
            @endphp

            @foreach($days as $dayNum => $dayInfo)
                @if(isset($groupedSchedules[$dayNum]))
                    <div class="section-card">
                        <h3 class="day-title">
                            {{ $dayInfo['icon'] }} <span class="day-badge">{{ $dayInfo['name'] }}</span>
                        </h3>

                        @foreach($groupedSchedules[$dayNum] as $schedule)
                            <div class="schedule-item">
                                <div class="schedule-time">
                                    {{ $schedule->getTimeRange() }}
                                </div>
                                <div class="schedule-info">
                                    <div class="schedule-student">{{ $schedule->student->nama_anak ?? 'N/A' }}</div>
                                    <div class="schedule-subject">{{ $schedule->subject }}</div>
                                </div>
                                @if($schedule->location)
                                    <div class="schedule-location">
                                        📍 {{ $schedule->location }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        @else
            <div class="section-card">
                <div class="empty-state">
                    <div class="empty-state-icon">📅</div>
                    <p>Belum ada jadwal mengajar yang ditugaskan kepada Anda.<br>Hubungi admin untuk mengatur jadwal.</p>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>