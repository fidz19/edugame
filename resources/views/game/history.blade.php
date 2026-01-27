<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Nilai - Taman Belajar Sedjati</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom, #dbeafe 0%, #eff6ff 100%);
            color: #1e3a8a;
            min-height: 100vh;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .header h1 {
            font-size: 2.5rem;
            color: #1e3a8a;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .back-btn {
            position: absolute;
            top: 0;
            left: 0;
            background: white;
            color: #1e3a8a;
            padding: 10px 20px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .back-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.1);
            border-bottom: 5px solid #3b82f6;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
            display: block;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: #1e3a8a;
            display: block;
        }

        .stat-label {
            color: #64748b;
            font-weight: 600;
        }

        /* History List */
        .history-card {
            background: white;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 15px 40px rgba(30, 58, 138, 0.08);
        }

        .history-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.2s ease;
            border-radius: 15px;
        }

        .history-item:hover {
            background: #f8fafc;
        }

        .game-info h3 {
            margin: 0 0 5px 0;
            color: #1e3a8a;
            font-size: 1.1rem;
        }

        .game-time {
            color: #64748b;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .score-badge {
            background: #dbeafe;
            color: #1e40af;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 1.2rem;
            min-width: 80px;
            text-align: center;
        }

        .score-high {
            background: #dcfce7;
            color: #166534;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <a href="{{ route('games.index') }}" class="back-btn">
                <span>⬅️</span> Kembali
            </a>
            <h1>📜 Riwayat Perjalananmu</h1>
            <p style="color: #64748b;">Lihat progress belajar hebatmu di sini!</p>
        </header>

        <!-- Stats Section -->
        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-icon">🎮</span>
                <span class="stat-value">{{ $total_games }}</span>
                <span class="stat-label">Game Dimainkan</span>
            </div>
            <div class="stat-card">
                <span class="stat-icon">🏆</span>
                <span class="stat-value">{{ $highest_score }}</span>
                <span class="stat-label">Skor Tertinggi</span>
            </div>
            <div class="stat-card">
                <span class="stat-icon">📖</span>
                <span class="stat-value">{{ $weekly_game_score }}</span>
                <span class="stat-label">Poin Game Bahasa</span>
            </div>
            <div class="stat-card">
                <span class="stat-icon">👨‍🏫</span>
                <span class="stat-value">{{ $teacher_game_score }}</span>
                <span class="stat-label">Poin Game Guru</span>
            </div>
             <div class="stat-card">
                <span class="stat-icon">📈</span>
                <span class="stat-value">{{ $average_score }}</span>
                <span class="stat-label">Rata-Rata</span>
            </div>
        </div>

        <!-- Weekly Games History -->
        <div class="history-card" style="margin-bottom: 30px; border-left: 5px solid #FFD700;">
            <h2 style="margin-bottom: 20px; margin-left: 10px; color: #1e3a8a;">🔥 Riwayat Game Bahasa Mingguan</h2>
            
            @forelse($weekly_sessions as $history)
                <div class="history-item">
                    <div class="game-info">
                        <h3>{{ $history->game->title ?? 'Game Tidak Ditemukan' }}</h3>
                        <div class="game-time">
                            <span>🕒</span> {{ \Carbon\Carbon::parse($history->completed_at)->translatedFormat('d F Y, H:i') }}
                        </div>
                    </div>
                    <div class="score-badge {{ $history->total_score >= 80 ? 'score-high' : '' }}">
                        {{ $history->total_score }}
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <p style="color: #64748b;">Belum ada riwayat game bahasa.</p>
                </div>
            @endforelse
        </div>

        <!-- Teacher Games History -->
        <div class="history-card" style="border-left: 5px solid #3b82f6;">
            <h2 style="margin-bottom: 20px; margin-left: 10px; color: #1e3a8a;">👨‍🏫 Riwayat Game Guru</h2>
            
            @forelse($teacher_sessions as $history)
                <div class="history-item">
                    <div class="game-info">
                        <h3>{{ $history->game->title ?? 'Game Tidak Ditemukan' }}</h3>
                        <div class="game-time">
                            <span>🕒</span> {{ \Carbon\Carbon::parse($history->completed_at)->translatedFormat('d F Y, H:i') }}
                        </div>
                    </div>
                    <div class="score-badge {{ $history->total_score >= 80 ? 'score-high' : '' }}">
                        {{ $history->total_score }}
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <p style="color: #64748b;">Belum ada riwayat game guru.</p>
                </div>
            @endforelse
        </div>

        @if($history_sessions->isEmpty())
             <div class="empty-state" style="margin-top: 40px;">
                <div style="font-size: 4rem; marginBottom: 20px;">📭</div>
                <h3>Belum ada riwayat permainan</h3>
                <p style="color: #64748b;">Ayo mainkan game pertamamu sekarang!</p>
                <a href="{{ route('games.index') }}" style="display: inline-block; margin-top: 20px; background: #3b82f6; color: white; padding: 12px 30px; border-radius: 50px; text-decoration: none; font-weight: bold;">Mulai Bermain</a>
            </div>
        @endif
    </div>
</body>
</html>
