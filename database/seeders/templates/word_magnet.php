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
    <div class="answer-zone" id="answer-zone">Klik magnet untuk menyusun kalimat…</div>
    <button type="button" class="magnet-reset" id="magnet-reset">Reset</button>
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
.word-magnet.selected { transform: scale(1.06); box-shadow: 0 0 20px rgba(102, 126, 234, 0.35); opacity: 0.85; }
.answer-zone { min-height: 80px; border: 3px dashed #ccc; border-radius: 15px; padding: 20px; color: #64748b; font-weight: 700; transition: all 0.3s; background: rgba(255,255,255,0.7); }
.answer-zone.has-answer { border-color: #27ae60; background: rgba(39,174,96,0.08); color: #166534; }
.magnet-reset { margin-top: 15px; padding: 10px 14px; border-radius: 12px; border: 2px solid #e2e8f0; background: white; cursor: pointer; font-weight: 700; color: #334155; }
.magnet-reset:hover { border-color: #667eea; }
.btn-submit { margin-top: 20px; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const board = document.getElementById("magnet-board");
    const zone = document.getElementById("answer-zone");
    const resetBtn = document.getElementById("magnet-reset");
    const answerInput = document.getElementById("answer-input");

    const options = Array.from(document.querySelectorAll(".option-item")).map((opt) => ({
        key: opt.getAttribute("data-value"),
        text: opt.querySelector(".option-text")?.textContent?.trim() || ""
    })).filter(o => o.key && o.text);

    let order = [];

    function renderSentence() {
        const sentence = order.map((k) => options.find(o => o.key === k)?.text || k).join(" ");
        if (sentence) {
            zone.textContent = sentence;
            zone.classList.add("has-answer");
        } else {
            zone.textContent = "Klik magnet untuk menyusun kalimat…";
            zone.classList.remove("has-answer");
        }

        if (order.length === options.length) {
            answerInput.value = JSON.stringify(order);
        } else {
            answerInput.value = "";
        }
    }

    function renderMagnets() {
        board.innerHTML = "";
        options.forEach((opt) => {
            const magnet = document.createElement("div");
            magnet.className = "word-magnet";
            magnet.textContent = opt.text;

            if (order.includes(opt.key)) {
                magnet.classList.add("selected");
            }

            magnet.addEventListener("click", () => {
                if (order.includes(opt.key)) {
                    order = order.filter((k) => k !== opt.key);
                } else {
                    order.push(opt.key);
                }
                renderMagnets();
                renderSentence();
            });

            board.appendChild(magnet);
        });
    }

    resetBtn?.addEventListener("click", () => {
        order = [];
        renderMagnets();
        renderSentence();
    });

    renderMagnets();
    renderSentence();
});'
];
