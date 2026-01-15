<?php
// Teka Teki Silang (Crossword) Template
return [
    'name' => 'Teka Teki Silang',
    'slug' => 'teka-teki-silang',
    'template_type' => 'crossword',
    'icon' => '✏️',
    'description' => 'Game teka-teki silang klasik untuk mengasah kosakata.',
    'is_active' => true,
    'html_template' => '<div class="crossword-game">
    <div class="clue-box">{{question}}</div>
    <div class="crossword-grid" id="crossword-grid"></div>
    <div class="answer-box">
        <input type="text" id="word-input" placeholder="Ketik jawaban..." autocomplete="off">
        <div class="answer-hint">Tekan Enter atau klik Kirim Jawaban.</div>
    </div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.crossword-game { text-align: center; padding: 20px; }
.clue-box { background: #ffeaa7; padding: 20px; border-radius: 15px; font-size: 18px; font-weight: 600; color: #2d3436; margin-bottom: 25px; border-left: 5px solid #fdcb6e; }
.crossword-grid { display: inline-grid; gap: 8px; margin-bottom: 20px; padding: 16px; background: #2d3436; border-radius: 12px; }
.grid-cell { width: 46px; height: 56px; background: white; display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: 800; color: #2d3436; border-radius: 8px; }
.answer-box { max-width: 420px; margin: 0 auto; }
.answer-box input { width: 100%; padding: 14px 16px; border-radius: 12px; border: 2px solid #e2e8f0; font-size: 16px; }
.answer-box input:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15); }
.answer-hint { margin-top: 8px; color: #64748b; font-size: 13px; }
.btn-submit { margin-top: 25px; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const answer = ("JAWABAN" || "").toString().trim();
    const answerLen = Math.max(3, Math.min(12, answer.length || 8));
    const grid = document.getElementById("crossword-grid");
    grid.style.gridTemplateColumns = `repeat(${answerLen}, 46px)`;

    for (let i = 0; i < answerLen; i++) {
        const div = document.createElement("div");
        div.className = "grid-cell";
        div.innerHTML = "&nbsp;";
        grid.appendChild(div);
    }

    const wordInput = document.getElementById("word-input");
    const answerInput = document.getElementById("answer-input");
    const cells = Array.from(grid.querySelectorAll(".grid-cell"));

    function renderTyped() {
        const val = (wordInput.value || "").toString().toUpperCase();
        answerInput.value = val.trim();
        cells.forEach((c, idx) => {
            c.textContent = val[idx] ? val[idx] : "";
        });
    }

    wordInput.addEventListener("input", renderTyped);
    renderTyped();
});'
];
