<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Saya - Dashboard Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            padding: 1rem 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
            text-decoration: none;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 600;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white !important;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-logout:hover {
            background: white;
            color: #f5576c;
        }

        .container-main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: #1e293b;
        }

        .btn-create {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-create:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .game-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .game-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .game-card-body {
            padding: 1.5rem;
        }

        .game-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .game-meta {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .meta-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .meta-badge.template {
            background: #e0e7ff;
            color: #4338ca;
        }

        .meta-badge.questions {
            background: #dcfce7;
            color: #166534;
        }

        .meta-badge.active {
            background: #d1fae5;
            color: #065f46;
        }

        .meta-badge.inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .game-description {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .game-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background: #fef3c7;
            color: #92400e;
        }

        .btn-edit:hover {
            background: #fde68a;
            color: #78350f;
        }

        .btn-delete {
            background: #fee2e2;
            color: #991b1b;
            border: none;
            cursor: pointer;
        }

        .btn-delete:hover {
            background: #fecaca;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #64748b;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .alert {
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .container-main {
                padding: 0 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('teacher.dashboard') }}">
                👨‍🏫 Dashboard Guru
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('teacher.dashboard') }}">📊 Statistik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('teacher.games') }}">🎮 Game Saya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('teacher.schedules') }}">📅 Jadwal</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <span class="text-white me-3">{{ $teacher->name }}</span>
                    <a href="{{ route('teacher.logout') }}" class="btn-logout">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-main">
        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">🎮 Game Saya</h1>
            <a href="{{ route('teacher.games.create') }}" class="btn-create">
                ➕ Buat Game Baru
            </a>
        </div>

        <!-- Games List -->
        @if($games->count() > 0)
            @foreach($games as $game)
                <div class="game-card">
                    <div class="game-card-body">
                        <h3 class="game-title">{{ $game->title }}</h3>
                        <div class="game-meta">
                            @if($game->template)
                                <span class="meta-badge template">
                                    {{ $game->template->icon ?? '🎯' }} {{ $game->template->name }}
                                </span>
                            @endif
                            <span class="meta-badge questions">
                                📝 {{ $game->questions->count() }} Soal
                            </span>
                            <span class="meta-badge {{ $game->is_active ? 'active' : 'inactive' }}">
                                {{ $game->is_active ? '✅ Aktif' : '❌ Tidak Aktif' }}
                            </span>
                        </div>
                        @if($game->description)
                            <p class="game-description">{{ Str::limit($game->description, 150) }}</p>
                        @endif
                        <div class="game-actions">
                            <a href="{{ route('teacher.games.edit', $game->id) }}" class="btn-action btn-edit">
                                ✏️ Edit & Kelola Soal
                            </a>
                            <form action="{{ route('teacher.games.delete', $game->id) }}" method="POST" style="display: inline;"
                                class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-state">
                <div class="empty-state-icon">🎮</div>
                <p>Anda belum membuat game apapun.<br>Mulai buat game dari template yang tersedia!</p>
                <a href="{{ route('teacher.games.create') }}" class="btn-create">
                    ➕ Buat Game Pertama
                </a>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // SweetAlert2 for delete confirmation
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '🗑️ Hapus Game?',
                    html: '<p style="font-size: 1.1rem; color: #64748b;">Game dan semua soal di dalamnya akan dihapus permanen!</p>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#94a3b8',
                    confirmButtonText: '✓ Ya, Hapus!',
                    cancelButtonText: '✗ Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'swal-custom',
                        title: 'swal-title',
                        confirmButton: 'swal-confirm',
                        cancelButton: 'swal-cancel'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Show success message if exists
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '✅ Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#22c55e',
                confirmButtonText: 'OK',
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        // Show error message if exists
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: '❌ Gagal!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
    <style>
        .swal-custom {
            border-radius: 20px !important;
            padding: 2rem !important;
        }
        .swal-title {
            font-size: 1.8rem !important;
            font-weight: 700 !important;
        }
        .swal-confirm {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
            color: white !important;
            padding: 0.75rem 2rem !important;
            border-radius: 10px !important;
            font-weight: 600 !important;
            border: none !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
        }
        .swal-confirm:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.4) !important;
        }
        .swal-cancel {
            background: #f1f5f9 !important;
            color: #475569 !important;
            padding: 0.75rem 2rem !important;
            border-radius: 10px !important;
            font-weight: 600 !important;
            border: none !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
        }
        .swal-cancel:hover {
            background: #e2e8f0 !important;
        }
    </style>
</body>

</html>