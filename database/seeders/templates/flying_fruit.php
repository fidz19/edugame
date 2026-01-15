<?php
// Buah Terbang (Flying Fruit) Template
return [
    'name' => 'Buah Terbang',
    'slug' => 'buah-terbang',
    'template_type' => 'flying_fruit',
    'icon' => '🍎',
    'description' => 'Game menangkap buah yang terbang dengan jawaban benar.',
    'is_active' => true,
    'html_template' => '<div class="fruit-game">
    <div class="sky-bg"></div>
    <div class="question-box">{{question}}</div>
    <div class="flying-fruits" id="flying-fruits"></div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.fruit-game { text-align: center; padding: 20px; background: linear-gradient(180deg, #87ceeb 0%, #98d8f0 50%, #b4e7c8 100%); border-radius: 20px; min-height: 400px; position: relative; overflow: hidden; }
.sky-bg { position: absolute; top: 0; left: 0; right: 0; bottom: 0; }
.sky-bg::before { content: "☁️"; position: absolute; top: 20px; left: 10%; font-size: 40px; animation: float-cloud 8s linear infinite; }
.sky-bg::after { content: "☁️"; position: absolute; top: 50px; right: 20%; font-size: 30px; animation: float-cloud 12s linear infinite; }
@keyframes float-cloud { from { transform: translateX(-100px); } to { transform: translateX(calc(100vw + 100px)); } }
.question-box { position: relative; z-index: 10; font-size: 20px; font-weight: 600; color: #333; padding: 20px; background: rgba(255,255,255,0.9); border-radius: 15px; margin-bottom: 30px; }
.flying-fruits { display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; position: relative; z-index: 10; }
.fruit-item { font-size: 60px; cursor: pointer; animation: fly 3s ease-in-out infinite; transition: transform 0.2s; position: relative; }
.fruit-item:nth-child(1) { animation-delay: 0s; }
.fruit-item:nth-child(2) { animation-delay: 0.5s; }
.fruit-item:nth-child(3) { animation-delay: 1s; }
.fruit-item:nth-child(4) { animation-delay: 1.5s; }
@keyframes fly { 0%, 100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-20px) rotate(10deg); } }
.fruit-item:hover { transform: scale(1.2); }
.fruit-item.selected { animation: catch 0.5s forwards; }
@keyframes catch { to { transform: scale(1.5); filter: drop-shadow(0 0 20px gold); } }
.fruit-label { font-size: 12px; position: absolute; bottom: -20px; left: 50%; transform: translateX(-50%); background: white; padding: 5px 10px; border-radius: 10px; white-space: nowrap; }
.btn-submit { margin-top: 20px; position: relative; z-index: 10; }',
    'js_code' => '
const fruitEmojis = ["🍎", "🍊", "🍋", "🍇", "🍓", "🍑", "🥝", "🍌"];
document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById("flying-fruits");
    const options = document.querySelectorAll(".option-item");
    options.forEach((opt, i) => {
        const key = opt.getAttribute("data-value");
        const text = opt.querySelector(".option-text").textContent;
        const fruit = document.createElement("div");
        fruit.className = "fruit-item";
        fruit.innerHTML = fruitEmojis[i % fruitEmojis.length] + `<div class="fruit-label">${text}</div>`;
        fruit.onclick = function() {
            document.querySelectorAll(".fruit-item").forEach(f => f.classList.remove("selected"));
            this.classList.add("selected");
            document.getElementById("answer-input").value = key;
        };
        container.appendChild(fruit);
    });
});'
];
