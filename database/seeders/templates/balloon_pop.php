<?php
// Pecah Balon (Balloon Pop) Template
return [
    'name' => 'Pecah Balon',
    'slug' => 'pecah-balon',
    'template_type' => 'balloon_pop',
    'icon' => '🎈',
    'description' => 'Game memecahkan balon dengan jawaban benar.',
    'is_active' => true,
    'html_template' => '<div class="balloon-game">
    <div class="question-box">{{question}}</div>
    <div class="balloons-container" id="balloons-container"></div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.balloon-game { text-align: center; padding: 20px; min-height: 400px; background: linear-gradient(180deg, #87ceeb 0%, #e0f7fa 100%); border-radius: 20px; }
.question-box { font-size: 22px; font-weight: 600; color: #333; margin-bottom: 30px; padding: 20px; background: white; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.balloons-container { display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; }
.balloon { width: 120px; height: 150px; position: relative; cursor: pointer; transition: transform 0.3s; animation: float 3s ease-in-out infinite; display: flex; flex-direction: column; align-items: center; }
.balloon:nth-child(2) { animation-delay: 0.5s; }
.balloon:nth-child(3) { animation-delay: 1s; }
.balloon:nth-child(4) { animation-delay: 1.5s; }
@keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }
.balloon:hover { transform: scale(1.1); }
.balloon-body { width: 100px; height: 120px; border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 14px; text-align: center; padding: 10px; box-shadow: inset -10px -10px 20px rgba(0,0,0,0.2); margin: 0 auto; }
.balloon:nth-child(1) .balloon-body { background: linear-gradient(135deg, #e74c3c, #c0392b); }
.balloon:nth-child(2) .balloon-body { background: linear-gradient(135deg, #3498db, #2980b9); }
.balloon:nth-child(3) .balloon-body { background: linear-gradient(135deg, #f1c40f, #f39c12); }
.balloon:nth-child(4) .balloon-body { background: linear-gradient(135deg, #2ecc71, #27ae60); }
.balloon-string { width: 2px; height: 30px; background: #666; margin: 0 auto; }
.balloon.selected { animation: pop 0.3s forwards; }
@keyframes pop { 0% { transform: scale(1); } 50% { transform: scale(1.3); } 100% { transform: scale(0); opacity: 0; } }
.btn-submit { margin-top: 20px; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById("balloons-container");
    const options = document.querySelectorAll(".option-item");
    options.forEach((opt, i) => {
        const key = opt.getAttribute("data-value");
        const text = opt.querySelector(".option-text").textContent;
        const balloon = document.createElement("div");
        balloon.className = "balloon";
        balloon.innerHTML = `<div class="balloon-body">${text}</div><div class="balloon-string"></div>`;
        balloon.onclick = function() {
            document.querySelectorAll(".balloon").forEach(b => b.classList.remove("selected"));
            this.classList.add("selected");
            document.getElementById("answer-input").value = key;
        };
        container.appendChild(balloon);
    });
});'
];
