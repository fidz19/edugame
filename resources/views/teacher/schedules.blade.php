<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal - Portal Guru</title>
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

        .page-title-section {
            margin-bottom: 2rem;
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

        /* Section Card */
        .section-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .day-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .day-badge {
            display: inline-block;
            padding: 0.35rem 1rem;
            background: linear-gradient(135deg, #4B8BF4 0%, #3B7DE0 100%);
            color: white;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .schedule-item {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1rem 1.25rem;
            background: #f8fafc;
            border-radius: 12px;
            margin-bottom: 0.75rem;
            border-left: 4px solid #4B8BF4;
            transition: all 0.3s ease;
        }

        .schedule-item:hover {
            transform: translateX(5px);
            background: #f1f5f9;
        }

        .schedule-time {
            font-weight: 700;
            color: #4B8BF4;
            min-width: 110px;
            font-size: 0.95rem;
        }

        .schedule-info {
            flex: 1;
        }

        .schedule-student {
            font-weight: 600;
            color: #1e293b;
            font-size: 1rem;
        }

        .schedule-subject {
            color: #64748b;
            font-size: 0.9rem;
        }

        .schedule-location {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.35rem 0.85rem;
            background: #EBF3FF;
            color: #4B8BF4;
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

            .schedule-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .search-box {
                width: 100%;
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
            <a href="{{ route('teacher.games') }}" class="nav-item">
                <span class="nav-icon">🎮</span>
                <span>Game</span>
            </a>
            <a href="{{ route('teacher.schedules') }}" class="nav-item active">
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
                <input type="text" placeholder="Cari jadwal...">
            </div>
            <div class="header-actions">
            </div>
        </div>

        <!-- Page Title -->
        <div class="page-title-section">
            <h1 class="page-title">📅 Jadwal Mengajar</h1>
            <p class="page-subtitle">Your assigned tutoring sessions by admin</p>
        </div>

        @if($schedules->count() > 0)
            @php
                $days = [
                    1 => ['name' => 'Monday', 'icon' => '📅'],
                    2 => ['name' => 'Tuesday', 'icon' => '📅'],
                    3 => ['name' => 'Wednesday', 'icon' => '📅'],
                    4 => ['name' => 'Thursday', 'icon' => '📅'],
                    5 => ['name' => 'Friday', 'icon' => '📅'],
                    6 => ['name' => 'Saturday', 'icon' => '📅'],
                    7 => ['name' => 'Sunday', 'icon' => '📅'],
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
                    <p>Belum ada jadwal mengajar untuk Anda.<br>Hubungi admin untuk mengatur jadwal.</p>
                </div>
            </div>
        @endif
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>