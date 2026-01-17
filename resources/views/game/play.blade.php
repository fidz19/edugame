@php
    $template = $session->game->template;
    $templateType = $template->template_type ?? 'quiz';
    $activeHtmlTemplate = $session->game->html_template ?: ($template->html_template ?? null);
    $activeCssStyle = $session->game->css_style ?: ($template->css_style ?? '');
    $activeJsCode = $session->game->js_code ?: ($template->js_code ?? '');

    $displayQuestionText = $question->question_text;
    if ($templateType === 'hangman') {
        if (!trim((string) $displayQuestionText)) {
            $wordLength = strlen((string) $question->correct_answer);
            $displayQuestionText = "Tebak kata ini ({$wordLength} huruf)";
        }
    } elseif (in_array($templateType, ['spell_word', 'word_search'], true) && !trim((string) $displayQuestionText)) {
        $wordLength = strlen((string) $question->correct_answer);
        $displayQuestionText = $templateType === 'spell_word'
            ? "Eja kata ini ({$wordLength} huruf)"
            : "Cari kata dengan {$wordLength} huruf";
    }

    if (in_array($templateType, ['hangman', 'crossword', 'word_search'], true)) {
        $activeJsCode = str_replace('"JAWABAN"', json_encode((string) $question->correct_answer), $activeJsCode);
    }

    $normalizeAssetPath = function (?string $path): string {
        if (!$path) {
            return '';
        }
        if (preg_match('~^https?://~i', $path)) {
            return $path;
        }
        $path = ltrim($path, '/');
        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }
        return asset('storage/' . $path);
    };

    $questionImageUrl = $normalizeAssetPath($question->image ?? null);

    $gameImages = is_array($session->game->game_images ?? null) ? $session->game->game_images : [];
    $gameImageUrl = $normalizeAssetPath($gameImages[0] ?? null);

    $templateReplacements = [
        '{{question}}' => $displayQuestionText,
        '{{QUESTION}}' => $displayQuestionText,
        '{{question_image_url}}' => $questionImageUrl ?: $gameImageUrl,
        '{{game_image_url}}' => $gameImageUrl,
    ];
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $session->game->title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .game-header {
            background: white;
            padding: 15px 30px;
            border-radius: 15px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .game-info h2 {
            color: #333;
            margin-bottom: 5px;
        }

        .game-stats {
            display: flex;
            gap: 20px;
            font-size: 14px;
            color: #666;
        }

        .game-container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
	        }

	        /* Custom CSS from database will be injected here */
	        {!! $activeCssStyle !!}

        .default-question {
            font-size: 24px;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        .default-answer-input {
            width: 100%;
            padding: 15px;
            font-size: 18px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .default-answer-input:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .feedback {
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            display: none;
            text-align: center;
            font-weight: 600;
        }

        .feedback.correct {
            background: #d1fae5;
            color: #065f46;
            display: block;
        }

        .feedback.incorrect {
            background: #fee2e2;
            color: #991b1b;
            display: block;
        }

        .btn-next {
            width: 100%;
            padding: 15px;
            background: #10b981;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 15px;
            display: none;
        }

        .btn-next:hover {
            background: #059669;
        }

        /* Multiple choice options styles */
        .options-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
        }

        .option-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .option-item:hover {
            background: #eef2ff;
            border-color: #667eea;
            transform: translateX(5px);
        }

        .option-item.selected {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: transparent;
            color: white;
        }

        .option-item.selected .option-key {
            background: white;
            color: #667eea;
        }

        .option-key {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background: #667eea;
            color: white;
            border-radius: 50%;
            font-weight: 700;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .option-text {
            font-size: 16px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="game-header">
        <div class="game-info">
            <h2>{{ $session->game->title }}</h2>
            <div class="game-stats">
                <span>👤 {{ session('student_name') }}</span>
                <span>📊 Soal: {{ $session->total_questions }}</span>
                <span>✅ Benar: {{ $session->correct_answers }}</span>
                <span>⭐ Poin: {{ $session->total_score }}</span>
            </div>
        </div>
    </div>

	    <div class="game-container">
	        @if($activeHtmlTemplate)
	            <!-- Custom template (game override or selected template) -->
	            <div id="custom-game-template">
	                {!! str_replace(array_keys($templateReplacements), array_values($templateReplacements), $activeHtmlTemplate) !!}
	            </div>

                @if($question->options && count($question->options) > 0)
                    <!-- Provide option items for template JS (hidden) -->
                    <div id="option-items-source" style="display:none">
                        @foreach($question->options as $key => $value)
                            <div class="option-item" data-value="{{ $key }}">
                                @if($templateType == 'true_false')
                                    <span class="option-key">{{ $key == 'true' ? '✅' : '❌' }}</span>
                                @else
                                    <span class="option-key">{{ $key }}</span>
                                @endif
                                <span class="option-text">{{ $value }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
	        @else
	            <!-- Default template -->
	            <div class="default-question">
	                {{ $question->question_text }}
	            </div>

	            @if($question->options && count($question->options) > 0)
	                <!-- Multiple choice / True-False options -->
	                <div class="options-container" id="options-container">
	                    @foreach($question->options as $key => $value)
	                        <div class="option-item" data-value="{{ $key }}" onclick="selectOption(this, '{{ $key }}')">
                            @if($templateType == 'true_false')
                                <span class="option-key">{{ $key == 'true' ? '✅' : '❌' }}</span>
                            @else
                                <span class="option-key">{{ $key }}</span>
                            @endif
                            <span class="option-text">{{ $value }}</span>
                        </div>
                    @endforeach
                </div>
                <input type="hidden" id="answer-input" value="">
	            @else
	                <!-- Text input for non-multiple choice -->
	                <input type="text" id="answer-input" class="default-answer-input" placeholder="Ketik jawaban Anda di sini..." autofocus>
	            @endif
	        @endif

	        <button onclick="submitAnswer()" class="btn-submit" id="submit-btn">
	            Kirim Jawaban
	        </button>

	        <div id="feedback" class="feedback"></div>
	        <button onclick="nextQuestion()" class="btn-next" id="next-btn">Soal Berikutnya →</button>
	    </div>

    <script>
        const sessionId = {{ $session->id }};
        const questionId = {{ $question->id }};
	        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

	        // Custom JS from database
	        {!! $activeJsCode !!}

            // Ensure answer input exists for template-based games
            document.addEventListener("DOMContentLoaded", function () {
                if (!document.getElementById("answer-input")) {
                    const input = document.createElement("input");
                    input.type = "hidden";
                    input.id = "answer-input";
                    input.value = "";
                    document.body.appendChild(input);
                }
            });

        // Function to select option (for multiple choice)
        function selectOption(element, value) {
            // Remove selected class from all options
            document.querySelectorAll('.option-item').forEach(item => {
                item.classList.remove('selected');
            });
            
            // Add selected class to clicked option
            element.classList.add('selected');
            
            // Set the answer value
            document.getElementById('answer-input').value = value;
        }

        // Default submit answer function
        function submitAnswer() {
            const answerInput = document.getElementById('answer-input') || document.querySelector('input[type="text"]');
            const answer = answerInput ? answerInput.value.trim() : '';

            if (!answer) {
                const isMultipleChoice = document.getElementById('options-container') !== null;
                alert(isMultipleChoice ? 'Silakan pilih salah satu jawaban!' : 'Silakan isi jawaban terlebih dahulu!');
                return;
            }

            const submitBtn = document.getElementById('submit-btn');
            if (submitBtn) submitBtn.disabled = true;

            fetch(`/session/${sessionId}/answer`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    question_id: questionId,
                    answer: answer
                })
            })
            .then(response => response.json())
            .then(data => {
                const feedback = document.getElementById('feedback');
                const nextBtn = document.getElementById('next-btn');

                if (data.correct) {
                    feedback.className = 'feedback correct';
                    feedback.innerHTML = `✅ Benar! +${data.points} poin`;
                } else {
                    feedback.className = 'feedback incorrect';
                    feedback.innerHTML = `❌ Salah! Jawaban yang benar: <strong>${data.correct_answer}</strong>`;
                }

                if (nextBtn) nextBtn.style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
                if (submitBtn) submitBtn.disabled = false;
            });
        }

        function nextQuestion() {
            window.location.href = `/session/${sessionId}/question`;
        }

        // Allow Enter key to submit
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const submitBtn = document.getElementById('submit-btn');
                if (submitBtn && !submitBtn.disabled) {
                    submitAnswer();
                }
            }
        });
    </script>
</body>
</html>
