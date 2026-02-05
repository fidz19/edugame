<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Orang Tua - Admin</title>
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
        .form-group input { width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px; }
        .form-group input:focus { outline: none; border-color: #667eea; }
        .form-actions { display: flex; gap: 10px; margin-top: 30px; }
        .btn { padding: 12px 30px; border-radius: 8px; text-decoration: none; font-size: 14px; border: none; cursor: pointer; transition: all 0.3s; }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn-secondary { background: #6b7280; color: white; }
        .btn:hover { transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>➕ Tambah Orang Tua</h1>
        <div>
            <a href="{{ route('admin.parents') }}">Kembali</a>
            <a href="{{ route('admin.dashboard') }}">Dasbor</a>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <form action="{{ route('admin.parents.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="parent_name">Nama Orang Tua *</label>
                    <input type="text" id="parent_name" name="parent_name" required placeholder="Contoh: Budi Santoso">
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin *</label>
                    <div style="display: flex; gap: 20px; margin-top: 8px;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="radio" name="gender" value="L" required>
                            <span>👨 Laki-laki (Ayah)</span>
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="radio" name="gender" value="P" checked required>
                            <span>👩 Perempuan (Bunda)</span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required placeholder="contoh@email.com">
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi *</label>
                    <input type="password" id="password" name="password" required placeholder="Minimal 6 karakter">
                    <small style="color: #666; display: block; margin-top: 5px;">Kata sandi akan di-hash otomatis</small>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">💾 Simpan</button>
                    <a href="{{ route('admin.parents') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
