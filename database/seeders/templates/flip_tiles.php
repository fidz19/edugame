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
    <div class="status" id="flip-status">Balik ubin untuk mencari pasangan yang sama.</div>
    <div class="tiles-grid" id="tiles-grid"></div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.flip-game { text-align: center; padding: 20px; }
.question-box { font-size: 20px; font-weight: 600; color: #333; margin-bottom: 30px; }
.status { margin-top: -18px; margin-bottom: 18px; color: #64748b; font-weight: 600; }
.tiles-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; max-width: 520px; margin: 0 auto; perspective: 1000px; }
.tile { height: 100px; cursor: pointer; position: relative; transform-style: preserve-3d; transition: transform 0.6s; }
.tile.flipped { transform: rotateY(180deg); }
.tile-face { position: absolute; width: 100%; height: 100%; backface-visibility: hidden; border-radius: 15px; display: flex; align-items: center; justify-content: center; font-weight: 600; }
.tile-front { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-size: 32px; }
.tile-back { background: white; border: 3px solid #667eea; transform: rotateY(180deg); color: #333; font-size: 14px; padding: 10px; text-align: center; }
.tile.matched { cursor: default; }
.tile.matched .tile-front { background: linear-gradient(135deg, #27ae60, #2ecc71); }
.btn-submit { margin-top: 20px; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const grid = document.getElementById("tiles-grid");
    const status = document.getElementById("flip-status");
    const answerInput = document.getElementById("answer-input");

    const options = Array.from(document.querySelectorAll(".option-item")).map((opt) => ({
        key: opt.getAttribute("data-value"),
        text: opt.querySelector(".option-text")?.textContent?.trim() || ""
    })).filter(o => o.key && o.text);

    // Duplicate each option to form pairs, then shuffle
    const tiles = options.flatMap((o) => ([
        { key: o.key, text: o.text, id: o.key + "-1" },
        { key: o.key, text: o.text, id: o.key + "-2" },
    ])).sort(() => Math.random() - 0.5);

    let flipped = [];
    let lock = false;

    function setStatus(message) {
        if (status) status.textContent = message;
    }

    tiles.forEach((t) => {
        const tile = document.createElement("div");
        tile.className = "tile";
        tile.dataset.key = t.key;
        tile.dataset.text = t.text;
        tile.dataset.id = t.id;
        tile.innerHTML = `<div class="tile-face tile-front">?</div><div class="tile-face tile-back">${t.text}</div>`;

        tile.addEventListener("click", () => {
            if (lock) return;
            if (tile.classList.contains("matched")) return;
            if (tile.classList.contains("flipped")) return;

            tile.classList.add("flipped");
            flipped.push(tile);

            if (flipped.length < 2) return;

            lock = true;
            const [a, b] = flipped;
            const match = a.dataset.text === b.dataset.text;

            if (match) {
                a.classList.add("matched");
                b.classList.add("matched");
                answerInput.value = a.dataset.key;
                setStatus(`Pasangan ditemukan: ${a.dataset.text}`);
                flipped = [];
                lock = false;
                return;
            }

            setStatus("Belum cocok, coba lagi…");
            setTimeout(() => {
                a.classList.remove("flipped");
                b.classList.remove("flipped");
                flipped = [];
                lock = false;
            }, 650);
        });

        grid.appendChild(tile);
    });
});'
];
