<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Game Baru - Portal Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: white;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #4B8BF4 0%, #3B7DE0 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
        }

        .brand-name {
            font-weight: 700;
            font-size: 1.25rem;
            color: #1e293b;
        }

        .brand-subtitle {
            font-size: 0.7rem;
            color: #4B8BF4;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            padding: 1rem 0;
            flex: 1;
        }

        .nav-item {
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .nav-item:hover {
            background: #f8fafc;
            color: #1e293b;
        }

        .nav-item.active {
            background: #EBF3FF;
            color: #4B8BF4;
            border-left-color: #4B8BF4;
        }

        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #f0f0f0;
        }



        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            min-width: 40px;
            min-height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            flex-shrink: 0;
            aspect-ratio: 1;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: #1e293b;
        }

        .user-email {
            font-size: 0.75rem;
            color: #64748b;
        }

        .btn-logout {
            width: 100%;
            margin-top: 0.75rem;
            padding: 0.5rem 1rem;
            background: #fee2e2;
            color: #dc2626;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-logout:hover {
            background: #fecaca;
            color: #b91c1c;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 1.5rem 2rem;
            max-width: 900px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            cursor: pointer;
        }

        .btn-back {
            color: #64748b;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            padding: 0.5rem 1rem;
            background: white;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            color: #1e293b;
            background: #f1f5f9;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .form-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 2rem;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .form-section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #4B8BF4;
            box-shadow: 0 0 0 3px rgba(75, 139, 244, 0.1);
        }

        .template-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .template-option {
            position: relative;
        }

        .template-option input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        .template-option label {
            display: block;
            padding: 1.25rem;
            background: #f8fafc;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
        }

        .template-option input[type="radio"]:checked+label {
            border-color: #4B8BF4;
            background: #EBF3FF;
        }

        .template-option label:hover {
            border-color: #4B8BF4;
            transform: translateY(-2px);
        }

        .template-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .template-name {
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
        }

        .template-type {
            font-size: 0.75rem;
            color: #64748b;
        }

        .btn-submit {
            background: linear-gradient(135deg, #4B8BF4 0%, #3B7DE0 100%);
            color: white;
            padding: 1rem 2rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(75, 139, 244, 0.3);
        }

        .alert {
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border: none;
        }

        .empty-templates {
            text-align: center;
            padding: 3rem;
            background: #fef3c7;
            border-radius: 12px;
            color: #92400e;
        }

        @media (max-width: 1024px) {
            .sidebar {
                width: 80px;
            }

            .sidebar-brand .brand-text,
            .nav-item span,
            .sidebar-footer .pro-card,
            .sidebar-footer .user-info {
                display: none;
            }

            .sidebar-brand {
                justify-content: center;
                padding: 1rem;
            }

            .nav-item {
                justify-content: center;
                padding: 1rem;
            }

            .user-profile {
                justify-content: center;
            }

            .main-content {
                margin-left: 80px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                flex-direction: row;
                padding: 0.5rem 1rem;
            }

            .sidebar-nav {
                display: flex;
                padding: 0;
            }

            .nav-item {
                padding: 0.5rem 1rem;
            }

            .sidebar-footer {
                display: none;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            body {
                flex-direction: column;
            }

            .template-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">📚</div>
            <div class="brand-text">
                <div class="brand-name">EduPlay</div>
                <div class="brand-subtitle">Portal Guru</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('teacher.dashboard') }}" class="nav-item">
                <span class="nav-icon">📊</span>
                <span>Dasbor</span>
            </a>
            <a href="{{ route('teacher.classes') }}" class="nav-item">
                <span class="nav-icon">👥</span>
                <span>Kelas</span>
            </a>
            <a href="{{ route('teacher.games') }}" class="nav-item active">
                <span class="nav-icon">🎮</span>
                <span>Game</span>
            </a>
            <a href="{{ route('teacher.schedules') }}" class="nav-item">
                <span class="nav-icon">📈</span>
                <span>Jadwal</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile">
                <div class="user-avatar">{{ substr(session('teacher_name', 'T'), 0, 1) }}</div>
                <div class="user-info">
                    <div class="user-name">{{ session('teacher_name') }}</div>
                    <div class="user-email">guru@sekolah.edu</div>
                </div>
            </div>
            <a href="{{ route('teacher.logout') }}" class="btn-logout">
                🚪 Keluar
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <a href="{{ route('teacher.games') }}" class="btn-back">
                ← Kembali ke Game
            </a>
            <div class="header-actions">
            </div>
        </div>

        <h1 class="page-title">➕ Buat Game Baru</h1>
        <p class="page-subtitle">Pilih template dan buat game kuis Anda sendiri</p>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card">
            @if($templates->count() > 0)
                <form action="{{ route('teacher.games.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Select Template -->
                    <div class="form-section">
                        <h3 class="form-section-title">📋 Pilih Template Game</h3>
                        <div class="template-grid">
                            @foreach($templates as $template)
                                <div class="template-option">
                                    <input type="radio" name="template_id" id="template_{{ $template->id }}"
                                        value="{{ $template->id }}" {{ old('template_id') == $template->id ? 'checked' : '' }}
                                        required>
                                    <label for="template_{{ $template->id }}">
                                        <div class="template-icon">{{ $template->icon ?? '🎮' }}</div>
                                        <div class="template-name">{{ $template->name }}</div>
                                        <div class="template-type">
                                            {{ \Illuminate\Support\Str::limit($template->description ?? (\App\Models\GameTemplate::getAvailableTypes()[$template->template_type] ?? $template->template_type), 50) }}
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Game Info -->
                    <div class="form-section">
                        <h3 class="form-section-title">🎯 Informasi Game</h3>

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Game *</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                                placeholder="Contoh: Kuis Matematika Kelas 5" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                placeholder="Brief description about this game...">{{ old('description') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <input type="text" class="form-control" id="category" name="category"
                                    value="{{ old('category') }}" placeholder="Contoh: Matematika, Sains, Sejarah" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="class" class="form-label">Pilih Kelas</label>
                                <select class="form-select" id="class" name="class">
                                    <option value="">Semua Kelas</option>
                                    @for($i = 1; $i <= 6; $i++)
                                        <option value="{{ $i }}" {{ old('class') == $i ? 'selected' : '' }}>Kelas {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                <small class="text-muted">Game hanya akan muncul untuk siswa di kelas ini.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Game Images Section -->
                    <div class="form-section">
                        <h3 class="form-section-title">🖼️ Gambar Game (Opsional)</h3>
                        <div class="mb-3">
                            <label for="game_images" class="form-label">Unggah Gambar</label>
                            <input type="file" class="form-control" id="game_images" name="game_images[]"
                                accept="image/png,image/jpeg,image/jpg,image/webp" multiple>
                            <small class="text-muted">Unggah maksimal 5 gambar (PNG, JPG, WEBP). Maks 2MB per file.</small>
                        </div>
                        <div id="image-preview" class="d-flex gap-2 flex-wrap mt-2"></div>
                    </div>

                    <button type="submit" class="btn-submit">
                        🚀 Buat Game & Tambah Soal
                    </button>
                </form>
            @else
                <div class="empty-templates">
                    <h3>⚠️ Tidak Ada Template Tersedia</h3>
                    <p>Admin belum membuat template game. Silakan hubungi admin untuk membuat template terlebih dahulu.</p>
                </div>
            @endif
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Image preview functionality
        document.getElementById('game_images')?.addEventListener('change', function (e) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = '';

            if (this.files && this.files.length > 0) {
                if (this.files.length > 5) {
                    alert('Maximum 5 images can be uploaded');
                    this.value = '';
                    return;
                }

                [...this.files].forEach((file, index) => {
                    if (file.size > 2048 * 1024) {
                        alert(`File ${file.name} is too large. Maximum 2MB per file.`);
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const div = document.createElement('div');
                        div.style.position = 'relative';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100px';
                        img.style.height = '100px';
                        img.style.objectFit = 'cover';
                        img.style.borderRadius = '8px';
                        img.style.border = '2px solid #e5e7eb';

                        div.appendChild(img);
                        preview.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            }
        });
    </script>
</body>

</html>