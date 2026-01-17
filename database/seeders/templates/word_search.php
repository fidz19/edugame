<?php
// Mencari Kata (Word Search) Template
return [
    'name' => 'Mencari Kata',
    'slug' => 'mencari-kata',
    'template_type' => 'word_search',
    'icon' => '🔍',
    'description' => 'Game mencari kata tersembunyi dalam kotak huruf.',
    'is_active' => true,
    'html_template' => '<div class="wordsearch-game">
    <div class="hint-box">{{question}}</div>
    <div class="word-grid" id="word-grid"></div>
    <div class="answer-box">
        <input type="text" id="word-input" placeholder="Ketik kata yang kamu temukan..." autocomplete="off">
        <div class="answer-hint">Tekan Enter atau klik Kirim Jawaban.</div>
    </div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.wordsearch-game { text-align: center; padding: 20px; }
.hint-box { font-size: 18px; color: #666; margin-bottom: 20px; padding: 15px; background: #f8f9fa; border-radius: 10px; }
.word-grid { display: inline-grid; grid-template-columns: repeat(8, 40px); gap: 3px; padding: 20px; background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); margin-bottom: 20px; }
.grid-cell { width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: 700; background: #f0f0f0; border-radius: 5px; cursor: pointer; transition: all 0.2s; user-select: none; }
.grid-cell:hover { background: #667eea; color: white; }
.grid-cell.selected { background: #f39c12; color: white; }
.grid-cell.found { background: #27ae60; color: white; }
.answer-box { max-width: 420px; margin: 0 auto; }
.answer-box input { width: 100%; padding: 14px 16px; border-radius: 12px; border: 2px solid #e2e8f0; font-size: 16px; }
.answer-box input:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15); }
.answer-hint { margin-top: 8px; color: #64748b; font-size: 13px; }
.btn-submit { margin-top: 20px; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const grid = document.getElementById("word-grid");
    const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const answer = ("JAWABAN" || "").toString().trim().toUpperCase();
    const size = Math.max(8, Math.min(12, (answer.length || 8) + 2));
    grid.style.gridTemplateColumns = `repeat(${size}, 40px)`;

    const gridData = Array.from({ length: size }, () =>
        Array.from({ length: size }, () => letters[Math.floor(Math.random() * letters.length)])
    );

    if (answer) {
        const row = Math.floor(Math.random() * size);
        const maxStart = Math.max(0, size - answer.length);
        const startCol = Math.floor(Math.random() * (maxStart + 1));
        Array.from(answer).forEach((ch, idx) => {
            if (startCol + idx < size) {
                gridData[row][startCol + idx] = ch;
            }
        });
    }

    gridData.flat().forEach((ch) => {
        const cell = document.createElement("div");
        cell.className = "grid-cell";
        cell.textContent = ch;
        cell.onclick = function() { this.classList.toggle("selected"); };
        grid.appendChild(cell);
    });

    const wordInput = document.getElementById("word-input");
    const answerInput = document.getElementById("answer-input");
    wordInput.addEventListener("input", function () {
        answerInput.value = (this.value || "").trim();
    });
});'
];
