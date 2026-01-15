<?php
// Kuis Gameshow Template - Gameshow TV style quiz
return [
    'name' => 'Kuis Gameshow',
    'slug' => 'kuis-gameshow',
    'template_type' => 'quiz_gameshow',
    'icon' => '🎤',
    'description' => 'Kuis interaktif bergaya gameshow TV dengan timer, animasi skor, dan efek suara.',
    'is_active' => true,
    'html_template' => '<div class="gameshow-container">
    <div class="stage-lights"></div>
    <div class="question-display">
        <div class="question-number">PERTANYAAN</div>
        <div class="question-text">{{question}}</div>
    </div>
    <div class="timer-bar"><div class="timer-fill" id="timer-fill"></div></div>
    <div class="options-grid" id="options-container"></div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.gameshow-container {
    background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
    border-radius: 20px;
    padding: 30px;
    position: relative;
    overflow: hidden;
    min-height: 400px;
}
.stage-lights {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 10px;
    background: linear-gradient(90deg, #ff0080, #ff8c00, #40e0d0, #ff0080);
    background-size: 300% 100%;
    animation: lights 3s linear infinite;
}
@keyframes lights {
    0% { background-position: 0% 50%; }
    100% { background-position: 300% 50%; }
}
.question-display {
    text-align: center;
    margin-bottom: 25px;
}
.question-number {
    color: #ffd700;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 3px;
    margin-bottom: 10px;
}
.question-text {
    color: white;
    font-size: 24px;
    font-weight: 600;
    text-shadow: 0 2px 10px rgba(0,0,0,0.5);
}
.timer-bar {
    height: 8px;
    background: rgba(255,255,255,0.2);
    border-radius: 4px;
    margin-bottom: 25px;
    overflow: hidden;
}
.timer-fill {
    height: 100%;
    background: linear-gradient(90deg, #00ff88, #00d4ff);
    width: 100%;
    transition: width 0.5s linear;
}
.options-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}
.gameshow-option {
    padding: 20px;
    border-radius: 15px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    color: white;
    transition: all 0.3s ease;
    border: 3px solid transparent;
    text-align: center;
}
.gameshow-option:nth-child(1) { background: linear-gradient(135deg, #e74c3c, #c0392b); }
.gameshow-option:nth-child(2) { background: linear-gradient(135deg, #3498db, #2980b9); }
.gameshow-option:nth-child(3) { background: linear-gradient(135deg, #f39c12, #d68910); }
.gameshow-option:nth-child(4) { background: linear-gradient(135deg, #27ae60, #1e8449); }
.gameshow-option:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
}
.gameshow-option.selected {
    border-color: #ffd700;
    box-shadow: 0 0 20px #ffd700;
}
.btn-submit {
    background: linear-gradient(135deg, #ffd700, #ff8c00) !important;
    color: #1a1a2e !important;
    font-weight: 700 !important;
    margin-top: 20px;
}',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById("options-container");
    const options = document.querySelectorAll(".option-item");
    container.innerHTML = "";
    options.forEach((opt, i) => {
        const key = opt.getAttribute("data-value");
        const text = opt.querySelector(".option-text").textContent;
        const div = document.createElement("div");
        div.className = "gameshow-option";
        div.textContent = text;
        div.onclick = function() {
            document.querySelectorAll(".gameshow-option").forEach(o => o.classList.remove("selected"));
            this.classList.add("selected");
            document.getElementById("answer-input").value = key;
        };
        container.appendChild(div);
    });
    let width = 100;
    const timer = setInterval(() => {
        width -= 0.5;
        document.getElementById("timer-fill").style.width = width + "%";
        if (width <= 0) clearInterval(timer);
    }, 150);
});'
];
