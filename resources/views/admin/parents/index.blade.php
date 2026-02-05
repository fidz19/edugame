<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Orang Tua - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { font-size: 24px; }
        .navbar a { color: white; text-decoration: none; margin-left: 20px; }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn { padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; transition: all 0.3s; border: none; cursor: pointer; }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn-warning { background: #f59e0b; color: white; }
        .btn-danger { background: #ef4444; color: white; }
        .btn-sm { padding: 6px 12px; font-size: 12px; }
        .alert { padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; }
        .alert-success { background: #d1fae5; color: #065f46; }
        .table-container { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f9fafb; padding: 15px; text-align: left; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb; }
        td { padding: 15px; border-bottom: 1px solid #e5e7eb; }
        tr:hover { background: #f9fafb; }
        .actions { display: flex; gap: 5px; }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>👨‍👩‍👧‍👦 Kelola Orang Tua</h1>
        <div>
            <a href="{{ route('admin.dashboard') }}">Dasbor</a>
        </div>
    </div>

    <div class="container">
        <div class="header">
            <h2>Daftar Orang Tua ({{ $parents->count() }})</h2>
            <a href="{{ route('admin.parents.create') }}" class="btn btn-primary">+ Tambah Orang Tua</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($parents->count() > 0)
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Orang Tua</th>
                            <th>Email</th>
                            <th>Jumlah Anak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($parents as $parent)
                            <tr>
                                <td>{{ $parent->id }}</td>
                                <td>{{ $parent->parent_name }}</td>
                                <td>{{ $parent->email }}</td>
                                <td>{{ $parent->students_count }} anak</td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('admin.parents.edit', $parent->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                        <form action="{{ route('admin.parents.delete', $parent->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus orang tua ini?')">
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
                <div style="font-size: 64px; margin-bottom: 20px;">👨‍👩‍👧‍👦</div>
                <h3 style="color: #666; margin-bottom: 10px;">Belum ada data orang tua</h3>
                <p style="color: #999; margin-bottom: 20px;">Mulai dengan menambahkan orang tua pertama!</p>
                <a href="{{ route('admin.parents.create') }}" class="btn btn-primary">+ Tambah Orang Tua</a>
            </div>
        @endif
    </div>
</body>
</html>
