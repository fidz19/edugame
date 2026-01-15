<?php
// Benar atau Salah Template - True/False game
return [
    'name' => 'Benar atau Salah',
    'slug' => 'benar-atau-salah',
    'template_type' => 'true_false',
    'icon' => '✅',
    'description' => 'Game dengan pertanyaan benar atau salah. Siswa menentukan apakah pernyataan benar atau salah.',
    'is_active' => true,
    'html_template' => '<div class="tf-container">
    <div class="statement-card">
        <div class="statement-label">PERNYATAAN</div>
        <div class="statement-text">{{question}}</div>
    </div>
    <div class="tf-buttons">
        <button class="tf-btn tf-true" onclick="selectTF(\'true\')">
            <span class="tf-icon">✓</span>
            <span class="tf-label">BENAR</span>
        </button>
        <button class="tf-btn tf-false" onclick="selectTF(\'false\')">
            <span class="tf-icon">✗</span>
            <span class="tf-label">SALAH</span>
        </button>
    </div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.tf-container {
    text-align: center;
    padding: 20px;
}
.statement-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 40px;
    margin-bottom: 40px;
    box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
}
.statement-label {
    color: rgba(255,255,255,0.7);
    font-size: 12px;
    letter-spacing: 3px;
    margin-bottom: 15px;
}
.statement-text {
    color: white;
    font-size: 26px;
    font-weight: 600;
    line-height: 1.4;
}
.tf-buttons {
    display: flex;
    gap: 30px;
    justify-content: center;
}
.tf-btn {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    border: none;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}
.tf-true {
    background: linear-gradient(135deg, #00b894, #00cec9);
}
.tf-false {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
}
.tf-btn:hover {
    transform: scale(1.1);
}
.tf-btn.selected {
    transform: scale(1.15);
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
}
.tf-icon {
    font-size: 48px;
    color: white;
    font-weight: bold;
}
.tf-label {
    color: white;
    font-size: 16px;
    font-weight: 700;
    margin-top: 10px;
    letter-spacing: 2px;
}
.btn-submit { margin-top: 30px; }',
    'js_code' => '
function selectTF(value) {
    document.querySelectorAll(".tf-btn").forEach(b => b.classList.remove("selected"));
    document.querySelector(value === "true" ? ".tf-true" : ".tf-false").classList.add("selected");
    document.getElementById("answer-input").value = value;
}'
];
