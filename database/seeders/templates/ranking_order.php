<?php
// Urutan Peringkat (Ranking Order) Template
return [
    'name' => 'Urutan Peringkat',
    'slug' => 'urutan-peringkat',
    'template_type' => 'ranking_order',
    'icon' => '📊',
    'description' => 'Game mengurutkan item berdasarkan peringkat yang benar.',
    'is_active' => true,
    'html_template' => '<div class="ranking-game">
    <div class="question-box">{{question}}</div>
    <div class="ranking-list" id="ranking-list"></div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.ranking-game { text-align: center; padding: 20px; }
.question-box { font-size: 20px; font-weight: 600; color: #333; margin-bottom: 30px; }
.ranking-list { max-width: 400px; margin: 0 auto; }
.ranking-item { display: flex; align-items: center; padding: 15px 20px; background: white; border: 2px solid #e0e0e0; border-radius: 12px; margin-bottom: 10px; cursor: pointer; transition: all 0.3s; }
.ranking-item:hover { border-color: #667eea; transform: translateX(5px); }
.ranking-item.selected { border-color: #27ae60; background: linear-gradient(90deg, rgba(39,174,96,0.1), white); }
.rank-number { width: 40px; height: 40px; background: linear-gradient(135deg, #667eea, #764ba2); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; margin-right: 15px; }
.ranking-item.selected .rank-number { background: linear-gradient(135deg, #27ae60, #2ecc71); }
.rank-text { font-size: 16px; font-weight: 600; color: #333; }
.btn-submit { margin-top: 20px; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const list = document.getElementById("ranking-list");
    const options = document.querySelectorAll(".option-item");
    options.forEach((opt, i) => {
        const key = opt.getAttribute("data-value");
        const text = opt.querySelector(".option-text").textContent;
        const item = document.createElement("div");
        item.className = "ranking-item";
        item.innerHTML = `<div class="rank-number">${i + 1}</div><div class="rank-text">${text}</div>`;
        item.onclick = function() {
            document.querySelectorAll(".ranking-item").forEach(it => it.classList.remove("selected"));
            this.classList.add("selected");
            document.getElementById("answer-input").value = key;
        };
        list.appendChild(item);
    });
});'
];
