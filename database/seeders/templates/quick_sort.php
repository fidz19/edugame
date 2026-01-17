<?php
// Penyortiran Cepat (Quick Sort) Template
return [
    'name' => 'Penyortiran Cepat',
    'slug' => 'penyortiran-cepat',
    'template_type' => 'quick_sort',
    'icon' => '⚡',
    'description' => 'Game menyortir item dengan cepat ke kategori yang tepat.',
    'is_active' => true,
    'html_template' => '<div class="quicksort-game">
    <div class="question-box">{{question}}</div>
    <div class="sort-hint">Klik item yang masuk <strong>Kategori A</strong>.</div>
    <div class="sort-zones">
        <div class="sort-zone zone-left" id="zone-left">
            <span class="zone-label">Kategori A</span>
            <div class="zone-slot" id="zone-slot">Pilih item di bawah</div>
        </div>
        <div class="sort-zone zone-right" id="zone-right"><span class="zone-label">Kategori B</span></div>
    </div>
    <div class="items-to-sort" id="items-to-sort"></div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.quicksort-game { text-align: center; padding: 20px; }
.question-box { font-size: 20px; font-weight: 600; color: #333; margin-bottom: 20px; }
.sort-hint { color: #64748b; margin-top: -10px; margin-bottom: 20px; font-size: 14px; }
.sort-zones { display: flex; gap: 20px; margin-bottom: 30px; }
.sort-zone { flex: 1; min-height: 120px; border: 3px dashed #ccc; border-radius: 15px; padding: 15px; display: flex; flex-direction: column; align-items: center; transition: all 0.3s; }
.zone-left { border-color: #3498db; background: rgba(52,152,219,0.1); }
.zone-right { border-color: #e74c3c; background: rgba(231,76,60,0.1); }
.zone-label { font-weight: 700; color: #666; margin-bottom: 10px; }
.zone-slot { background: white; border-radius: 12px; padding: 12px 16px; min-height: 44px; width: 100%; max-width: 220px; font-weight: 700; color: #334155; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
.zone-left.active { border-color: #27ae60; background: rgba(39,174,96,0.12); }
.items-to-sort { display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; }
.sort-item { padding: 15px 25px; background: linear-gradient(135deg, #667eea, #764ba2); color: white; font-weight: 600; border-radius: 12px; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 15px rgba(0,0,0,0.2); }
.sort-item:hover { transform: translateY(-3px); }
.sort-item.selected { background: linear-gradient(135deg, #27ae60, #2ecc71); box-shadow: 0 0 20px rgba(39,174,96,0.5); }
.btn-submit { margin-top: 20px; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById("items-to-sort");
    const zoneSlot = document.getElementById("zone-slot");
    const zoneLeft = document.getElementById("zone-left");
    const answerInput = document.getElementById("answer-input");
    const options = document.querySelectorAll(".option-item");
    options.forEach(opt => {
        const key = opt.getAttribute("data-value");
        const text = opt.querySelector(".option-text").textContent;
        const item = document.createElement("div");
        item.className = "sort-item";
        item.textContent = text;
        item.onclick = function() {
            const isSelected = this.classList.contains("selected");
            document.querySelectorAll(".sort-item").forEach(it => it.classList.remove("selected"));

            if (isSelected) {
                zoneSlot.textContent = "Pilih item di bawah";
                zoneLeft.classList.remove("active");
                answerInput.value = "";
                return;
            }

            this.classList.add("selected");
            zoneSlot.textContent = text;
            zoneLeft.classList.add("active");
            answerInput.value = key;
        };
        container.appendChild(item);
    });
});'
];
