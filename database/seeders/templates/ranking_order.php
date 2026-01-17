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
    <div class="ranking-hint">Klik item sesuai urutan (1 → 4).</div>
    <div class="ranking-pool" id="ranking-pool"></div>
    <div class="ranking-selected" id="ranking-selected"></div>
    <button type="button" class="ranking-reset" id="ranking-reset">Reset</button>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.ranking-game { text-align: center; padding: 20px; }
.question-box { font-size: 20px; font-weight: 600; color: #333; margin-bottom: 30px; }
.ranking-hint { color: #64748b; margin-top: -20px; margin-bottom: 20px; font-size: 14px; }
.ranking-pool { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; max-width: 520px; margin: 0 auto 20px; }
.pool-item { padding: 14px 16px; background: white; border: 2px solid #e0e0e0; border-radius: 12px; cursor: pointer; transition: all 0.2s; font-weight: 700; color: #334155; }
.pool-item:hover { border-color: #667eea; transform: translateY(-2px); }
.pool-item.used { opacity: 0.5; cursor: not-allowed; transform: none; }
.ranking-selected { max-width: 520px; margin: 0 auto 15px; border: 2px dashed #cbd5e1; border-radius: 14px; padding: 12px; min-height: 72px; display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
.selected-item { display: flex; align-items: center; gap: 10px; background: linear-gradient(135deg, rgba(102,126,234,0.1), rgba(118,75,162,0.1)); border: 1px solid rgba(102,126,234,0.25); border-radius: 12px; padding: 10px 12px; text-align: left; }
.selected-rank { width: 30px; height: 30px; border-radius: 50%; background: linear-gradient(135deg, #667eea, #764ba2); color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; flex-shrink: 0; }
.selected-text { font-weight: 700; color: #1e293b; font-size: 14px; }
.ranking-reset { padding: 10px 14px; border-radius: 12px; border: 2px solid #e2e8f0; background: white; cursor: pointer; font-weight: 700; color: #334155; }
.ranking-reset:hover { border-color: #667eea; }
.btn-submit { margin-top: 20px; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const pool = document.getElementById("ranking-pool");
    const selected = document.getElementById("ranking-selected");
    const resetBtn = document.getElementById("ranking-reset");
    const answerInput = document.getElementById("answer-input");

    const options = Array.from(document.querySelectorAll(".option-item")).map((opt) => ({
        key: opt.getAttribute("data-value"),
        text: opt.querySelector(".option-text")?.textContent?.trim() || ""
    })).filter(o => o.key && o.text);

    let order = [];

    function renderSelected() {
        selected.innerHTML = "";
        order.forEach((key, idx) => {
            const option = options.find(o => o.key === key);
            const div = document.createElement("div");
            div.className = "selected-item";
            div.innerHTML = `<div class="selected-rank">${idx + 1}</div><div class="selected-text">${option ? option.text : key}</div>`;
            selected.appendChild(div);
        });

        if (order.length === options.length) {
            answerInput.value = JSON.stringify(order);
        } else {
            answerInput.value = "";
        }
    }

    function renderPool() {
        pool.innerHTML = "";
        options.forEach((opt) => {
            const btn = document.createElement("button");
            btn.type = "button";
            btn.className = "pool-item";
            btn.textContent = opt.text;

            if (order.includes(opt.key)) {
                btn.classList.add("used");
                btn.disabled = true;
            }

            btn.addEventListener("click", () => {
                if (order.includes(opt.key)) return;
                order.push(opt.key);
                renderPool();
                renderSelected();
            });

            pool.appendChild(btn);
        });
    }

    resetBtn?.addEventListener("click", () => {
        order = [];
        renderPool();
        renderSelected();
    });

    renderPool();
    renderSelected();
});'
];
