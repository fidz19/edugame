<?php
// Magnet Kata (Word Magnet) Template
return [
    'name' => 'Magnet Kata',
    'slug' => 'magnet-kata',
    'template_type' => 'word_magnet',
    'icon' => '🧲',
    'description' => 'Game menyusun kata dengan magnet untuk membentuk kalimat yang benar.',
    'is_active' => true,
    'html_template' => '<div class="magnet-game">
    <div class="question-box">{{question}}</div>
    <div class="magnet-board" id="magnet-board"></div>
    <div class="answer-zone" id="answer-zone">Seret jawaban ke sini</div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.magnet-game { text-align: center; padding: 20px; }
.question-box { font-size: 20px; font-weight: 600; color: #333; margin-bottom: 30px; }
.magnet-board { display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; margin-bottom: 30px; min-height: 80px; }
.word-magnet { padding: 12px 20px; background: linear-gradient(180deg, #ff6b6b 0%, #ee5a5a 100%); color: white; font-weight: 700; border-radius: 8px; cursor: grab; box-shadow: 0 4px 0 #c0392b, 0 6px 10px rgba(0,0,0,0.2); transition: all 0.2s; user-select: none; }
.word-magnet:hover { transform: translateY(-2px); box-shadow: 0 6px 0 #c0392b, 0 8px 15px rgba(0,0,0,0.2); }
.word-magnet:nth-child(2n) { background: linear-gradient(180deg, #4ecdc4 0%, #44a08d 100%); box-shadow: 0 4px 0 #1e7b6e, 0 6px 10px rgba(0,0,0,0.2); }
.word-magnet:nth-child(3n) { background: linear-gradient(180deg, #a29bfe 0%, #6c5ce7 100%); box-shadow: 0 4px 0 #5649c0, 0 6px 10px rgba(0,0,0,0.2); }
.word-magnet.selected { transform: scale(1.1); box-shadow: 0 0 20px rgba(102, 126, 234, 0.5); }
.answer-zone { min-height: 80px; border: 3px dashed #ccc; border-radius: 15px; padding: 20px; color: #999; font-weight: 600; transition: all 0.3s; }
.answer-zone.has-answer { border-color: #27ae60; background: rgba(39,174,96,0.1); color: #27ae60; }
.btn-submit { margin-top: 20px; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const board = document.getElementById("magnet-board");
    const zone = document.getElementById("answer-zone");
    const options = document.querySelectorAll(".option-item");
    options.forEach(opt => {
        const key = opt.getAttribute("data-value");
        const text = opt.querySelector(".option-text").textContent;
        const magnet = document.createElement("div");
        magnet.className = "word-magnet";
        magnet.textContent = text;
        magnet.onclick = function() {
            document.querySelectorAll(".word-magnet").forEach(m => m.classList.remove("selected"));
            this.classList.add("selected");
            zone.textContent = text;
            zone.classList.add("has-answer");
            document.getElementById("answer-input").value = key;
        };
        board.appendChild(magnet);
    });
});'
];
