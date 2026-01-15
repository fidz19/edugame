<?php
// Balik Ubin (Flip Tiles / Memory) Template
return [
    'name' => 'Balik Ubin',
    'slug' => 'balik-ubin',
    'template_type' => 'flip_tiles',
    'icon' => '🔲',
    'description' => 'Game membalik ubin untuk mencocokkan pasangan.',
    'is_active' => true,
    'html_template' => '<div class="flip-game">
    <div class="question-box">{{question}}</div>
    <div class="tiles-grid" id="tiles-grid"></div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.flip-game { text-align: center; padding: 20px; }
.question-box { font-size: 20px; font-weight: 600; color: #333; margin-bottom: 30px; }
.tiles-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; max-width: 350px; margin: 0 auto; perspective: 1000px; }
.tile { height: 100px; cursor: pointer; position: relative; transform-style: preserve-3d; transition: transform 0.6s; }
.tile.flipped { transform: rotateY(180deg); }
.tile-face { position: absolute; width: 100%; height: 100%; backface-visibility: hidden; border-radius: 15px; display: flex; align-items: center; justify-content: center; font-weight: 600; }
.tile-front { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-size: 32px; }
.tile-back { background: white; border: 3px solid #667eea; transform: rotateY(180deg); color: #333; font-size: 14px; padding: 10px; text-align: center; }
.tile.selected .tile-front { background: linear-gradient(135deg, #27ae60, #2ecc71); }
.btn-submit { margin-top: 20px; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const grid = document.getElementById("tiles-grid");
    const options = document.querySelectorAll(".option-item");
    options.forEach((opt, i) => {
        const key = opt.getAttribute("data-value");
        const text = opt.querySelector(".option-text").textContent;
        const tile = document.createElement("div");
        tile.className = "tile";
        tile.innerHTML = `<div class="tile-face tile-front">?</div><div class="tile-face tile-back">${text}</div>`;
        tile.onclick = function() {
            this.classList.toggle("flipped");
            document.querySelectorAll(".tile").forEach(t => t.classList.remove("selected"));
            if (this.classList.contains("flipped")) {
                this.classList.add("selected");
                document.getElementById("answer-input").value = key;
            }
        };
        grid.appendChild(tile);
    });
});'
];
