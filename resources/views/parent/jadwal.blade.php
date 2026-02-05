<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Les - Dasbor Orang Tua</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f8fafc;
            min-height: 100vh;
        }

        /* Layout */
        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 8px;
            margin-bottom: 32px;
        }

        .sidebar-brand-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
        }

        .sidebar-brand-text {
            font-weight: 700;
            font-size: 18px;
            color: #1e293b;
        }

        .sidebar-nav {
            flex: 1;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 10px;
            color: #64748b;
            text-decoration: none;
            margin-bottom: 4px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .nav-item:hover {
            background: #f1f5f9;
            color: #334155;
        }

        .nav-item.active {
            background: #eff6ff;
            color: #3b82f6;
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-user {
            padding: 16px;
            border-top: 1px solid #e2e8f0;
            margin-top: auto;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        .user-details h4 {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
        }

        .user-details p {
            font-size: 12px;
            color: #94a3b8;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 240px;
            padding: 0;
        }

        /* Top Header */
        .top-header {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .header-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
        }

        .btn-logout {
            background: #3b82f6;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-logout:hover {
            background: #2563eb;
        }

        /* Content Area */
        .content-area {
            padding: 32px;
        }

        .page-title {
            margin-bottom: 8px;
        }

        .page-title h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
        }

        .page-subtitle {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 24px;
        }

        /* Child Tabs */
        .child-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .child-tab {
            padding: 10px 20px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            color: #64748b;
            cursor: pointer;
            transition: all 0.2s;
        }

        .child-tab:hover {
            background: #f8fafc;
        }

        .child-tab.active {
            background: #3b82f6;
            border-color: #3b82f6;
            color: white;
        }

        /* Schedule Table Section */
        .table-section {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 24px;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            border-bottom: 1px solid #e2e8f0;
        }

        .table-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background: #f8fafc;
            padding: 14px 24px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .data-table td {
            padding: 16px 24px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            color: #334155;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table tr:hover {
            background: #f8fafc;
        }

        .day-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            color: #1d4ed8;
        }

        .subject-text {
            font-weight: 600;
            color: #1e293b;
        }

        .teacher-text {
            color: #64748b;
            font-size: 13px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 16px;
            color: #64748b;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
        }

        /* Summary Cards */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .summary-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
        }

        .summary-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 24px;
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        }

        .summary-card-value {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .summary-card-label {
            font-size: 13px;
            color: #64748b;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-brand-icon">TB</div>
                <span class="sidebar-brand-text">Taman Belajar</span>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('parent.dashboard') }}" class="nav-item">
                    <span class="nav-icon">📊</span>
                    Dasbor
                </a>
                <a href="{{ route('parent.jadwal') }}" class="nav-item active">
                    <span class="nav-icon">📅</span>
                    Jadwal Les
                </a>
            </nav>

            <div class="sidebar-user">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr($parent->parent_name, 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <h4>{{ $parent->parent_name }}</h4>
                        <p>Akun Orang Tua</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Header -->
            <header class="top-header">
                <span class="header-title">📅 Jadwal Les Anak</span>
                <a href="{{ route('parent.logout') }}" class="btn-logout">Keluar</a>
            </header>

            <!-- Content Area -->
            <div class="content-area">
                <div class="page-title">
                    <h1>Jadwal Les</h1>
                </div>
                <p class="page-subtitle">Jadwal bimbingan belajar semua anak Anda</p>

                <!-- Summary Cards -->
                <div class="summary-grid">
                    <div class="summary-card">
                        <div class="summary-card-icon">👶</div>
                        <div class="summary-card-value">{{ $students->count() }}</div>
                        <div class="summary-card-label">Total Anak</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-card-icon">📅</div>
                        <div class="summary-card-value">{{ $totalSchedules }}</div>
                        <div class="summary-card-label">Total Jadwal</div>
                    </div>
                </div>

                <!-- Child Tabs -->
                @if($students->count() > 0)
                    <div class="child-tabs">
                        @foreach($students as $index => $student)
                            <button class="child-tab {{ $index === 0 ? 'active' : '' }}" onclick="showChild({{ $index }})">
                                {{ $student->nama_anak }} (Kelas {{ $student->kelas }})
                            </button>
                        @endforeach
                    </div>
                @endif

                <!-- Per Child Schedule -->
                @forelse($students as $index => $student)
                    <div class="child-section" id="child-{{ $index }}" style="{{ $index !== 0 ? 'display: none;' : '' }}">

                        <div class="table-section">
                            <div class="table-header">
                                <h2 class="table-title">Jadwal Les {{ $student->nama_anak }}</h2>
                            </div>

                            @if(isset($allSchedules[$student->id]) && $allSchedules[$student->id]->count() > 0)
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Hari</th>
                                            <th>Waktu</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Guru</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $days = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
                                        @endphp
                                        @foreach($allSchedules[$student->id]->sortBy('day_of_week') as $schedule)
                                            <tr>
                                                <td>
                                                    <span class="day-badge">{{ $days[$schedule->day_of_week] ?? '-' }}</span>
                                                </td>
                                                <td>
                                                    <strong>{{ $schedule->getTimeRange() }}</strong>
                                                </td>
                                                <td>
                                                    <span class="subject-text">{{ $schedule->subject }}</span>
                                                </td>
                                                <td>
                                                    <span class="teacher-text">{{ $schedule->teacher->name ?? '-' }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="empty-state">
                                    <div class="empty-state-icon">📅</div>
                                    <h3>Belum ada jadwal</h3>
                                    <p>Jadwal les {{ $student->nama_anak }} belum tersedia</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-state-icon">👶</div>
                        <h3>Belum ada data anak</h3>
                        <p>Belum ada anak yang terdaftar di akun Anda</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>

    <script>
        function showChild(index) {
            // Hide all child sections
            document.querySelectorAll('.child-section').forEach(section => {
                section.style.display = 'none';
            });

            // Remove active class from all tabs
            document.querySelectorAll('.child-tab').forEach(tab => {
                tab.classList.remove('active');
            });

            // Show selected child section
            document.getElementById('child-' + index).style.display = 'block';

            // Add active class to clicked tab
            document.querySelectorAll('.child-tab')[index].classList.add('active');
        }
    </script>
</body>

</html>
