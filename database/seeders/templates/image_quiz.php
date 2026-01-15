<?php
// Kuis Gambar (Image Quiz) Template
return [
    'name' => 'Kuis Gambar',
    'slug' => 'kuis-gambar',
    'template_type' => 'image_quiz',
    'icon' => '🖼️',
    'description' => 'Kuis berbasis gambar. Siswa menjawab pertanyaan berdasarkan gambar.',
    'is_active' => true,
    'html_template' => '<div class="image-quiz">
    <div class="image-display">
        <img class="quiz-image" src="{{question_image_url}}" alt="Gambar soal"
            onerror="this.style.display=\'none\'; document.getElementById(\'image-placeholder\').style.display=\'flex\';">
        <div class="image-placeholder" id="image-placeholder">🖼️</div>
    </div>
    <div class="question-text">{{question}}</div>
    <div class="image-options" id="image-options"></div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.image-quiz { text-align: center; padding: 20px; }
.image-display { background: linear-gradient(135deg, #f5f7fa, #c3cfe2); height: 240px; border-radius: 20px; margin-bottom: 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 20px rgba(0,0,0,0.1); position: relative; overflow: hidden; }
.quiz-image { width: 100%; height: 100%; object-fit: contain; display: block; }
.image-placeholder { font-size: 80px; opacity: 0.5; display: none; align-items: center; justify-content: center; width: 100%; height: 100%; }
.question-text { font-size: 22px; font-weight: 600; color: #333; margin-bottom: 25px; }
.image-options { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; max-width: 500px; margin: 0 auto; }
.image-option { padding: 20px; background: white; border: 3px solid #e0e0e0; border-radius: 15px; cursor: pointer; transition: all 0.3s; font-weight: 600; font-size: 16px; }
.image-option:hover { border-color: #667eea; transform: scale(1.02); }
.image-option.selected { border-color: #27ae60; background: linear-gradient(135deg, rgba(39,174,96,0.1), white); color: #27ae60; }
.btn-submit { margin-top: 25px; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById("image-options");
    const options = document.querySelectorAll(".option-item");
    options.forEach(opt => {
        const key = opt.getAttribute("data-value");
        const text = opt.querySelector(".option-text").textContent;
        const div = document.createElement("div");
        div.className = "image-option";
        div.textContent = text;
        div.onclick = function() {
            document.querySelectorAll(".image-option").forEach(o => o.classList.remove("selected"));
            this.classList.add("selected");
            document.getElementById("answer-input").value = key;
        };
        container.appendChild(div);
    });
});'
];
