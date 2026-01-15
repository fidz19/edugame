<?php
// Mengeja Kata (Spell Word) Template
return [
    'name' => 'Mengeja Kata',
    'slug' => 'mengeja-kata',
    'template_type' => 'spell_word',
    'icon' => '📝',
    'description' => 'Game mengeja kata dengan menyusun huruf yang benar.',
    'is_active' => true,
    'html_template' => '<div class="spell-game">
    <div class="question-box">{{question}}</div>
    <div class="spell-input">
        <input type="text" id="word-input" placeholder="Ketik ejaan kata di sini..." autocomplete="off">
        <div class="answer-hint">Tekan Enter atau klik Kirim Jawaban.</div>
    </div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.spell-game { text-align: center; padding: 20px; }
.question-box { font-size: 20px; font-weight: 600; color: #333; margin-bottom: 30px; }
.spell-input { max-width: 420px; margin: 0 auto; }
.spell-input input { width: 100%; padding: 14px 16px; border-radius: 12px; border: 2px solid #e2e8f0; font-size: 16px; }
.spell-input input:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15); }
.answer-hint { margin-top: 8px; color: #64748b; font-size: 13px; }
.btn-submit { margin-top: 20px; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const wordInput = document.getElementById("word-input");
    const answerInput = document.getElementById("answer-input");
    wordInput.addEventListener("input", function () {
        answerInput.value = (this.value || "").trim();
    });
});'
];
