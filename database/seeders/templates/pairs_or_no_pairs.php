<?php
// Pasangan atau Tanpa Pasangan (Pairs or No Pairs) Template
return [
    'name' => 'Pasangan atau Tanpa Pasangan',
    'slug' => 'pasangan-atau-tanpa-pasangan',
    'template_type' => 'pairs_or_no_pairs',
    'icon' => '👫',
    'description' => 'Game mencocokkan pasangan item yang sesuai.',
    'is_active' => true,
    'html_template' => '<div class="pairs-game">
    <div class="question-box">{{question}}</div>
    <div class="pairs-grid" id="pairs-grid"></div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.pairs-game { text-align: center; padding: 20px; }
.question-box { font-size: 20px; font-weight: 600; color: #333; margin-bottom: 30px; }
.pairs-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; max-width: 500px; margin: 0 auto; }
.pair-card { padding: 25px 20px; background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%); border-radius: 20px; cursor: pointer; transition: all 0.3s; box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
.pair-card:nth-child(2) { background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%); }
.pair-card:nth-child(3) { background: linear-gradient(135deg, #d4fc79 0%, #96e6a1 100%); }
.pair-card:nth-child(4) { background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%); }
.pair-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
.pair-card.selected { box-shadow: 0 0 0 5px #27ae60, 0 10px 30px rgba(0,0,0,0.2); }
.pair-icon { font-size: 40px; margin-bottom: 10px; }
.pair-text { font-size: 16px; font-weight: 600; color: #333; }
.btn-submit { margin-top: 25px; }',
    'js_code' => '
const pairIcons = ["💕", "🎯", "⭐", "🌈", "🎁", "🔮"];
document.addEventListener("DOMContentLoaded", function() {
    const grid = document.getElementById("pairs-grid");
    const options = document.querySelectorAll(".option-item");
    options.forEach((opt, i) => {
        const key = opt.getAttribute("data-value");
        const text = opt.querySelector(".option-text").textContent;
        const card = document.createElement("div");
        card.className = "pair-card";
        card.innerHTML = `<div class="pair-icon">${pairIcons[i % pairIcons.length]}</div><div class="pair-text">${text}</div>`;
        card.onclick = function() {
            document.querySelectorAll(".pair-card").forEach(c => c.classList.remove("selected"));
            this.classList.add("selected");
            document.getElementById("answer-input").value = key;
        };
        grid.appendChild(card);
    });
});'
];
