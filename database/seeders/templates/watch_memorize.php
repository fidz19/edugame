<?php
// Tonton dan Hafalkan (Watch & Memorize) Template
return [
    'name' => 'Tonton dan Hafalkan',
    'slug' => 'tonton-dan-hafalkan',
    'template_type' => 'watch_memorize',
    'icon' => '👀',
    'description' => 'Game menghafal dengan menonton urutan atau pola.',
    'is_active' => true,
    'html_template' => '<div class="memory-game">
    <div class="memory-display" id="memory-display">
        <div class="memory-icon">👁️</div>
        <div class="memory-text">Perhatikan dengan baik!</div>
    </div>
    <div class="question-box">{{question}}</div>
    <div class="memory-options" id="memory-options"></div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.memory-game { text-align: center; padding: 20px; }
.memory-display { background: linear-gradient(135deg, #2c3e50, #34495e); padding: 40px; border-radius: 20px; margin-bottom: 25px; }
.memory-icon { font-size: 50px; animation: blink 2s ease-in-out infinite; }
@keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
.memory-text { color: #ecf0f1; font-size: 18px; margin-top: 15px; font-weight: 600; }
.question-box { font-size: 20px; font-weight: 600; color: #333; margin-bottom: 25px; }
.memory-options { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; max-width: 400px; margin: 0 auto; }
.memory-option { padding: 20px; background: linear-gradient(135deg, #74b9ff, #0984e3); color: white; border-radius: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; }
.memory-option:hover { transform: scale(1.05); }
.memory-option.selected { background: linear-gradient(135deg, #00b894, #00cec9); box-shadow: 0 0 20px rgba(0,184,148,0.5); }
.btn-submit { margin-top: 25px; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById("memory-options");
    const options = document.querySelectorAll(".option-item");
    options.forEach(opt => {
        const key = opt.getAttribute("data-value");
        const text = opt.querySelector(".option-text").textContent;
        const div = document.createElement("div");
        div.className = "memory-option";
        div.textContent = text;
        div.onclick = function() {
            document.querySelectorAll(".memory-option").forEach(o => o.classList.remove("selected"));
            this.classList.add("selected");
            document.getElementById("answer-input").value = key;
        };
        container.appendChild(div);
    });
});'
];
