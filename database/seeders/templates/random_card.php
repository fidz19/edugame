<?php
// Kartu Acak (Random Cards) Template
return [
    'name' => 'Kartu Acak',
    'slug' => 'kartu-acak',
    'template_type' => 'random_card',
    'icon' => '🃏',
    'description' => 'Game kartu yang diacak secara random. Siswa memilih kartu untuk menjawab pertanyaan.',
    'is_active' => true,
    'html_template' => '<div class="cards-container">
    <div class="question-card" id="question-card">
        <div class="card-front">
            <div class="card-icon">❓</div>
            <div class="card-text">Klik untuk membuka kartu!</div>
        </div>
        <div class="card-back">
            <div class="card-question">{{question}}</div>
        </div>
    </div>
    <div class="answer-cards" id="answer-cards"></div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.cards-container { text-align: center; padding: 20px; perspective: 1000px; }
.question-card { width: 280px; height: 180px; margin: 0 auto 40px; cursor: pointer; position: relative; transform-style: preserve-3d; transition: transform 0.6s; }
.question-card.flipped { transform: rotateY(180deg); }
.card-front, .card-back { position: absolute; width: 100%; height: 100%; backface-visibility: hidden; border-radius: 20px; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 20px; }
.card-front { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
.card-back { background: white; border: 3px solid #667eea; transform: rotateY(180deg); }
.card-icon { font-size: 48px; margin-bottom: 10px; }
.card-text { font-size: 16px; font-weight: 600; }
.card-question { font-size: 20px; color: #333; font-weight: 600; }
.answer-cards { display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; }
.answer-card { width: 150px; height: 100px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 16px; cursor: pointer; transition: all 0.3s; box-shadow: 0 5px 20px rgba(0,0,0,0.2); padding: 15px; text-align: center; }
.answer-card:hover { transform: translateY(-5px) scale(1.05); }
.answer-card.selected { background: linear-gradient(135deg, #27ae60, #2ecc71); box-shadow: 0 0 20px rgba(39,174,96,0.5); }
.btn-submit { margin-top: 30px; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const qCard = document.getElementById("question-card");
    qCard.onclick = function() { this.classList.add("flipped"); };
    const container = document.getElementById("answer-cards");
    const options = document.querySelectorAll(".option-item");
    options.forEach(opt => {
        const key = opt.getAttribute("data-value");
        const text = opt.querySelector(".option-text").textContent;
        const card = document.createElement("div");
        card.className = "answer-card";
        card.textContent = text;
        card.onclick = function() {
            document.querySelectorAll(".answer-card").forEach(c => c.classList.remove("selected"));
            this.classList.add("selected");
            document.getElementById("answer-input").value = key;
        };
        container.appendChild(card);
    });
});'
];
