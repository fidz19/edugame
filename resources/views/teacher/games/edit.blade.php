<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Game - {{ $game->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .btn-back {
            color: #64748b;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .btn-back:hover {
            color: #1e293b;
        }

        .section-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1.5rem;
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
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #f093fb;
            box-shadow: 0 0 0 3px rgba(240, 147, 251, 0.2);
        }

        .btn-update {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .template-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #e0e7ff;
            color: #4338ca;
            border-radius: 20px;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .question-list {
            margin-top: 1rem;
        }

        .question-item {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border-left: 4px solid #667eea;
        }

        .question-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .question-number {
            font-weight: 700;
            color: #667eea;
            font-size: 0.9rem;
        }

        .question-text {
            font-weight: 600;
            color: #1e293b;
            font-size: 1.05rem;
            margin-bottom: 0.75rem;
        }

        .options-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
        }

        .option-item {
            padding: 0.5rem 0.75rem;
            background: white;
            border-radius: 8px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .option-item.correct {
            background: #d1fae5;
            color: #065f46;
            font-weight: 600;
        }

        .question-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-sm {
            padding: 0.4rem 0.75rem;
            font-size: 0.85rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-edit-q {
            background: #fef3c7;
            color: #92400e;
        }

        .btn-delete-q {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-sm:hover {
            transform: translateY(-2px);
        }

        .add-question-form {
            background: #f0fdf4;
            border-radius: 12px;
            padding: 1.5rem;
            border: 2px dashed #86efac;
        }

        .add-question-title {
            font-weight: 700;
            color: #166534;
            margin-bottom: 1rem;
        }

        .btn-add {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(34, 197, 94, 0.4);
        }

        .form-check-input:checked {
            background-color: #22c55e;
            border-color: #22c55e;
        }

        .alert {
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        .empty-questions {
            text-align: center;
            padding: 2rem;
            color: #64748b;
            background: #f8fafc;
            border-radius: 12px;
        }

        .stats-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .stat-mini {
            background: #f8fafc;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            flex: 1;
        }

        .stat-mini-label {
            font-size: 0.8rem;
            color: #64748b;
        }

        .stat-mini-value {
            font-weight: 700;
            color: #1e293b;
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .options-list {
                grid-template-columns: 1fr;
            }

            .container-main {
                padding: 0 1rem;
            }

            .section-card {
                padding: 1.5rem;
            }

            .stats-row {
                flex-direction: column;
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
                    <span class="text-white me-3">{{ session('teacher_name') }}</span>
                    <a href="{{ route('teacher.logout') }}" class="btn-logout">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-main">
        <a href="{{ route('teacher.games') }}" class="btn-back">
            ← Kembali ke Game Saya
        </a>

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

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Game Info Section -->
        <div class="section-card">
            <h2 class="section-title">🎯 Edit Informasi Game</h2>

            @if($game->template)
                <div class="template-badge">
                    {{ $game->template->icon ?? '🎮' }} Template: {{ $game->template->name }}
                </div>
            @endif

            <div class="stats-row">
                <div class="stat-mini">
                    <div class="stat-mini-label">Total Soal</div>
                    <div class="stat-mini-value">{{ $game->questions->count() }}</div>
                </div>
                <div class="stat-mini">
                    <div class="stat-mini-label">Status</div>
                    <div class="stat-mini-value">{{ $game->is_active ? '✅ Aktif' : '❌ Tidak Aktif' }}</div>
                </div>
                <div class="stat-mini">
                    <div class="stat-mini-label">Dibuat</div>
                    <div class="stat-mini-value">{{ $game->created_at->format('d M Y') }}</div>
                </div>
            </div>

            <form action="{{ route('teacher.games.update', $game->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="title" class="form-label">Judul Game *</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title', $game->title) }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check mt-2">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" {{ $game->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Game Aktif</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description"
                        rows="3">{{ old('description', $game->description) }}</textarea>
                </div>

                <button type="submit" class="btn-update">
                    💾 Simpan Perubahan
                </button>
            </form>
        </div>

        <!-- Questions Section -->
        <div class="section-card">
            <h2 class="section-title">📝 Kelola Soal</h2>

            <!-- Add Question Form -->
            <div class="add-question-form mb-4">
                <h4 class="add-question-title">➕ Tambah Soal Baru</h4>
                
	                @php
	                    $templateType = $game->template->template_type ?? 'quiz';
	                @endphp

	                <form action="{{ route('teacher.games.questions.store', $game->id) }}" method="POST" enctype="multipart/form-data">
	                    @csrf
	                    <input type="hidden" name="template_type" value="{{ $templateType }}">

                    <div class="mb-3">
                        <label for="question_text" class="form-label">
                            @if(in_array($templateType, ['hangman', 'spell_word', 'word_search']))
                                Petunjuk/Clue *
                            @elseif($templateType == 'math_generator')
                                Soal Matematika *
                            @elseif($templateType == 'true_false')
                                Pernyataan Benar/Salah *
                            @elseif($templateType == 'crossword')
                                Clue/Petunjuk *
                            @elseif($templateType == 'labeled_diagram')
                                Petunjuk Label *
                            @else
                                Pertanyaan *
                            @endif
                        </label>
                        <textarea class="form-control" id="question_text" name="question_text" rows="2"
                            placeholder="@if(in_array($templateType, ['hangman']))Contoh: Nama hewan berkaki empat yang suka makan rumput...@elseif(in_array($templateType, ['spell_word']))Contoh: Ejaan bahasa Arab untuk 'rumah'...@elseif(in_array($templateType, ['word_search']))Contoh: Temukan kata yang artinya 'sekolah'...@elseif($templateType == 'math_generator')Contoh: 5 + 3 = ?@elseif($templateType == 'true_false')Masukkan pernyataan benar atau salah...@else Masukkan pertanyaan...@endif" required></textarea>
                    </div>

                    @php
	                        // Templates that only need text answer (word games)
	                        $textAnswerTypes = ['hangman', 'word_search', 'spell_word'];
	                        // Templates that need custom text input
	                        $customTextTypes = ['math_generator'];

	                        $requiresImageTypes = ['image_quiz', 'labeled_diagram'];
	                        $requiresFourOptionsTypes = ['quiz_gameshow', 'random_card', 'balloon_pop', 'whack_a_mole', 'flip_tiles', 'win_or_lose', 'watch_memorize', 'flying_fruit', 'airplane', 'ranking_order', 'quick_sort', 'word_magnet', 'pairs_or_no_pairs'];
	                        $needsFourOptions = in_array($templateType, $requiresFourOptionsTypes);
	                    @endphp

                    @if(in_array($templateType, $requiresImageTypes))
                        <div class="mb-3">
                            <label for="image" class="form-label">
                                @if($templateType === 'labeled_diagram')
                                    Gambar Diagram *
                                @else
                                    Gambar Soal *
                                @endif
                            </label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
                            <small class="text-muted">Format gambar (JPG/PNG/WebP), max 2MB.</small>
                        </div>
                    @endif

                    @if($templateType == 'true_false')
                        <!-- True or False -->
                        <div class="mb-3">
                            <label class="form-label">Jawaban Benar *</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="correct_answer" id="answer_true" value="true" required>
                                    <label class="form-check-label" for="answer_true">
                                        ✅ Benar
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="correct_answer" id="answer_false" value="false" required>
                                    <label class="form-check-label" for="answer_false">
                                        ❌ Salah
                                    </label>
                                </div>
                            </div>
                        </div>

                    @elseif($templateType === 'crossword')
                        <div class="mb-3">
                            <label for="correct_answer" class="form-label">Jawaban (Kata) *</label>
                            <input type="text" class="form-control" id="correct_answer" name="correct_answer"
                                placeholder="Contoh: MADRASAH" required>
                            <small class="text-muted">Masukkan 1 kata jawaban untuk teka-teki silang.</small>
                        </div>

                    @elseif($templateType === 'labeled_diagram')
                        <div class="mb-3">
                            <label for="correct_answer" class="form-label">Titik yang Benar *</label>
                            <select class="form-select" id="correct_answer" name="correct_answer" required>
                                <option value="">Pilih titik pada diagram</option>
                                <option value="1">Titik 1</option>
                                <option value="2">Titik 2</option>
                                <option value="3">Titik 3</option>
                            </select>
                            <small class="text-muted">Saat dimainkan, siswa akan klik titik 1/2/3 di gambar.</small>
                        </div>

                    @elseif(in_array($templateType, $textAnswerTypes))
                        <!-- Word games -->
                        <div class="mb-3">
                            <label for="correct_answer" class="form-label">Kata Jawaban *</label>
                            <input
                                type="text"
                                class="form-control"
                                id="correct_answer"
                                name="correct_answer"
                                placeholder="Contoh: MADRASAH"
                                autocomplete="off"
                                autocapitalize="characters"
                                spellcheck="false"
                                required
                            >
                            <small class="text-muted">Jawaban diketik (tidak butuh opsi), disimpan dalam huruf besar agar gameplay hurufnya konsisten.</small>
                        </div>

                    @elseif(in_array($templateType, ['ranking_order', 'word_magnet']))
                        <div class="alert alert-info">
                            💡 Template <strong>{{ $game->template->name ?? $templateType }}</strong> butuh <strong>4 item</strong>. Tentukan juga <strong>urutan yang benar</strong>.
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="option_a" class="form-label">Item A *</label>
                                <input type="text" class="form-control" id="option_a" name="option_a"
                                    placeholder="{{ $templateType === 'word_magnet' ? 'Kata A' : 'Item A' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="option_b" class="form-label">Item B *</label>
                                <input type="text" class="form-control" id="option_b" name="option_b"
                                    placeholder="{{ $templateType === 'word_magnet' ? 'Kata B' : 'Item B' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="option_c" class="form-label">Item C *</label>
                                <input type="text" class="form-control" id="option_c" name="option_c"
                                    placeholder="{{ $templateType === 'word_magnet' ? 'Kata C' : 'Item C' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="option_d" class="form-label">Item D *</label>
                                <input type="text" class="form-control" id="option_d" name="option_d"
                                    placeholder="{{ $templateType === 'word_magnet' ? 'Kata D' : 'Item D' }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Urutan Benar *</label>
                            <div class="row g-2">
                                @for($i = 1; $i <= 4; $i++)
                                    <div class="col-6 col-md-3">
                                        <select class="form-select" name="correct_order[]" required>
                                            <option value="">Posisi {{ $i }}</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                    </div>
                                @endfor
                            </div>
                            <small class="text-muted">Contoh urutan: A → B → C → D (tidak boleh ada yang sama).</small>
                        </div>

                    @elseif(in_array($templateType, $customTextTypes))
                        <!-- Math/Text Answer -->
                        <div class="mb-3">
                            <label for="correct_answer" class="form-label">Jawaban Benar *</label>
                            <input
                                type="text"
                                class="form-control"
                                id="correct_answer"
                                name="correct_answer"
                                placeholder="Masukkan jawaban yang benar (contoh: 8)"
                                inputmode="decimal"
                                pattern="[0-9]*"
                                autocomplete="off"
                                required
                            >
                            <small class="text-muted">Isi angka hasil perhitungan. Di game, siswa menjawab lewat keypad angka.</small>
                        </div>

                    @else
                        <!-- Multiple Choice (A, B, C, D) - Default for most games -->
                        @if($needsFourOptions)
                            <div class="alert alert-warning">
                                💡 Template <strong>{{ $game->template->name ?? $templateType }}</strong> butuh <strong>4 opsi</strong> (A, B, C, D) supaya tampilannya sesuai saat dimainkan.
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="option_a" class="form-label">Opsi A *</label>
                                <input type="text" class="form-control" id="option_a" name="option_a"
                                    placeholder="Jawaban A" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="option_b" class="form-label">Opsi B *</label>
                                <input type="text" class="form-control" id="option_b" name="option_b"
                                    placeholder="Jawaban B" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="option_c" class="form-label">Opsi C{{ $needsFourOptions ? ' *' : '' }}</label>
                                <input type="text" class="form-control" id="option_c" name="option_c"
                                    placeholder="{{ $needsFourOptions ? 'Jawaban C' : 'Jawaban C (opsional)' }}" {{ $needsFourOptions ? 'required' : '' }}>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="option_d" class="form-label">Opsi D{{ $needsFourOptions ? ' *' : '' }}</label>
                                <input type="text" class="form-control" id="option_d" name="option_d"
                                    placeholder="{{ $needsFourOptions ? 'Jawaban D' : 'Jawaban D (opsional)' }}" {{ $needsFourOptions ? 'required' : '' }}>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="correct_answer" class="form-label">Jawaban Benar *</label>
                            <select class="form-select" id="correct_answer" name="correct_answer" required>
                                <option value="">Pilih jawaban benar</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                    @endif

                    <button type="submit" class="btn-add">
                        ➕ Tambah Soal
                    </button>
                </form>
            </div>

            <!-- Questions List -->
            <h4 class="mb-3">📋 Daftar Soal ({{ $game->questions->count() }})</h4>

	            @if($game->questions->count() > 0)
	                <div class="question-list">
                        @php
                            $gameTemplateType = $game->template->template_type ?? 'quiz';
                        @endphp
	                    @foreach($game->questions as $index => $question)
	                        <div class="question-item">
                            <div class="question-header">
                                <span class="question-number">Soal #{{ $index + 1 }}</span>
                                <div class="question-actions">
                                    <form action="{{ route('teacher.games.questions.delete', [$game->id, $question->id]) }}"
                                        method="POST" style="display: inline;"
                                        onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm btn-delete-q">🗑️ Hapus</button>
                                    </form>
                                </div>
                            </div>
                            <p class="question-text">{{ $question->question_text }}</p>
                            <div class="options-list">
                                @if($question->image)
                                    <div class="option-item">
                                        🖼️ Ada gambar
                                    </div>
                                @endif

                                @if($question->options)
                                    @foreach($question->options as $key => $value)
                                        <div class="option-item {{ $question->correct_answer == $key ? 'correct' : '' }}">
                                            <strong>{{ $key }}.</strong> {{ $value }}
                                            @if($question->correct_answer == $key) ✓ @endif
                                        </div>
                                    @endforeach
                                    @if(in_array($gameTemplateType, ['ranking_order', 'word_magnet'], true))
                                        @php
                                            $decodedOrder = is_string($question->correct_answer)
                                                ? json_decode($question->correct_answer, true)
                                                : null;
                                        @endphp
                                        @if(is_array($decodedOrder) && count($decodedOrder) > 0)
                                            <div class="option-item correct">
                                                <strong>Urutan:</strong>
                                                {{ collect($decodedOrder)->map(fn ($k) => ($question->options[$k] ?? $k))->implode(' → ') }}
                                            </div>
                                        @endif
                                    @endif
	                                @else
	                                    <div class="option-item correct">
                                            @if($gameTemplateType === 'labeled_diagram')
                                                <strong>Titik:</strong> {{ $question->correct_answer }}
                                            @elseif($gameTemplateType === 'crossword')
                                                <strong>Jawaban:</strong> {{ $question->correct_answer }}
                                            @else
                                                <strong>Jawaban:</strong> {{ $question->correct_answer }}
                                            @endif
	                                    </div>
	                                @endif
	                            </div>
	                        </div>
	                    @endforeach
	                </div>
            @else
                <div class="empty-questions">
                    <p>📝 Belum ada soal untuk game ini.<br>Tambahkan soal pertama menggunakan form di atas!</p>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
