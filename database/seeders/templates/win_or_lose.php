<?php
// Kuis Menang atau Kalah (Win or Lose) Template
return [
    'name' => 'Kuis Menang atau Kalah',
    'slug' => 'kuis-menang-atau-kalah',
    'template_type' => 'win_or_lose',
    'icon' => '🏆',
    'description' => 'Kuis dengan sistem menang atau kalah yang menegangkan.',
    'is_active' => true,
    'html_template' => '<div class="winlose-game">
    <div class="trophy-display">🏆</div>
    <div class="stakes-text">JAWAB DENGAN BENAR UNTUK MENANG!</div>
    <div class="question-card">{{question}}</div>
    <div class="winlose-options" id="winlose-options"></div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.winlose-game { text-align: center; padding: 20px; background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%); border-radius: 20px; }
.trophy-display { font-size: 60px; margin-bottom: 10px; animation: pulse 2s ease-in-out infinite; }
@keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.1); } }
.stakes-text { color: #ffd700; font-size: 14px; font-weight: 700; letter-spacing: 2px; margin-bottom: 25px; }
.question-card { background: linear-gradient(135deg, #667eea, #764ba2); color: white; padding: 25px; border-radius: 15px; font-size: 20px; font-weight: 600; margin-bottom: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
.winlose-options { display: flex; flex-direction: column; gap: 12px; max-width: 400px; margin: 0 auto; }
.winlose-option { padding: 18px; background: rgba(255,255,255,0.1); border: 2px solid rgba(255,255,255,0.3); border-radius: 12px; color: white; font-weight: 600; cursor: pointer; transition: all 0.3s; }
.winlose-option:hover { background: rgba(255,255,255,0.2); transform: translateX(10px); }
.winlose-option.selected { background: linear-gradient(90deg, #27ae60, #2ecc71); border-color: transparent; }
.btn-submit { margin-top: 25px; background: linear-gradient(135deg, #ffd700, #ff8c00) !important; color: #1a1a2e !important; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById("winlose-options");
    const options = document.querySelectorAll(".option-item");
    options.forEach(opt => {
        const key = opt.getAttribute("data-value");
        const text = opt.querySelector(".option-text").textContent;
        const div = document.createElement("div");
        div.className = "winlose-option";
        div.textContent = text;
        div.onclick = function() {
            document.querySelectorAll(".winlose-option").forEach(o => o.classList.remove("selected"));
            this.classList.add("selected");
            document.getElementById("answer-input").value = key;
        };
        container.appendChild(div);
    });
});'
];
