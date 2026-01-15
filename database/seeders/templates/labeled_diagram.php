<?php
// Diagram Berlabel (Labeled Diagram) Template
return [
    'name' => 'Diagram Berlabel',
    'slug' => 'diagram-berlabel',
    'template_type' => 'labeled_diagram',
    'icon' => '🏷️',
    'description' => 'Game mencocokkan label dengan bagian diagram.',
    'is_active' => true,
    'html_template' => '<div class="diagram-game">
    <div class="diagram-display">
        <img class="diagram-image" src="{{question_image_url}}" alt="Diagram"
            onerror="this.style.display=\'none\'; document.getElementById(\'diagram-placeholder\').style.display=\'flex\';">
        <div class="diagram-placeholder" id="diagram-placeholder">📊</div>
        <div class="label-points">
            <button type="button" class="label-point" data-point="1" style="top:20%;left:30%">1</button>
            <button type="button" class="label-point" data-point="2" style="top:50%;left:70%">2</button>
            <button type="button" class="label-point" data-point="3" style="top:70%;left:40%">3</button>
        </div>
    </div>
    <div class="question-text">{{question}}</div>
    <div class="helper-text">Klik titik (1/2/3) pada diagram.</div>
    <input type="hidden" id="answer-input" value="">
</div>',
    'css_style' => '
.diagram-game { text-align: center; padding: 20px; }
.diagram-display { position: relative; background: linear-gradient(135deg, #f5f7fa, #c3cfe2); height: 260px; border-radius: 20px; margin-bottom: 25px; display: flex; align-items: center; justify-content: center; overflow: hidden; }
.diagram-image { width: 100%; height: 100%; object-fit: contain; display: block; }
.diagram-placeholder { font-size: 100px; opacity: 0.3; display: none; align-items: center; justify-content: center; width: 100%; height: 100%; }
.label-points { position: absolute; top: 0; left: 0; right: 0; bottom: 0; }
.label-point { position: absolute; width: 34px; height: 34px; background: #e74c3c; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px; cursor: pointer; animation: pulse-point 2s infinite; border: 3px solid rgba(255,255,255,0.8); box-shadow: 0 6px 18px rgba(0,0,0,0.2); }
.label-point.selected { background: #10b981; animation: none; }
@keyframes pulse-point { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.2); } }
.question-text { font-size: 20px; font-weight: 600; color: #333; margin-bottom: 20px; }
.helper-text { color: #64748b; font-size: 14px; margin-top: -10px; }
.btn-submit { margin-top: 25px; }',
    'js_code' => '
document.addEventListener("DOMContentLoaded", function() {
    const answerInput = document.getElementById("answer-input");
    document.querySelectorAll(".label-point").forEach(btn => {
        btn.addEventListener("click", function () {
            document.querySelectorAll(".label-point").forEach(b => b.classList.remove("selected"));
            this.classList.add("selected");
            answerInput.value = this.getAttribute("data-point");
        });
    });
});'
];
