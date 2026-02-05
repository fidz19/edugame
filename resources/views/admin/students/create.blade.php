<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anak - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { font-size: 24px; }
        .navbar a { color: white; text-decoration: none; margin-left: 20px; }
        .container { max-width: 800px; margin: 30px auto; padding: 0 20px; }
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #333; font-weight: 500; }
        .form-group input, .form-group select { width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px; }
        .form-group input:focus, .form-group select:focus { outline: none; border-color: #667eea; }
        .form-actions { display: flex; gap: 10px; margin-top: 30px; }
        .btn { padding: 12px 30px; border-radius: 8px; text-decoration: none; font-size: 14px; border: none; cursor: pointer; transition: all 0.3s; }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn-secondary { background: #6b7280; color: white; }
        .btn:hover { transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>➕ Tambah Anak</h1>
        <div>
            <a href="{{ route('admin.students') }}">Kembali</a>
            <a href="{{ route('admin.dashboard') }}">Dasbor</a>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <form action="{{ route('admin.students.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="nama_anak">Nama Anak *</label>
                    <input type="text" id="nama_anak" name="nama_anak" required placeholder="Contoh: Ani Santoso">
                </div>

                <div class="form-group">
                    <label for="kelas">Kelas *</label>
                    <select id="kelas" name="kelas" required>
                        <option value="">Pilih Kelas</option>
                        <option value="1">Kelas 1</option>
                        <option value="2">Kelas 2</option>
                        <option value="3">Kelas 3</option>
                        <option value="4">Kelas 4</option>
                        <option value="5">Kelas 5</option>
                        <option value="6">Kelas 6</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="parent_id">Orang Tua *</label>
                    <select id="parent_id" name="parent_id" required>
                        <option value="">Pilih Orang Tua</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->parent_name }} ({{ $parent->email }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">💾 Simpan</button>
                    <a href="{{ route('admin.students') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
