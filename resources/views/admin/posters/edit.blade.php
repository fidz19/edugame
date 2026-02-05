<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Poster - Admin</title>
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
            max-width: 800px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .image-preview {
            margin-top: 10px;
            max-width: 300px;
            border-radius: 10px;
        }

        .current-image {
            margin-top: 10px;
        }

        .current-image img {
            max-width: 300px;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1>✏️ Ubah Poster</h1>
        <div>
            <a href="{{ route('admin.posters') }}">Kembali</a>
            <a href="{{ route('admin.dashboard') }}">Dasbor</a>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <form action="{{ route('admin.posters.update', $poster->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Judul Poster *</label>
                    <input type="text" id="title" name="title" value="{{ $poster->title }}" required
                        placeholder="Contoh: Belajar Huruf Hijaiyah">
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description"
                        placeholder="Deskripsi singkat tentang poster">{{ $poster->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="category">Kategori</label>
                    <input type="text" id="category" name="category" value="{{ $poster->category }}"
                        placeholder="Contoh: Bahasa Arab, Matematika, dll">
                </div>

                <div class="form-group">
                    <label for="order">Urutan Tampil</label>
                    <input type="number" id="order" name="order" value="{{ $poster->order }}" min="0" placeholder="0">
                    <small style="color: #666; display: block; margin-top: 5px;">Angka lebih kecil akan tampil lebih
                        dulu</small>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <div style="display: flex; gap: 20px; margin-top: 8px;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="radio" name="is_active" value="1" {{ $poster->is_active ? 'checked' : '' }}>
                            <span>✅ Aktif</span>
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="radio" name="is_active" value="0" {{ !$poster->is_active ? 'checked' : '' }}>
                            <span>❌ Tidak Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image">Gambar Poster</label>

                    @if($poster->image)
                        <div class="current-image">
                            <p style="color: #666; font-size: 14px; margin-bottom: 8px;">Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $poster->image) }}" alt="{{ $poster->title }}">
                        </div>
                    @endif

                    <input type="file" id="image" name="image" accept="image/*" style="margin-top: 10px;">
                    <small style="color: #666; display: block; margin-top: 5px;">Kosongkan jika tidak ingin mengubah
                        gambar. Format: JPG, PNG, max 2MB</small>

                    <img id="preview" class="image-preview" style="display: none;">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
                    <a href="{{ route('admin.posters') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Image preview
        document.getElementById('image').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>
