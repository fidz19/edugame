<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Soal - {{ $game->title }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { font-size: 24px; }
        .navbar a { color: white; text-decoration: none; margin-left: 20px; }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn { padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; transition: all 0.3s; border: none; cursor: pointer; display: inline-block; }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn-warning { background: #f59e0b; color: white; }
        .btn-danger { background: #ef4444; color: white; }
        .btn-sm { padding: 6px 12px; font-size: 12px; }
        .alert { padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; }
        .alert-success { background: #d1fae5; color: #065f46; }
        .game-info { background: white; padding: 20px; border-radius: 15px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .questions-table { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f9fafb; padding: 15px; text-align: left; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb; }
        td { padding: 15px; border-bottom: 1px solid #e5e7eb; }
        tr:hover { background: #f9fafb; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 600; }
        .badge-easy { background: #d1fae5; color: #065f46; }
        .badge-medium { background: #fef3c7; color: #92400e; }
        .badge-hard { background: #fee2e2; color: #991b1b; }
        .actions { display: flex; gap: 5px; }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>📝 Kelola Soal</h1>
        <div>
            <a href="{{ route('admin.games') }}">Daftar Game</a>
            <a href="{{ route('admin.dashboard') }}">Dasbor</a>
        </div>
    </div>

    <div class="container">
        <div class="game-info">
            <h2 style="color: #333; margin-bottom: 5px;">{{ $game->title }}</h2>
            <p style="color: #666;">{{ $game->description }}</p>
        </div>

        <div class="header">
            <h3>Daftar Soal ({{ $questions->count() }} soal)</h3>
            <a href="{{ route('admin.questions.create', $game->id) }}" class="btn btn-primary">+ Tambah Soal</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($questions->count() > 0)
            <div class="questions-table">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                            <th style="width: 100px;">Poin</th>
                            <th style="width: 100px;">Tingkat</th>
                            <th style="width: 80px;">Status</th>
                            <th style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $index => $question)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ Str::limit($question->question_text, 60) }}</td>
                                <td><code>{{ $question->correct_answer }}</code></td>
                                <td>{{ $question->points }}</td>
                                <td>
                                    <span class="badge badge-{{ $question->difficulty }}">
                                        {{ ucfirst($question->difficulty) }}
                                    </span>
                                </td>
                                <td>
                                    @if($question->is_active)
                                        <span style="color: #10b981;">✓ Aktif</span>
                                    @else
                                        <span style="color: #ef4444;">✗ Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                        <form action="{{ route('admin.questions.delete', $question->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align: center; padding: 60px; background: white; border-radius: 15px;">
                <div style="font-size: 64px; margin-bottom: 20px;">📝</div>
                <h3 style="color: #666; margin-bottom: 10px;">Belum ada soal</h3>
                <p style="color: #999; margin-bottom: 20px;">Mulai dengan menambahkan soal pertama untuk game ini!</p>
                <a href="{{ route('admin.questions.create', $game->id) }}" class="btn btn-primary">+ Tambah Soal</a>
            </div>
        @endif
    </div>
</body>
</html>
