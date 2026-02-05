<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Poster</title>
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
        .form-group input, .form-group textarea { width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px; font-family: inherit; }
        .form-group input:focus, .form-group textarea:focus { outline: none; border-color: #667eea; }
        .form-group textarea { min-height: 100px; resize: vertical; }
        .form-actions { display: flex; gap: 10px; margin-top: 30px; }
        .btn { padding: 12px 30px; border-radius: 8px; text-decoration: none; font-size: 14px; border: none; cursor: pointer; transition: all 0.3s; }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn-secondary { background: #6b7280; color: white; }
        .btn:hover { transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>➕ Tambah Poster Baru</h1>
        <div>
            <a href="{{ route('admin.posters') }}">Kembali</a>
            <a href="{{ route('admin.dashboard') }}">Dasbor</a>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <form action="{{ route('admin.posters.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="title">Judul Poster *</label>
                    <input type="text" id="title" name="title" required placeholder="Masukkan judul poster...">
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi (Opsional)</label>
                    <textarea id="description" name="description" placeholder="Deskripsi poster..."></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Unggah Gambar Poster *</label>
                    <input type="file" id="image" name="image" accept="image/*" required onchange="previewImage(event)">
                    <small style="color: #666; display: block; margin-top: 5px;">Format: JPG, PNG, GIF. Max: 5MB</small>
                    <img id="imagePreview" style="max-width: 400px; margin-top: 10px; display: none; border-radius: 10px;">
                </div>

                <div class="form-group">
                    <label for="category">Kategori (Opsional)</label>
                    <input type="text" id="category" name="category" placeholder="Contoh: Edukasi, Motivasi, dll">
                </div>

                <div class="form-group">
                    <label for="order">Urutan Tampil</label>
                    <input type="number" id="order" name="order" value="0" min="0" placeholder="0">
                    <small style="color: #666; display: block; margin-top: 5px;">Semakin kecil angka, semakin awal ditampilkan</small>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">💾 Simpan Poster</button>
                    <a href="{{ route('admin.posters') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function previewImage(event) {
            const preview = document.getElementById('imagePreview');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }
    </script>
</body>
</html>
