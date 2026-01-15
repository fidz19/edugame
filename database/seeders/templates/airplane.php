<?php
// Pesawat Terbang (Airplane) Template
return [
    'name' => 'Pesawat Terbang',
    'slug' => 'pesawat-terbang',
    'template_type' => 'airplane',
    'icon' => '✈️',
    'description' => 'Game pesawat terbang interaktif untuk menjawab pertanyaan.',
    'is_active' => true,
    'html_template' => '<div class="airplane-game">
    <div class="sky-scene">
        <div class="airplane">✈️</div>
        <div class="clouds"></div>
    </div>
    <div class="question-banner">{{question}}</div>
    <div class="answer-targets" id="answer-targets"></div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.airplane-game { text-align: center; padding: 20px; background: linear-gradient(180deg, #1e3c72 0%, #2a5298 50%, #7ec8e3 100%); border-radius: 20px; min-height: 400px; }
.sky-scene { height: 150px; position: relative; overflow: hidden; }
.airplane { font-size: 50px; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); animation: fly-plane 3s ease-in-out infinite; }
@keyframes fly-plane { 0%, 100% { transform: translate(-50%, -50%) rotate(-5deg); } 50% { transform: translate(-50%, -70%) rotate(5deg); } }
.clouds { position: absolute; width: 100%; height: 100%; }
.clouds::before, .clouds::after { content: "☁️"; position: absolute; font-size: 40px; animation: move-clouds 10s linear infinite; }
.clouds::before { top: 20%; left: -50px; }
.clouds::after { top: 60%; left: -100px; animation-delay: 5s; }
@keyframes move-clouds { from { transform: translateX(-50px); } to { transform: translateX(calc(100% + 100px)); } }
.question-banner { background: rgba(255,255,255,0.95); padding: 20px; border-radius: 15px; font-size: 20px; font-weight: 600; color: #333; margin-bottom: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.2); }
.answer-targets { display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; }
.target-item { padding: 15px 30px; background: linear-gradient(135deg, #f39c12, #e67e22); color: white; font-weight: 700; border-radius: 30px; cursor: pointer; transition: all 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
.target-item:hover { transform: scale(1.1); }
.target-item.selected { background: linear-gradient(135deg, #27ae60, #2ecc71); box-shadow: 0 0 25px rgba(39,174,96,0.6); }
.btn-submit { margin-top: 25px; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById("answer-targets");
    const options = document.querySelectorAll(".option-item");
    options.forEach(opt => {
        const key = opt.getAttribute("data-value");
        const text = opt.querySelector(".option-text").textContent;
        const target = document.createElement("div");
        target.className = "target-item";
        target.textContent = text;
        target.onclick = function() {
            document.querySelectorAll(".target-item").forEach(t => t.classList.remove("selected"));
            this.classList.add("selected");
            document.getElementById("answer-input").value = key;
        };
        container.appendChild(target);
    });
});'
];
