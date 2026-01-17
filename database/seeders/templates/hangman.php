<?php
// Si Algojo (Hangman) Template
return [
    'name' => 'Si Algojo',
    'slug' => 'si-algojo',
    'template_type' => 'hangman',
    'icon' => '🎯',
    'description' => 'Game tebak kata klasik. Siswa menebak huruf untuk menemukan kata tersembunyi.',
    'is_active' => true,
    'html_template' => '<div class="hangman-container">
    <div class="hangman-hint">{{question}}</div>
    <div class="hangman-figure" id="hangman-figure">
        <svg width="200" height="200">
            <line x1="20" y1="180" x2="100" y2="180" stroke="#333" stroke-width="4"/>
            <line x1="60" y1="180" x2="60" y2="20" stroke="#333" stroke-width="4"/>
            <line x1="60" y1="20" x2="140" y2="20" stroke="#333" stroke-width="4"/>
            <line x1="140" y1="20" x2="140" y2="40" stroke="#333" stroke-width="4"/>
            <circle id="head" cx="140" cy="55" r="15" stroke="#333" stroke-width="3" fill="none" style="display:none"/>
            <line id="body" x1="140" y1="70" x2="140" y2="110" stroke="#333" stroke-width="3" style="display:none"/>
            <line id="larm" x1="140" y1="80" x2="120" y2="100" stroke="#333" stroke-width="3" style="display:none"/>
            <line id="rarm" x1="140" y1="80" x2="160" y2="100" stroke="#333" stroke-width="3" style="display:none"/>
            <line id="lleg" x1="140" y1="110" x2="120" y2="140" stroke="#333" stroke-width="3" style="display:none"/>
            <line id="rleg" x1="140" y1="110" x2="160" y2="140" stroke="#333" stroke-width="3" style="display:none"/>
        </svg>
    </div>
    <div class="word-display" id="word-display"></div>
    <div class="hangman-status" id="hangman-status"></div>
    <div class="keyboard" id="keyboard"></div>
    <div class="guess-word">
        <input type="text" id="guess-word-input" placeholder="Atau tebak kata..." autocomplete="off">
        <button type="button" class="guess-word-btn" id="guess-word-btn">Tebak</button>
    </div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.hangman-container { text-align: center; padding: 20px; }
.hangman-hint { font-size: 18px; color: #666; margin-bottom: 20px; font-style: italic; }
.hangman-figure { margin: 20px auto; }
.word-display { font-size: 36px; letter-spacing: 10px; margin: 30px 0; font-weight: bold; }
.word-letter { display: inline-block; width: 40px; border-bottom: 3px solid #333; margin: 0 5px; }
.word-letter.space { border-bottom: 0; width: 20px; }
.hangman-status { margin: 10px 0 20px; font-weight: 700; color: #334155; }
.keyboard { display: flex; flex-wrap: wrap; justify-content: center; gap: 8px; max-width: 500px; margin: 0 auto; }
.key-btn { width: 40px; height: 40px; border: none; border-radius: 8px; background: linear-gradient(135deg, #667eea, #764ba2); color: white; font-weight: bold; cursor: pointer; transition: all 0.2s; }
.key-btn:hover { transform: scale(1.1); }
.key-btn:disabled { background: #ccc; cursor: not-allowed; }
.key-btn.correct { background: #27ae60; }
.key-btn.wrong { background: #e74c3c; }
.guess-word { display: flex; gap: 10px; justify-content: center; margin-top: 18px; }
.guess-word input { padding: 10px 12px; border-radius: 10px; border: 2px solid #e2e8f0; min-width: 220px; }
.guess-word input:focus { outline: none; border-color: #667eea; }
.guess-word-btn { padding: 10px 14px; border-radius: 10px; border: none; background: #0ea5e9; color: white; font-weight: 700; cursor: pointer; }
.guess-word-btn:hover { background: #0284c7; }
.btn-submit { margin-top: 20px; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const parts = ["head","body","larm","rarm","lleg","rleg"];
    const maxWrong = parts.length;
    const answer = ("JAWABAN" || "").toString().trim();
    const answerUpper = answer.toUpperCase();

    const wordDisplay = document.getElementById("word-display");
    const keyboard = document.getElementById("keyboard");
    const status = document.getElementById("hangman-status");
    const answerInput = document.getElementById("answer-input");
    const guessWordInput = document.getElementById("guess-word-input");
    const guessWordBtn = document.getElementById("guess-word-btn");

    let wrongGuesses = 0;
    const revealed = Array.from(answerUpper).map(ch => (ch === " " ? " " : "_"));

    function renderWord() {
        wordDisplay.innerHTML = revealed.map(ch => {
            if (ch === " ") return `<span class="word-letter space">&nbsp;</span>`;
            return `<span class="word-letter">${ch === "_" ? "&nbsp;" : ch}</span>`;
        }).join("");
    }

    function renderStatus() {
        status.textContent = `Kesalahan: ${wrongGuesses}/${maxWrong}`;
    }

    function showPart(index) {
        const id = parts[index];
        const el = document.getElementById(id);
        if (el) el.style.display = "block";
    }

    function setFinished(win) {
        keyboard.querySelectorAll("button").forEach(b => (b.disabled = true));
        guessWordInput.disabled = true;
        guessWordBtn.disabled = true;
        status.textContent = win ? "Mantap! Kamu berhasil menebak katanya. Klik Kirim Jawaban." : "Game over. Klik Kirim Jawaban untuk lanjut.";
        answerInput.value = win ? answer : "__wrong__";
    }

    function tryLetter(letter, btn) {
        const has = answerUpper.includes(letter);
        btn.disabled = true;
        btn.classList.add(has ? "correct" : "wrong");

        if (has) {
            Array.from(answerUpper).forEach((ch, idx) => {
                if (ch === letter) revealed[idx] = letter;
            });
            renderWord();
            if (!revealed.includes("_")) {
                setFinished(true);
            }
        } else {
            showPart(wrongGuesses);
            wrongGuesses++;
            renderStatus();
            if (wrongGuesses >= maxWrong) {
                setFinished(false);
            }
        }
    }

    function buildKeyboard() {
        keyboard.innerHTML = "";
        "ABCDEFGHIJKLMNOPQRSTUVWXYZ".split("").forEach(letter => {
            const btn = document.createElement("button");
            btn.type = "button";
            btn.className = "key-btn";
            btn.textContent = letter;
            btn.onclick = function() { tryLetter(letter, btn); };
            keyboard.appendChild(btn);
        });
    }

    function submitFullGuess() {
        const guess = (guessWordInput.value || "").toString().trim();
        if (!guess) return;
        if (guess.toLowerCase() === answer.toLowerCase()) {
            setFinished(true);
        } else {
            showPart(wrongGuesses);
            wrongGuesses++;
            renderStatus();
            if (wrongGuesses >= maxWrong) {
                setFinished(false);
            }
        }
        guessWordInput.value = "";
    }

    guessWordBtn.addEventListener("click", submitFullGuess);
    guessWordInput.addEventListener("keydown", function (e) {
        if (e.key === "Enter") submitFullGuess();
    });

    renderWord();
    renderStatus();
    buildKeyboard();
});'
];
