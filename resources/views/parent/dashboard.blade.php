<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Orang Tua - Taman Belajar Sedjati</title>
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

        .child-selector {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 500;
            color: #334155;
        }

        .child-selector-icon {
            width: 24px;
            height: 24px;
            background: #dbeafe;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
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

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px;
            position: relative;
        }

        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .stat-icon.blue {
            background: #dbeafe;
            color: #3b82f6;
        }

        .stat-icon.purple {
            background: #ede9fe;
            color: #8b5cf6;
        }

        .stat-icon.orange {
            background: #ffedd5;
            color: #f97316;
        }

        .stat-icon.green {
            background: #dcfce7;
            color: #22c55e;
        }

        .stat-badge {
            font-size: 12px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 6px;
        }

        .stat-badge.positive {
            background: #dcfce7;
            color: #16a34a;
        }

        .stat-badge.negative {
            background: #fef2f2;
            color: #dc2626;
        }

        .stat-label {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
        }

        /* Progress Chart Section */
        .chart-section {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title h2 {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
        }

        .section-title p {
            font-size: 13px;
            color: #94a3b8;
        }

        .chart-legend {
            display: flex;
            gap: 16px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #64748b;
        }

        .legend-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .legend-dot.blue {
            background: #3b82f6;
        }

        .legend-dot.gray {
            background: #cbd5e1;
        }

        /* Simple Bar Chart */
        .bar-chart {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 14px;
            align-items: end;
            padding: 16px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        .bar-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .bar-rail {
            width: 100%;
            height: 120px;
            background: #eef2f7;
            border-radius: 12px;
            padding: 4px;
            display: flex;
            align-items: flex-end;
        }

        .bar-fill {
            width: 100%;
            border-radius: 10px;
            background: linear-gradient(180deg, #60a5fa, #2563eb);
            box-shadow: 0 6px 14px rgba(37, 99, 235, 0.25);
            transition: height 0.2s ease;
        }

        .bar-fill.is-zero {
            background: #cbd5e1;
            box-shadow: none;
        }

        .bar-count {
            font-size: 11px;
            font-weight: 700;
            color: #1f2937;
            background: #e2e8f0;
            padding: 2px 8px;
            border-radius: 999px;
            line-height: 1.2;
        }

        .bar-count.is-zero {
            visibility: hidden;
        }

        .bar-label {
            font-size: 11px;
            color: #64748b;
        }

        /* Summary Stats Grid for Child */
        .summary-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .summary-stat-card {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            border: 1px solid #e2e8f0;
        }

        .summary-stat-card .summary-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 24px;
        }

        .summary-stat-card .summary-icon.games {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        }

        .summary-stat-card .summary-icon.correct {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        }

        .summary-stat-card .summary-icon.accuracy {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
        }

        .summary-stat-card .summary-value {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .summary-stat-card .summary-label {
            font-size: 13px;
            color: #64748b;
        }

        /* Game History Table */
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

        .view-all-link {
            font-size: 14px;
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
        }

        .view-all-link:hover {
            text-decoration: underline;
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

        .game-name {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .game-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .game-icon.math {
            background: #dbeafe;
            color: #3b82f6;
        }

        .game-icon.language {
            background: #fef3c7;
            color: #d97706;
        }

        .game-icon.logic {
            background: #dcfce7;
            color: #22c55e;
        }

        .category-badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .category-badge.math {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .category-badge.language {
            background: #fef3c7;
            color: #b45309;
        }

        .category-badge.logic {
            background: #dcfce7;
            color: #16a34a;
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

        .score-display {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .score-text {
            font-weight: 600;
            color: #1e293b;
        }

        .score-bar {
            width: 60px;
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            overflow: hidden;
        }

        .score-bar-fill {
            height: 100%;
            border-radius: 3px;
        }

        .score-bar-fill.high {
            background: #22c55e;
        }

        .score-bar-fill.medium {
            background: #f59e0b;
        }

        .score-bar-fill.low {
            background: #ef4444;
        }

        /* Schedule Section */
        .schedule-section {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 12px;
        }

        .schedule-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            border-left: 4px solid #3b82f6;
        }

        .schedule-day {
            font-size: 11px;
            font-weight: 700;
            color: #3b82f6;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .schedule-time {
            font-size: 15px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .schedule-subject {
            font-size: 13px;
            color: #64748b;
        }

        .schedule-teacher {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 4px;
        }

        /* Child Tab Navigation */
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

        /* Responsive */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
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
                <a href="#" class="nav-item active">
                    <span class="nav-icon">📊</span>
                    Dasbor
                </a>
                <a href="{{ route('parent.jadwal') }}" class="nav-item">
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
                <div class="child-selector">
                    <span class="child-selector-icon">👶</span>
                    <span>{{ $students->count() }} Anak Terdaftar</span>
                </div>

                <div class="header-actions">
                    <a href="{{ route('parent.logout') }}" class="btn-logout">Keluar</a>
                </div>
            </header>

            <!-- Content Area -->
            <div class="content-area">
                <div class="page-title">
                    <h1>Progress Belajar Anak</h1>
                </div>
                <p class="page-subtitle">Pantau perkembangan belajar anak-anak Anda (7 hari terakhir)</p>

                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-icon blue">⭐</div>
                        </div>
                        <div class="stat-label">Total Anak</div>
                        <div class="stat-value">{{ $students->count() }}</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-icon purple">🎮</div>
                        </div>
                        <div class="stat-label">Game Dimainkan (7 Hari)</div>
                        <div class="stat-value">{{ $totalGamesPlayed }}</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-icon orange">🏆</div>
                        </div>
                        <div class="stat-label">Total Poin (7 Hari)</div>
                        <div class="stat-value">{{ number_format($totalScore) }}</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div class="stat-icon green">📈</div>
                        </div>
                        <div class="stat-label">Akurasi (7 Hari)</div>
                        <div class="stat-value">{{ $overallAccuracy }}%</div>
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

                <!-- Per Child Sections -->
                @forelse($students as $index => $student)
                    <div class="child-section" id="child-{{ $index }}" style="{{ $index !== 0 ? 'display: none;' : '' }}">

                        <!-- Stats Summary for Child -->
                        <div class="chart-section">
                            <div class="section-header">
                                <div class="section-title">
                                    <h2>Ringkasan {{ $student->nama_anak }}</h2>
                                    <p>Statistik performa bermain game (7 hari terakhir)</p>
                                </div>
                            </div>

                            @if($allSessions[$student->id]->count() > 0)
                                @php
                                    $childSessions = $allSessions[$student->id];
                                    $childTotalGames = $childSessions->count();
                                    $childTotalCorrect = $childSessions->sum('correct_answers');
                                    $childTotalQuestions = $childSessions->sum('total_questions');
                                    $childAccuracy = $childTotalQuestions > 0 ? round(($childTotalCorrect / $childTotalQuestions) * 100) : 0;
                                @endphp
                                <div class="summary-stats">
                                    <div class="summary-stat-card">
                                        <div class="summary-icon games">🎮</div>
                                        <div class="summary-value">{{ $childTotalGames }}</div>
                                        <div class="summary-label">Game Dimainkan (7 Hari)</div>
                                    </div>
                                    <div class="summary-stat-card">
                                        <div class="summary-icon correct">✓</div>
                                        <div class="summary-value">{{ $childTotalCorrect }}/{{ $childTotalQuestions }}</div>
                                        <div class="summary-label">Jawaban Benar (7 Hari)</div>
                                    </div>
                                    <div class="summary-stat-card">
                                        <div class="summary-icon accuracy">📊</div>
                                        <div class="summary-value">{{ $childAccuracy }}%</div>
                                        <div class="summary-label">Akurasi (7 Hari)</div>
                                    </div>
                                </div>
                            @else
                                <div class="empty-state">
                                    <div class="empty-state-icon">📊</div>
                                    <h3>Belum ada data</h3>
                                    <p>{{ $student->nama_anak }} belum bermain game dalam 7 hari terakhir</p>
                                </div>
                            @endif
                        </div>

                        <!-- Games Per Day Chart -->
                        <div class="chart-section">
                            <div class="section-header">
                                <div class="section-title">
                                    <h2>Game Dimainkan per Hari</h2>
                                    <p>7 hari terakhir untuk {{ $student->nama_anak }}</p>
                                </div>
                            </div>

                                @php
                                    $chart = $dailyGameCounts[$student->id] ?? ['labels' => [], 'values' => [], 'max' => 1];
                                    $chartTotal = array_sum($chart['values']);
                                @endphp

                            @if($chartTotal > 0)
                                <div class="bar-chart">
                                    @foreach($chart['values'] as $i => $count)
                                        @php
                                            $height = $count === 0 ? 6 : max(12, (int) round(($count / $chart['max']) * 112));
                                        @endphp
                                        <div class="bar-item">
                                            <div class="bar-count {{ $count === 0 ? 'is-zero' : '' }}">{{ $count }}</div>
                                            <div class="bar-rail">
                                                <div class="bar-fill {{ $count === 0 ? 'is-zero' : '' }}" style="height: {{ $height }}px;"></div>
                                            </div>
                                            <div class="bar-label">{{ $chart['labels'][$i] ?? '' }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <div class="empty-state-icon">🎮</div>
                                    <h3>Belum ada permainan</h3>
                                    <p>{{ $student->nama_anak }} belum bermain game dalam 7 hari terakhir</p>
                                </div>
                            @endif
                        </div>

                        <!-- Game History Table -->
                        <div class="table-section">
                            <div class="table-header">
                                <h2 class="table-title">Riwayat Bermain (7 Hari Terakhir)</h2>
                            </div>

                            @if($allSessions[$student->id]->count() > 0)
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Nama Game</th>
                                            <th>Skor</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allSessions[$student->id]->take(10) as $session)
                                            <tr>
                                                <td>
                                                    <div class="game-name">
                                                        <div class="game-icon math">🎮</div>
                                                        <span>{{ $session->game->title }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="score-display">
                                                        <span
                                                            class="score-text">{{ $session->correct_answers }}/{{ $session->total_questions }}</span>
                                                        <div class="score-bar">
                                                            <div class="score-bar-fill {{ $session->accuracy >= 80 ? 'high' : ($session->accuracy >= 60 ? 'medium' : 'low') }}"
                                                                style="width: {{ $session->accuracy }}%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $session->completed_at->format('d M Y, H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="empty-state">
                                    <div class="empty-state-icon">🎮</div>
                                    <h3>Belum ada riwayat</h3>
                                    <p>{{ $student->nama_anak }} belum bermain game dalam 7 hari terakhir</p>
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
