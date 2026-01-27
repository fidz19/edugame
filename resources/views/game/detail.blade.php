<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $game->title }} - Taman Belajar Sedjati</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom, #87CEEB 0%, #E0F7FA 60%, #FFFFFF 100%);
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.9);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: #1e3a8a;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            display: inline-block;
        }

        .btn-back {
            background: #10b981;
            color: white;
        }

        .btn-back:hover {
            background: #059669;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .game-detail-card {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        }

        .game-banner {
            width: 100%;
            height: 300px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 120px;
            color: white;
        }

        .game-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .game-content {
            padding: 40px;
        }

        .game-content h1 {
            color: #1e3a8a;
            font-size: 32px;
            margin-bottom: 15px;
        }

        .game-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e0e0e0;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
            font-size: 16px;
        }

        .game-description {
            color: #555;
            font-size: 18px;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .btn-start {
            width: 100%;
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            color: #1e293b;
            padding: 18px;
            border-radius: 15px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            display: block;
            transition: all 0.3s;
            box-shadow: 0 5px 20px rgba(255, 215, 0, 0.4);
        }

        .btn-start:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(255, 215, 0, 0.6);
        }

        .info-box {
            background: #f0f9ff;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            border-left: 5px solid #3b82f6;
        }

        .info-box h3 {
            color: #1e3a8a;
            margin-bottom: 10px;
        }

        .info-box ul {
            margin-left: 20px;
            color: #555;
        }

        .info-box li {
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-brand">🌊 Taman Belajar Sedjati</div>
        <div class="navbar-user">
            <a href="{{ route('home') }}" class="btn btn-back">← Kembali</a>
            @if(session('student_name'))
                <span style="color: #666;">👋 {{ session('student_name') }}</span>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="game-detail-card">
            <div class="game-banner">
                @if($game->thumbnail)
                    <img src="{{ asset($game->thumbnail) }}" alt="{{ $game->title }}">
                @else
                    🎯
                @endif
            </div>

            <div class="game-content">
                <h1>{{ $game->title }}</h1>

                <div class="game-meta">
                    @if($game->category)
                        <div class="meta-item">
                            <span>📚</span>
                            <span>{{ $game->category }}</span>
                        </div>
                    @endif
                    <div class="meta-item">
                        <span>📝</span>
                        <span>{{ $questionsCount }} Soal</span>
                    </div>
                </div>

                @if($game->description)
                    <div class="game-description">
                        {{ $game->description }}
                    </div>
                @endif

                <div class="info-box">
                    <h3>📋 Cara Bermain:</h3>
                    <ul>
                        <li>Klik tombol "Mulai Bermain" di bawah</li>
                        <li>Jawab setiap pertanyaan dengan benar</li>
                        <li>Dapatkan poin untuk setiap jawaban yang benar</li>
                        <li>Lihat hasil akhir setelah menyelesaikan semua soal</li>
                    </ul>
                </div>

                <form action="{{ route('games.start', $game->slug) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-start">
                        🚀 Mulai Bermain Sekarang!
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
