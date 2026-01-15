<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>World Games Languages - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* RESET DASAR */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to bottom, #87ceeb 0%, #e0f7fa 100%);
      color: #2c3e50;
      overflow-x: hidden;
    }

    /* BACKGROUND AWAN BERGERAK */
    .clouds {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: -1;
    }

    .cloud {
      position: absolute;
      background: white;
      border-radius: 50%;
      opacity: 0.9;
      box-shadow: 0 0 30px rgba(255, 255, 255, 0.8);
      animation: drift linear infinite;
    }

    .cloud1 {
      width: 300px;
      height: 100px;
      top: 15%;
      animation-duration: 120s;
      animation-delay: -20s;
    }

    .cloud2 {
      width: 250px;
      height: 80px;
      top: 30%;
      animation-duration: 140s;
      animation-delay: -40s;
    }

    .cloud3 {
      width: 400px;
      height: 120px;
      top: 45%;
      animation-duration: 160s;
      animation-delay: -60s;
    }

    .cloud4 {
      width: 200px;
      height: 70px;
      top: 60%;
      animation-duration: 130s;
      animation-delay: -10s;
    }

    .cloud5 {
      width: 350px;
      height: 110px;
      top: 10%;
      animation-duration: 150s;
      animation-delay: -80s;
    }

    @keyframes drift {
      0% {
        transform: translateX(100vw);
      }

      100% {
        transform: translateX(-100%);
      }
    }

    /* HEADER */
    header {
      background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
      color: #1e293b;
      padding: 20px 6%;
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(148, 163, 184, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: all 0.3s ease;
    }

    .logo-container {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .logo {
      width: 56px;
      height: 56px;
      background: linear-gradient(135deg, #ffffff, #ffffff);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.6rem;
      font-weight: 800;
      color: white;
      box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
      transition: all 0.3s ease;
    }

    .logo:hover {
      transform: scale(1.05) rotate(5deg);
    }

    .logo-text {
      font-size: 1.6rem;
      font-weight: 800;
      color: #1e293b;
    }

    .subtitle {
      font-size: 0.95rem;
      color: #64748b;
      margin-top: 2px;
    }

    nav ul {
      list-style: none;
      display: flex;
      align-items: center;
      gap: 48px;
    }

    nav a {
      color: #1e293b;
      text-decoration: none;
      font-size: 1.1rem;
      font-weight: 600;
      padding: 8px 16px;
      border-radius: 12px;
      transition: all 0.3s ease;
      position: relative;
    }

    nav a:hover {
      color: #3b82f6;
      transform: translateY(-2px);
    }

    nav a::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, #3b82f6, #1d4ed8);
      transition: all 0.3s ease;
      transform: translateX(-50%);
    }

    nav a:hover::after {
      width: 80%;
    }

    /* Login Cards Styling */
    .login-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 25px;
      margin-top: 40px;
      max-width: 900px;
      margin-left: auto;
      margin-right: auto;
    }

    .login-card {
      background: white;
      padding: 30px 25px;
      border-radius: 20px;
      text-align: center;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      cursor: pointer;
      border: 3px solid transparent;
    }

    .login-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .login-card.student {
      border-color: #FFD700;
    }

    .login-card.teacher {
      border-color: #f093fb;
    }

    .login-card.parent {
      border-color: #667eea;
    }

    .login-card-icon {
      font-size: 3.5rem;
      margin-bottom: 15px;
    }

    .login-card h3 {
      font-size: 1.5rem;
      margin-bottom: 10px;
      color: #1e293b;
      font-weight: 700;
    }

    .login-card p {
      font-size: 1rem;
      color: #64748b;
      margin-bottom: 20px;
      line-height: 1.5;
    }

    .btn-card {
      width: 100%;
      padding: 12px 24px;
      border: none;
      border-radius: 50px;
      font-size: 1rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-student {
      background: linear-gradient(135deg, #FFD700, #FFA500);
      color: #1e293b;
      box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
    }

    .btn-student:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(255, 215, 0, 0.6);
    }

    .btn-teacher {
      background: linear-gradient(135deg, #f093fb, #f5576c);
      color: white;
      padding: 14px 32px;
      border: none;
      border-radius: 50px;
      font-size: 1.1rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 6px 20px rgba(240, 147, 251, 0.4);
    }

    .btn-teacher:hover {
      background: linear-gradient(135deg, #f5576c, #f093fb);
      transform: translateY(-3px);
      box-shadow: 0 12px 30px rgba(240, 147, 251, 0.6);
    }

    .btn-parent {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      padding: 14px 32px;
      border: none;
      border-radius: 50px;
      font-size: 1.1rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-parent:hover {
      background: linear-gradient(135deg, #764ba2, #667eea);
      transform: translateY(-3px);
      box-shadow: 0 12px 30px rgba(102, 126, 234, 0.6);
    }

    main {
      padding-top: 140px;
      position: relative;
      z-index: 1;
    }

    .hero {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 40px 8% 140px;
      min-height: 80vh;
      background: transparent;
    }

    .hero-content {
      max-width: 50%;
      background: rgba(255, 255, 255, 0.85);
      padding: 40px 40px;
      margin: 10px;
      border-radius: 30px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(8px);
    }

    .hero h1 {
      font-size: 3.8rem;
      margin-bottom: 28px;
      line-height: 1.15;
      color: #1e3a8a;
      font-weight: 800;
      background: linear-gradient(135deg, #1e3a8a, #3b82f6);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .hero p {
      font-size: 1.45rem;
      margin-bottom: 20px;
      margin-top: 20px;
      line-height: 1.7;
      color: #334155;
    }

    .hero-image {
      max-width: 45%;
      text-align: right;
    }

    .hero-image img {
      width: 100%;
      max-width: 570px;
      border-radius: 550px;
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
    }

    .hero-image img:hover {
      transform: scale(1.05);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    }

    .btn-primary {
      background: linear-gradient(135deg, #3b82f6, #1d4ed8);
      color: white;
      padding: 18px 44px;
      border: none;
      border-radius: 50px;
      font-size: 1.25rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 8px 24px rgba(59, 130, 246, 0.4);
    }

    .btn-primary:hover {
      transform: translateY(-5px);
      box-shadow: 0 16px 40px rgba(59, 130, 246, 0.5);
    }

    .games-section {
      padding: 120px 8% 140px;
      text-align: center;
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(12px);
      border-radius: 40px 50px 0 0;
      margin-top: -80px;
    }

    .games-section h2 {
      font-size: 3.2rem;
      margin-bottom: 20px;
      color: #1e3a8a;
      font-weight: 800;
      background: linear-gradient(135deg, #1e3a8a, #3b82f6);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .games-section p {
      font-size: 1.3rem;
      color: #334155;
      margin-bottom: 60px;
      max-width: 800px;
      margin-left: auto;
      margin-right: auto;
    }

    .games-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 40px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .game-card {
      background: white;
      border-radius: 30px;
      padding: 40px 30px;
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
      transition: all 0.4s ease;
      text-align: center;
      position: relative;
      overflow: hidden;
      border: 4px solid #FFD700;
    }

    .game-card:hover {
      transform: translateY(-15px) scale(1.03);
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
      border-color: #FFEC8B;
    }

    .card-icon {
      font-size: 4rem;
      margin-bottom: 20px;
      opacity: 0.9;
    }

    .game-card h3 {
      font-size: 1.8rem;
      margin-bottom: 16px;
      color: #1e293b;
    }

    .game-card p {
      font-size: 1.1rem;
      color: #64748b;
      margin-bottom: 30px;
    }

    .game-btn {
      background: #FFD700;
      color: #1e293b;
      padding: 14px 32px;
      border: none;
      border-radius: 50px;
      font-size: 1.1rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
    }

    .game-btn:hover {
      background: #FFEC8B;
      transform: translateY(-3px);
      box-shadow: 0 12px 30px rgba(255, 215, 0, 0.6);
    }

    .btn-gamelain {
      display: block;
      width: fit-content;
      max-width: 400px;
      margin: 40px auto 0 auto;
      background: linear-gradient(135deg, #ffc756, #ffd608);
      color: rgb(0, 0, 0);
      padding: 18px 44px;
      border: none;
      border-radius: 50px;
      font-size: 1.25rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 8px 24px rgba(255, 200, 86, 0.4);
      text-align: center;
    }

    .btn-gamelain:hover {
      transform: translateY(-5px);
      box-shadow: 0 16px 40px rgba(255, 200, 86, 0.5);
    }

    .parents-section {
      padding: 120px 8% 140px;
      background: linear-gradient(135deg, #e0f2fe 0%, #ddd6fe 50%, #fce7f3 100%);
      backdrop-filter: blur(12px);
      border-radius: 50px 50px 0 0;
      position: relative;
      overflow: hidden;
    }

    .parents-section::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -10%;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, rgba(147, 197, 253, 0.3), transparent);
      border-radius: 50%;
      animation: float 20s ease-in-out infinite;
    }

    .parents-section::after {
      content: '';
      position: absolute;
      bottom: -30%;
      left: -5%;
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(196, 181, 253, 0.3), transparent);
      border-radius: 50%;
      animation: float 15s ease-in-out infinite reverse;
    }

    @keyframes float {

      0%,
      100% {
        transform: translate(0, 0) scale(1);
      }

      50% {
        transform: translate(-30px, -30px) scale(1.1);
      }
    }

    .parents-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 60px;
      position: relative;
      z-index: 1;
    }

    .parents-image {
      max-width: 50%;
      text-align: left;
      position: relative;
    }

    .parents-image::before {
      content: '💙';
      position: absolute;
      top: -20px;
      left: -20px;
      font-size: 3rem;
      animation: pulse 2s ease-in-out infinite;
    }

    .parents-image::after {
      content: '⭐';
      position: absolute;
      bottom: -10px;
      right: -10px;
      font-size: 2.5rem;
      animation: pulse 2s ease-in-out infinite 0.5s;
    }

    @keyframes pulse {

      0%,
      100% {
        transform: scale(1);
        opacity: 0.8;
      }

      50% {
        transform: scale(1.2);
        opacity: 1;
      }
    }

    .parents-image img {
      width: 100%;
      max-width: 550px;
      border-radius: 40px;
      box-shadow: 0 20px 60px rgba(102, 126, 234, 0.3);
      transition: all 0.4s ease;
      border: 5px solid rgba(255, 255, 255, 0.8);
    }

    .parents-image img:hover {
      transform: scale(1.05) rotate(-2deg);
      box-shadow: 0 25px 70px rgba(102, 126, 234, 0.4);
    }

    .parents-text {
      max-width: 50%;
      background: rgba(255, 255, 255, 0.95);
      padding: 50px 45px;
      border-radius: 35px;
      box-shadow: 0 15px 50px rgba(102, 126, 234, 0.2);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 255, 255, 0.5);
      position: relative;
      overflow: hidden;
    }

    .parents-text::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, #667eea, #764ba2, #667eea);
      background-size: 200% 100%;
      animation: gradientShift 3s ease infinite;
    }

    @keyframes gradientShift {

      0%,
      100% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }
    }

    .parents-text h2 {
      font-size: 3rem;
      margin-bottom: 24px;
      color: #1e3a8a;
      font-weight: 800;
      background: linear-gradient(135deg, #667eea, #764ba2);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      position: relative;
      display: inline-block;
    }

    .parents-text p {
      font-size: 1.3rem;
      color: #334155;
      margin-bottom: 32px;
      line-height: 1.8;
    }

    .parents-list {
      list-style: none;
      margin-bottom: 40px;
    }

    .parents-list li {
      font-size: 1.15rem;
      margin-bottom: 20px;
      padding: 15px 20px 15px 50px;
      position: relative;
      color: #1e293b;
      background: rgba(147, 197, 253, 0.1);
      border-radius: 15px;
      transition: all 0.3s ease;
      border-left: 4px solid #667eea;
    }

    .parents-list li:hover {
      background: rgba(147, 197, 253, 0.2);
      transform: translateX(10px);
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.15);
    }

    .parents-list li::before {
      content: '✔';
      position: absolute;
      left: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: #667eea;
      font-weight: bold;
      font-size: 1.3rem;
    }

    .btn-parents {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      padding: 18px 44px;
      border: none;
      border-radius: 50px;
      font-size: 1.25rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
      position: relative;
      overflow: hidden;
    }

    .btn-parents::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.2);
      transform: translate(-50%, -50%);
      transition: width 0.6s, height 0.6s;
    }

    .btn-parents:hover::before {
      width: 300px;
      height: 300px;
    }

    .btn-parents:hover {
      transform: translateY(-5px);
      box-shadow: 0 16px 40px rgba(102, 126, 234, 0.5);
    }

    @media (max-width: 1024px) {
      .hero {
        flex-direction: column;
        text-align: center;
        padding: 100px 5%;
      }

      .hero-content {
        max-width: 100%;
      }

      .hero-image {
        max-width: 70%;
        margin-top: 50px;
      }

      .hero h1 {
        font-size: 3rem;
      }

      .parents-content {
        flex-direction: column;
        text-align: center;
      }

      .parents-image,
      .parents-text {
        max-width: 100%;
      }

      .parents-text {
        text-align: left;
      }

      .parents-section {
        padding: 100px 5%;
      }
    }

    @media (max-width: 768px) {
      nav ul {
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
      }

      .login-cards {
        grid-template-columns: 1fr;
        gap: 15px;
      }

      .login-card {
        padding: 25px 20px;
      }

      .login-card-icon {
        font-size: 3rem;
      }

      .login-card h3 {
        font-size: 1.3rem;
      }

      .login-card p {
        font-size: 0.95rem;
      }

      .parents-text h2 {
        font-size: 2.5rem;
      }
    }
  </style>
</head>

<body>
  <div class="clouds">
    <div class="cloud cloud1"></div>
    <div class="cloud cloud2"></div>
    <div class="cloud cloud3"></div>
    <div class="cloud cloud4"></div>
    <div class="cloud cloud5"></div>
  </div>

  <header id="header">
    <div class="logo-container">
      <div class="logo">🌏</div>
      <div>
        <div class="logo-text">World Languages Games⭐</div>
        <div class="subtitle">Belajar Bahasa Sambil Bermain</div>
      </div>
    </div>

    <nav>
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#games">Games</a></li>
        <li><a href="#parents">For Parents</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="hero" id="home">
      <div class="hero-content">
        <h1>Belajar Bahasa <br>Sambil Bermain Dengan Permainan Yang Seru!</h1>
        <p>Pilih cara masuk sesuai peran Anda:</p>

        <div class="login-cards">
          <!-- Student Login Card -->
          <div class="login-card student" onclick="showLoginModal()">
            <div class="login-card-icon">🎮</div>
            <h3>Login Siswa</h3>
            <p>Ayo bermain dan belajar bahasa dengan seru!</p>
            <button class="btn-card btn-student">Masuk Sebagai Siswa</button>
          </div>

          <!-- Teacher Login Card -->
          <div class="login-card teacher" onclick="window.location.href='{{ route('teacher.login') }}'">
            <div class="login-card-icon">👨‍🏫</div>
            <h3>Login Guru</h3>
            <p>Monitor perkembangan belajar siswa Anda</p>
            <button class="btn-card btn-teacher">Masuk Sebagai Guru</button>
          </div>

          <!-- Parent Login Card -->
          <div class="login-card parent" onclick="window.location.href='{{ route('parent.login') }}'">
            <div class="login-card-icon">👨‍👩‍👧‍👦</div>
            <h3>Login Orang Tua</h3>
            <p>Pantau perkembangan belajar anak Anda</p>
            <button class="btn-card btn-parent">Masuk Sebagai Orang Tua</button>
          </div>
        </div>
      </div>

      <div class="hero-image">
        <img src="{{ asset('images/anakbelajar.jpg') }}" alt="Anak belajar">
      </div>
    </section>

    <section class="games-section" id="games">
      <h2>Pilih Permainan Yang Kamu Inginkan! 🌟</h2>
      <p>Belajar bahasa sambil bermain yuk🎮</p>

      <div class="games-grid">
        <div class="game-card">
          <div class="card-icon">🌍</div>
          <h3>Petualangan Bahasa Arab</h3>
          <p>Ayo belajar bahasa Arab dengan cara yang seru! Cocokkan kata-kata bahasa Inggris dengan bahasa Arab. Siapa
            yang paling cepat?</p>
          <form action="{{ route('games.start', 'mencocokan-bahasa-inggris-arab') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="game-btn" style="border: none; cursor: pointer; width: 100%;">🚀 Ayo Mainkan
              Sekarang</button>
          </form>
        </div>

        <div class="game-card">
          <div class="card-icon">🧩</div>
          <h3>Teka-Teki Silang Seru</h3>
          <p>Apa kamu bisa menebak benda apakah itu? Isi teka-teki silang dengan nama-nama alat tulis! Asah otakmu!</p>
          <form action="{{ route('games.start', 'tts-alat-tulis') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="game-btn" style="border: none; cursor: pointer; width: 100%;">🎮 Ayo Mainkan
              Sekarang</button>
          </form>
        </div>

        <div class="game-card">
          <div class="card-icon">📖</div>
          <h3>Petualangan Huruf Hijaiyah</h3>
          <p>Berapa banyak huruf hijaiyah yang ada? Ayo hitung bersama dan pelajari huruf-huruf Arab dengan cara yang
            menyenangkan!</p>
          <form action="{{ route('games.start', 'menghitung-huruf-hijaiyah') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="game-btn" style="border: none; cursor: pointer; width: 100%;">✨ Ayo Mainkan
              Sekarang</button>
          </form>
        </div>
      </div>
      <a href="{{ route('games.index') }}" class="btn-gamelain" style="text-decoration: none;">Lebih banyak game</a>
    </section>

    <section class="games-section" style="background: linear-gradient(135deg, #caf0f8 0%, #ade8f4 100%);">
      <h2>📸 Poster Hari ini!</h2>
      <p>Ayo Lihat dan pelajari Kosa Kata baru dengan poster-poster edukatif yang menarik!</p>

      @php
        $posters = \App\Models\Poster::active()->ordered()->take(3)->get();
      @endphp

      @if($posters->count() > 0)
        <div class="games-grid">
          @foreach($posters as $poster)
            <div class="game-card">
              <img src="{{ asset($poster->image) }}" alt="{{ $poster->title }}"
                style="width: 100%; height: 200px; object-fit: cover; border-radius: 15px 15px 0 0;">
              <div style="padding: 20px;">
                <h3 style="margin-bottom: 10px;">{{ $poster->title }}</h3>
                <p style="color: #666; font-size: 14px;">{{ Str::limit($poster->description, 80) }}</p>
                @if($poster->category)
                  <span
                    style="display: inline-block; background: #e0e7ff; color: #4c51bf; padding: 4px 12px; border-radius: 12px; font-size: 12px; margin-top: 10px;">{{ $poster->category }}</span>
                @endif
              </div>
            </div>
          @endforeach
        </div>
        <a href="{{ route('posters.index') }}" class="btn-gamelain" style="text-decoration: none;">Lihat Semua Poster</a>
      @else
        <p style="text-align: center; color: #999; padding: 40px 0;">Belum ada poster tersedia saat ini.</p>
      @endif
    </section>

    <section class="parents-section" id="parents">
      <div class="parents-content">
        <div class="parents-image">
          <img src="{{ asset('images/family.jpg') }}" alt="Orang tua dan anak belajar bersama">
        </div>

        <div class="parents-text">
          <h2>Untuk Orang Tua: Belajar Bahasa Jadi Mudah & Menyenangkan!</h2>
          <p>Kami paham kekhawatiran orang tua soal pendidikan anak. Dengan World Languages Games, anak belajar bahasa
            dengan menyenangkan. Berikut beberapa manfaatnya:</p>

          <ul class="parents-list">
            <li><strong>Aman & Terawasi</strong> Aman untuk anak, anak-anak dapat belajar dengan baik</li>
            <li><strong>Belajar Tanpa Tekanan</strong> Game edukatif membuat anak belajar sambil bermain, bukan belajar
              formal.</li>
            <li><strong>Laporan Kemajuan</strong> Pantau perkembangan bahasa anak secara real-time melalui login sebagai
              orang tua.</li>
            <li><strong>Fleksibel</strong> Bisa dimainkan kapan saja, di HP atau tablet.</li>
            <li><strong>Gratis</strong> Permainan disini semuanya gratis! dan materinya sesuai dengan apa yang anak anda
              pelajari!</li>
          </ul>

          <button class="btn-parents" onclick="showParentLoginModal()">Lihat Dashboard Orang Tua</button>
        </div>
      </div>
    </section>
  </main>

  <!-- Student Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="border-radius: 30px; border: none;">
        <div class="modal-header"
          style="background: linear-gradient(135deg, #ffcc00, #ffd608); border: none; padding: 2rem; border-radius: 30px 30px 0 0;">
          <h5 class="modal-title"
            style="color: #1e293b; font-size: 2rem; font-weight: 700; width: 100%; text-align: center;">
            🎮 Ayo Mulai Bermain!
          </h5>
        </div>
        <div class="modal-body" style="padding: 2.5rem;">
          @if(session('error'))
            <div class="alert alert-warning"
              style="background: #fff3cd; border: 2px solid #ffc107; border-radius: 15px; margin-bottom: 1.5rem; padding: 1rem;">
              <div style="font-size: 2rem; text-align: center; margin-bottom: 0.5rem;">😊</div>
              <div style="color: #856404; text-align: center; font-size: 1rem; line-height: 1.6;">
                {{ session('error') }}
              </div>
            </div>
          @endif

          <form action="{{ route('student.login') }}" method="POST">
            @csrf
            <div class="mb-4">
              <label class="form-label">📝 Siapa namamu?</label>
              <input type="text" class="form-control" name="nama_anak" required placeholder="Masukkan nama kamu..."
                value="{{ old('nama_anak') }}">
            </div>

            <div class="mb-4">
              <label class="form-label">🎓 Kamu kelas berapa?</label>
              <select class="form-select" name="kelas" required>
                <option value="">Pilih kelas...</option>
                <option value="1" {{ old('kelas') == '1' ? 'selected' : '' }}>Kelas 1</option>
                <option value="2" {{ old('kelas') == '2' ? 'selected' : '' }}>Kelas 2</option>
                <option value="3" {{ old('kelas') == '3' ? 'selected' : '' }}>Kelas 3</option>
                <option value="4" {{ old('kelas') == '4' ? 'selected' : '' }}>Kelas 4</option>
                <option value="5" {{ old('kelas') == '5' ? 'selected' : '' }}>Kelas 5</option>
                <option value="6" {{ old('kelas') == '6' ? 'selected' : '' }}>Kelas 6</option>
              </select>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn-primary" style="width: 100%; font-size: 1.3rem; padding: 1rem;">
                🚀 Mulai Petualangan!
              </button>
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                style="border-radius: 50px; padding: 0.8rem; font-weight: 600;">
                Batal
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Parent Login Modal -->
  <div class="modal fade" id="parentLoginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="border-radius: 30px; border: none;">
        <div class="modal-header"
          style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); border: none; padding: 2rem; border-radius: 30px 30px 0 0;">
          <h5 class="modal-title"
            style="color: white; font-size: 2rem; font-weight: 700; width: 100%; text-align: center;">
            👨‍👩‍👧 Login Orang Tua
          </h5>
        </div>
        <div class="modal-body" style="padding: 2.5rem;">
          <form action="{{ route('parent.login') }}" method="POST">
            @csrf
            <div class="mb-4">
              <label class="form-label" style="font-weight: 600; color: #1e293b; font-size: 1.2rem;">
                <span style="font-size: 2rem; margin-right: 0.5rem;">📧</span>Email Orang Tua
              </label>
              <input type="email" class="form-control" name="email" required placeholder="Masukkan email Anda..."
                style="border-radius: 15px; padding: 1rem; border: 2px solid #E5E7EB; font-size: 1.1rem;">
            </div>

            <div class="mb-4">
              <label class="form-label" style="font-weight: 600; color: #1e293b; font-size: 1.2rem;">
                <span style="font-size: 2rem; margin-right: 0.5rem;">🔑</span>Kata Sandi
              </label>
              <input type="password" class="form-control" name="password" required placeholder="Masukkan password..."
                style="border-radius: 15px; padding: 1rem; border: 2px solid #E5E7EB; font-size: 1.1rem;">
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn-parents" style="width: 100%; font-size: 1.3rem; padding: 1rem;">
                🚀 Lihat Progress Anak
              </button>
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                style="border-radius: 50px; padding: 0.8rem; font-weight: 600;">
                Batal
              </button>
            </div>
          </form>

          <div class="text-center mt-3" style="padding-top: 15px; border-top: 1px solid #e0e0e0;">
            <p style="color: #666; font-size: 14px;">Belum punya akun?
              <a href="{{ route('parent.register') }}"
                style="color: #3b82f6; font-weight: 600; text-decoration: none;">Daftar di sini</a>
            </p>
          </div>
        </div>


        <!-- Enhanced Footer -->
        <footer
          style="background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%); color: white; padding: 60px 8% 20px; position: relative; z-index: 1; margin-top: 80px;">
          <div style="max-width: 1200px; margin: 0 auto;">
            <!-- Footer Content -->
            <div
              style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; margin-bottom: 40px;">

              <!-- About Section -->
              <div>
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                  <div style="font-size: 2.5rem;">🌏</div>
                  <div>
                    <h3 style="margin: 0; font-size: 1.3rem; font-weight: 700;">World Languages Games</h3>
                    <p style="margin: 0; font-size: 0.85rem; color: rgba(255,255,255,0.8);">Belajar Bahasa Sambil
                      Bermain</p>
                  </div>
                </div>
                <p style="color: rgba(255,255,255,0.9); line-height: 1.6; font-size: 0.95rem;">
                  Platform edukatif untuk anak-anak belajar bahasa dengan cara yang menyenangkan melalui permainan
                  interaktif.
                </p>
              </div>

              <!-- Quick Links -->
              <div>
                <h4 style="font-size: 1.1rem; margin-bottom: 20px; font-weight: 700;">Menu Cepat</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                  <li style="margin-bottom: 12px;">
                    <a href="#home"
                      style="color: rgba(255,255,255,0.9); text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;">
                      <span>🏠</span> Beranda
                    </a>
                  </li>
                  <li style="margin-bottom: 12px;">
                    <a href="#games"
                      style="color: rgba(255,255,255,0.9); text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;">
                      <span>🎮</span> Permainan
                    </a>
                  </li>
                  <li style="margin-bottom: 12px;">
                    <a href="#parents"
                      style="color: rgba(255,255,255,0.9); text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;">
                      <span>👨‍👩‍👧</span> Untuk Orang Tua
                    </a>
                  </li>
                  <li style="margin-bottom: 12px;">
                    <a href="{{ route('posters.index') }}"
                      style="color: rgba(255,255,255,0.9); text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;">
                      <span>📸</span> Poster Edukatif
                    </a>
                  </li>
                </ul>
              </div>

              <!-- Login Links -->
              <div>
                <h4 style="font-size: 1.1rem; margin-bottom: 20px; font-weight: 700;">Akses Login</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                  <li style="margin-bottom: 12px;">
                    <a href="javascript:void(0)" onclick="showLoginModal()"
                      style="color: rgba(255,255,255,0.9); text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;">
                      <span>🎮</span> Login Siswa
                    </a>
                  </li>
                  <li style="margin-bottom: 12px;">
                    <a href="{{ route('parent.login') }}"
                      style="color: rgba(255,255,255,0.9); text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;">
                      <span>👨‍🏫</span> Login Guru/Orang Tua
                    </a>
                  </li>
                  <li style="margin-bottom: 12px;">
                    <a href="{{ route('parent.register') }}"
                      style="color: rgba(255,255,255,0.9); text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;">
                      <span>📝</span> Daftar Akun Baru
                    </a>
                  </li>
                  <li style="margin-bottom: 12px;">
                    <a href="/admin"
                      style="color: rgba(255,255,255,0.9); text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;">
                      <span>⚙️</span> Admin Panel
                    </a>
                  </li>
                </ul>
              </div>

              <!-- Contact Info -->
              <div>
                <h4 style="font-size: 1.1rem; margin-bottom: 20px; font-weight: 700;">Hubungi Kami</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                  <li
                    style="margin-bottom: 12px; color: rgba(255,255,255,0.9); display: flex; align-items: center; gap: 8px;">
                    <span>📧</span> info@worldlanguagesgames.com
                  </li>
                  <li
                    style="margin-bottom: 12px; color: rgba(255,255,255,0.9); display: flex; align-items: center; gap: 8px;">
                    <span>📱</span> +62 xxx-xxxx-xxxx
                  </li>
                  <li
                    style="margin-bottom: 12px; color: rgba(255,255,255,0.9); display: flex; align-items: center; gap: 8px;">
                    <span>🌐</span> www.worldlanguagesgames.com
                  </li>
                </ul>
              </div>
            </div>

            <!-- Footer Bottom -->
            <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 30px; text-align: center;">
              <p style="margin: 0 0 15px 0; font-size: 0.95rem;">
                © 2025 World Languages Games • Dikembangkan dengan ❤️ oleh <span
                  style="color: #FFD700; font-weight: bold;">Sedjati Flora Game ⭐</span>
              </p>
              <p style="margin: 0; font-size: 0.85rem; color: rgba(255,255,255,0.7);">
                Platform edukatif untuk mendukung pembelajaran bahasa anak Indonesia
              </p>
            </div>
          </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
          function showLoginModal() {
            const modal = new bootstrap.Modal(document.getElementById('loginModal'));
            modal.show();
          }

          function showParentLoginModal() {
            const modal = new bootstrap.Modal(document.getElementById('parentLoginModal'));
            modal.show();
          }

          // Auto-show login modal if there's an error or show_login flag
          @if(session('error') || session('show_login'))
            document.addEventListener('DOMContentLoaded', function () {
              showLoginModal();
            });
          @endif

          window.addEventListener('scroll', () => {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
              header.classList.add('scrolled');
            } else {
              header.classList.remove('scrolled');
            }
          });
        </script>
</body>

</html>