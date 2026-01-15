<?php
// Whack-a-mole Template
return [
    'name' => 'Whack-a-mole (Memukul Tikus Mondok)',
    'slug' => 'whack-a-mole',
    'template_type' => 'whack_a_mole',
    'icon' => '🔨',
    'description' => 'Game memukul tikus mondok yang muncul dengan jawaban benar.',
    'is_active' => true,
    'html_template' => '<div class="mole-game">
    <div class="question-box">{{question}}</div>
    <div class="mole-grid" id="mole-grid"></div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.mole-game { text-align: center; padding: 20px; background: linear-gradient(180deg, #8b4513 0%, #654321 100%); border-radius: 20px; }
.question-box { font-size: 20px; font-weight: 600; color: white; margin-bottom: 30px; padding: 20px; background: rgba(0,0,0,0.3); border-radius: 15px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); }
.mole-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; max-width: 400px; margin: 0 auto; }
.mole-hole { background: #3d2314; border-radius: 50%; height: 120px; position: relative; overflow: hidden; cursor: pointer; box-shadow: inset 0 -20px 40px rgba(0,0,0,0.5); }
.mole { position: absolute; bottom: -60px; left: 50%; transform: translateX(-50%); width: 80px; height: 80px; background: linear-gradient(180deg, #8b7355 0%, #6b5344 100%); border-radius: 50% 50% 40% 40%; transition: bottom 0.3s; display: flex; align-items: center; justify-content: center; padding: 10px; text-align: center; color: white; font-weight: 600; font-size: 12px; }
.mole::before { content: ""; position: absolute; top: 15px; left: 20px; width: 10px; height: 10px; background: #333; border-radius: 50%; }
.mole::after { content: ""; position: absolute; top: 15px; right: 20px; width: 10px; height: 10px; background: #333; border-radius: 50%; }
.mole-hole:hover .mole { bottom: 10px; }
.mole-hole.selected .mole { bottom: 10px; background: linear-gradient(180deg, #27ae60, #1e8449); }
.mole-hole.selected { box-shadow: inset 0 -20px 40px rgba(0,0,0,0.5), 0 0 20px #27ae60; }
.btn-submit { margin-top: 20px; background: #f39c12 !important; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const grid = document.getElementById("mole-grid");
    const options = document.querySelectorAll(".option-item");
    options.forEach((opt, i) => {
        const key = opt.getAttribute("data-value");
        const text = opt.querySelector(".option-text").textContent;
        const hole = document.createElement("div");
        hole.className = "mole-hole";
        hole.innerHTML = `<div class="mole"><span style="margin-top:20px">${text}</span></div>`;
        hole.onclick = function() {
            document.querySelectorAll(".mole-hole").forEach(h => h.classList.remove("selected"));
            this.classList.add("selected");
            document.getElementById("answer-input").value = key;
        };
        grid.appendChild(hole);
    });
});'
];
