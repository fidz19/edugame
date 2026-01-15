<?php
// Generator Matematika Template
return [
    'name' => 'Generator Matematika',
    'slug' => 'generator-matematika',
    'template_type' => 'math_generator',
    'icon' => '🔢',
    'description' => 'Game matematika dengan soal yang ditampilkan secara interaktif.',
    'is_active' => true,
    'html_template' => '<div class="math-game">
    <div class="math-display">
        <div class="math-problem">{{question}}</div>
    </div>
    <div class="number-pad" id="number-pad"></div>
    <div class="math-input-display" id="math-input-display">?</div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.math-game { text-align: center; padding: 20px; }
.math-display { background: #1a1a2e; padding: 30px; border-radius: 20px; margin-bottom: 30px; }
.math-problem { font-size: 36px; color: #00ff88; font-family: "Courier New", monospace; font-weight: 700; text-shadow: 0 0 20px rgba(0,255,136,0.5); }
.math-input-display { font-size: 48px; font-weight: 700; color: #667eea; padding: 20px; border: 3px solid #667eea; border-radius: 15px; margin-bottom: 20px; min-width: 150px; display: inline-block; }
.number-pad { display: grid; grid-template-columns: repeat(4, 70px); gap: 10px; justify-content: center; margin-bottom: 20px; }
.num-btn { width: 70px; height: 70px; font-size: 24px; font-weight: 700; border: none; border-radius: 15px; cursor: pointer; transition: all 0.2s; }
.num-btn.number { background: linear-gradient(135deg, #667eea, #764ba2); color: white; }
.num-btn.operator { background: linear-gradient(135deg, #f39c12, #e67e22); color: white; }
.num-btn.clear { background: linear-gradient(135deg, #e74c3c, #c0392b); color: white; }
.num-btn:hover { transform: scale(1.1); }
.btn-submit { margin-top: 20px; }',
    'js_code' => '
let mathInput = "";
document.addEventListener("DOMContentLoaded", function() {
    const pad = document.getElementById("number-pad");
    const display = document.getElementById("math-input-display");
    const options = document.querySelectorAll(".option-item");
    if (options.length > 0) {
        options.forEach(opt => {
            const key = opt.getAttribute("data-value");
            const text = opt.querySelector(".option-text").textContent;
            const btn = document.createElement("button");
            btn.className = "num-btn number";
            btn.textContent = text;
            btn.onclick = function() {
                document.querySelectorAll(".num-btn").forEach(b => b.style.boxShadow = "none");
                this.style.boxShadow = "0 0 20px #27ae60";
                display.textContent = text;
                document.getElementById("answer-input").value = key;
            };
            pad.appendChild(btn);
        });
    } else {
        for (let i = 1; i <= 9; i++) {
            const btn = document.createElement("button");
            btn.className = "num-btn number";
            btn.textContent = i;
            btn.onclick = function() { addToMath(i); };
            pad.appendChild(btn);
        }
        const zero = document.createElement("button");
        zero.className = "num-btn number";
        zero.textContent = "0";
        zero.onclick = function() { addToMath(0); };
        pad.appendChild(zero);
        const clear = document.createElement("button");
        clear.className = "num-btn clear";
        clear.textContent = "C";
        clear.onclick = clearMath;
        pad.appendChild(clear);
    }
});
function addToMath(val) {
    mathInput += val;
    document.getElementById("math-input-display").textContent = mathInput;
    document.getElementById("answer-input").value = mathInput;
}
function clearMath() {
    mathInput = "";
    document.getElementById("math-input-display").textContent = "?";
    document.getElementById("answer-input").value = "";
}'
];
