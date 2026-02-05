<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Soal - {{ $question->game->title }}</title>
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
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 14px; font-family: inherit; }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus { outline: none; border-color: #667eea; }
        .form-group textarea { min-height: 100px; resize: vertical; }
        .form-actions { display: flex; gap: 10px; margin-top: 30px; }
        .btn { padding: 12px 30px; border-radius: 8px; text-decoration: none; font-size: 14px; border: none; cursor: pointer; transition: all 0.3s; }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn-secondary { background: #6b7280; color: white; }
        .btn:hover { transform: translateY(-2px); }
        .checkbox-group { display: flex; align-items: center; gap: 10px; }
        .checkbox-group input[type="checkbox"] { width: auto; }
        .game-info { background: #f0f4ff; padding: 15px; border-radius: 10px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>✏️ Ubah Soal</h1>
        <div>
            <a href="{{ route('admin.questions', $question->game_id) }}">Kembali</a>
            <a href="{{ route('admin.games') }}">Daftar Game</a>
        </div>
    </div>

    <div class="container">
        <div class="game-info">
            <strong>Game:</strong> {{ $question->game->title }}
        </div>

        <div class="card">
            <form action="{{ route('admin.questions.update', $question->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="question_text">Pertanyaan *</label>
                    <textarea id="question_text" name="question_text" required>{{ $question->question_text }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Unggah Gambar (Opsional)</label>
                    @if($question->image)
                        <div style="margin-bottom: 10px;">
                            <img src="{{ asset($question->image) }}" style="max-width: 300px; border-radius: 10px;">
                            <p style="color: #666; font-size: 12px; margin-top: 5px;">Gambar saat ini</p>
                        </div>
                    @endif
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                    <small style="color: #666; display: block; margin-top: 5px;">Format: JPG, PNG, GIF. Max: 2MB. Kosongkan jika tidak ingin mengubah gambar.</small>
                    <img id="imagePreview" style="max-width: 300px; margin-top: 10px; display: none; border-radius: 10px;">
                </div>

                <div class="form-group">
                    <label for="correct_answer">Jawaban yang Benar *</label>
                    <input type="text" id="correct_answer" name="correct_answer" value="{{ $question->correct_answer }}" required>
                </div>

                <div class="form-group">
                    <label for="points">Poin</label>
                    <input type="number" id="points" name="points" value="{{ $question->points }}" min="1">
                </div>

                <div class="form-group">
                    <label for="difficulty">Tingkat Kesulitan</label>
                    <select id="difficulty" name="difficulty">
                        <option value="easy" {{ $question->difficulty == 'easy' ? 'selected' : '' }}>Mudah</option>
                        <option value="medium" {{ $question->difficulty == 'medium' ? 'selected' : '' }}>Sedang</option>
                        <option value="hard" {{ $question->difficulty == 'hard' ? 'selected' : '' }}>Sulit</option>
                    </select>
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ $question->is_active ? 'checked' : '' }}>
                        <label for="is_active" style="margin: 0;">Aktifkan soal ini</label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">💾 Simpan Perubahan Soal</button>
                    <a href="{{ route('admin.questions', $question->game_id) }}" class="btn btn-secondary">Batal</a>
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
