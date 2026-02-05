<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Admin - Game Edukasi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar h1 {
            font-size: 24px;
        }

        .navbar .user-info {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .btn {
            padding: 8px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-light {
            background: white;
            color: #667eea;
        }

        .btn-light:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255,255,255,0.3);
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 36px;
            font-weight: bold;
            color: #667eea;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .menu-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
            transition: all 0.3s;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .menu-card .icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .menu-card h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .menu-card p {
            color: #666;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            display: inline-block;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>🎮 Panel Admin - Game Edukasi</h1>
        <div class="user-info">
            <span>Halo, {{ session('admin_name') }}!</span>
            <a href="{{ route('admin.logout') }}" class="btn btn-light">Keluar</a>
        </div>
    </div>

    <div class="container">
        <h2 style="margin-bottom: 20px; color: #333;">📊 Statistik</h2>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Game</h3>
                <div class="number">{{ $totalGames }}</div>
            </div>
            <div class="stat-card">
                <h3>Total Soal</h3>
                <div class="number">{{ $totalQuestions }}</div>
            </div>
            <div class="stat-card">
                <h3>Game Aktif</h3>
                <div class="number">{{ $activeGames }}</div>
            </div>
        </div>

        <h2 style="margin-bottom: 20px; color: #333;">⚙️ Menu Utama</h2>
        
        <div class="menu-grid">
            <div class="menu-card">
                <div class="icon">🎯</div>
                <h2>Kelola Game</h2>
                <p>Tambah, edit, atau hapus game yang tersedia</p>
                <a href="{{ route('admin.games') }}" class="btn btn-primary">Kelola Game</a>
            </div>

            <div class="menu-card">
                <div class="icon">📝</div>
                <h2>Kelola Soal</h2>
                <p>Lihat semua game untuk mengelola soal-soalnya</p>
                <a href="{{ route('admin.games') }}" class="btn btn-primary">Lihat Game</a>
            </div>

            <div class="menu-card">
                <div class="icon">👨‍👩‍👧‍👦</div>
                <h2>Kelola Orang Tua</h2>
                <p>Tambah, edit, atau hapus data orang tua</p>
                <a href="{{ route('admin.parents') }}" class="btn btn-primary">Kelola Orang Tua</a>
            </div>

            <div class="menu-card">
                <div class="icon">👶</div>
                <h2>Kelola Anak</h2>
                <p>Tambah, edit, atau hapus data anak</p>
                <a href="{{ route('admin.students') }}" class="btn btn-primary">Kelola Anak</a>
            </div>
            
            <div class="menu-card">
                <div class="icon">📸</div>
                <h2>Kelola Poster</h2>
                <p>Unggah dan kelola poster edukatif</p>
                <a href="{{ route('admin.posters') }}" class="btn btn-primary">Kelola Poster</a>
            </div>
        </div>
    </div>
</body>
</html>
