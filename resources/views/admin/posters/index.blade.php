<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Poster</title>
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
        }

        .navbar h1 {
            font-size: 24px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .posters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .poster-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .poster-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .poster-card-body {
            padding: 15px;
        }

        .poster-card h3 {
            font-size: 16px;
            margin-bottom: 8px;
        }

        .poster-card p {
            font-size: 13px;
            color: #666;
            margin-bottom: 10px;
        }

        .poster-actions {
            display: flex;
            gap: 8px;
        }

        .alert {
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1>📸 Kelola Poster</h1>
        <div>
            <a href="{{ route('admin.dashboard') }}">Dasbor</a>
            <a href="{{ route('admin.logout') }}">Keluar</a>
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2>Daftar Poster</h2>
                <a href="{{ route('admin.posters.create') }}" class="btn btn-primary">+ Tambah Poster Baru</a>
            </div>

            @if($posters->count() > 0)
                <div class="posters-grid">
                    @foreach($posters as $poster)
                        <div class="poster-card">
                            <img src="{{ asset('storage/' . $poster->image) }}" alt="{{ $poster->title }}">
                            <div class="poster-card-body">
                                <h3>{{ $poster->title }}</h3>
                                <p>{{ Str::limit($poster->description, 60) }}</p>
                                <p style="font-size: 12px; color: #999;">Order: {{ $poster->order }}</p>
                                <div class="poster-actions">
                                    <a href="{{ route('admin.posters.edit', $poster->id) }}" class="btn btn-secondary"
                                        style="font-size: 12px; padding: 6px 12px;">Ubah</a>
                                    <form action="{{ route('admin.posters.delete', $poster->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="font-size: 12px; padding: 6px 12px;"
                                            onclick="return confirm('Yakin hapus poster ini?')">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p style="text-align: center; color: #999; padding: 40px 0;">Belum ada poster. Klik "Tambah Poster Baru"
                    untuk menambahkan.</p>
            @endif
        </div>
    </div>
</body>

</html>