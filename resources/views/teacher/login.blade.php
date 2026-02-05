<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Guru - Taman Belajar Sedjati</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap');

        :root {
            --ink: #0f172a;
            --muted: #64748b;
            --border: #e2e8f0;
            --card: #ffffff;
            --shadow: 0 28px 70px rgba(15, 23, 42, 0.18);
            --shadow-soft: 0 16px 40px rgba(15, 23, 42, 0.12);
            --paper: #f8fafc;
        }

        * , *::before, *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--ink);
            background: radial-gradient(circle at 20% 20%, #c7d2fe 0%, transparent 38%),
                radial-gradient(circle at 80% 18%, #fde68a 0%, transparent 40%),
                radial-gradient(circle at 70% 80%, #bae6fd 0%, transparent 45%),
                var(--paper);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 20px 64px;
            overflow-x: hidden;
        }

        body.theme-teacher {
            --accent: #1d4ed8;
            --accent-deep: #1e40af;
            --accent-soft: #dbeafe;
            --accent-warm: #f59e0b;
            --soft: #e0f2fe;
            --visual-bg: linear-gradient(135deg, #fde68a, #bfdbfe 55%, #c7d2fe 100%);
        }

        body::before {
            content: "";
            position: fixed;
            inset: -20% -10%;
            background: radial-gradient(circle at 15% 10%, rgba(37, 99, 235, 0.15), transparent 45%),
                radial-gradient(circle at 85% 15%, rgba(245, 158, 11, 0.18), transparent 45%),
                radial-gradient(circle at 70% 85%, rgba(14, 165, 233, 0.2), transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: "";
            position: fixed;
            inset: 0;
            background-image: linear-gradient(rgba(148, 163, 184, 0.12) 1px, transparent 1px),
                linear-gradient(90deg, rgba(148, 163, 184, 0.12) 1px, transparent 1px);
            background-size: 32px 32px;
            opacity: 0.35;
            pointer-events: none;
            z-index: 0;
        }

        .bg-shapes {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
        }

        .shape {
            position: absolute;
            opacity: 0.25;
            filter: blur(0.2px);
        }

        .shape.star {
            width: 48px;
            height: 48px;
            border: 3px solid #f59e0b;
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
            top: 16%;
            right: 12%;
        }

        .shape.dot {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0));
            bottom: 12%;
            left: 8%;
        }

        .auth-shell {
            width: min(1120px, 100%);
            display: grid;
            grid-template-columns: minmax(320px, 420px) minmax(320px, 1fr);
            gap: 32px;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .auth-card {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(248, 250, 252, 0.94));
            border-radius: 28px;
            padding: 36px;
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: var(--shadow);
            backdrop-filter: blur(6px);
            position: relative;
            overflow: hidden;
        }

        .auth-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top left, rgba(37, 99, 235, 0.12), transparent 55%);
            opacity: 0.8;
            pointer-events: none;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 12px;
            letter-spacing: 0.08em;
            font-weight: 700;
            color: var(--accent-deep);
            background: var(--accent-soft);
        }

        .pill + .pill {
            margin-left: 8px;
        }

        .card-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }

        .auth-card h1 {
            font-family: 'Fredoka', sans-serif;
            font-size: 34px;
            margin: 18px 0 10px;
        }

        .lead {
            color: var(--muted);
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 22px;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .alert-error {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .alert-success {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 16px;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: #94a3b8;
        }

        input {
            width: 100%;
            padding: 14px 16px 14px 46px;
            border-radius: 14px;
            border: 1.5px solid var(--border);
            font-size: 14px;
            background: #f1f5f9;
            outline: none;
            transition: border 0.2s ease, box-shadow 0.2s ease;
        }

        input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.2);
            background: #fff;
        }

        .btn-primary {
            width: 100%;
            margin-top: 6px;
            padding: 14px 18px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--accent), var(--accent-deep));
            color: #fff;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 12px 24px rgba(37, 99, 235, 0.35);
            display: inline-flex;
            justify-content: center;
            gap: 10px;
            align-items: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 28px rgba(37, 99, 235, 0.35);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .helper {
            text-align: center;
            margin-top: 18px;
            font-size: 13px;
            color: var(--muted);
        }

        .helper a {
            color: var(--accent-deep);
            font-weight: 700;
            text-decoration: none;
        }

        .link-row {
            margin-top: 16px;
            display: flex;
            justify-content: center;
            gap: 16px;
            font-size: 13px;
        }

        .link-row a {
            text-decoration: none;
            color: var(--muted);
            font-weight: 600;
        }

        .auth-visual {
            position: relative;
            padding: 24px;
            border-radius: 28px;
            background: var(--visual-bg);
            min-height: 460px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-soft);
            overflow: hidden;
        }

        .auth-visual::before {
            content: "";
            position: absolute;
            inset: 12px;
            border-radius: 24px;
            border: 1px dashed rgba(255, 255, 255, 0.55);
            opacity: 0.7;
            pointer-events: none;
        }

        .visual-art {
            width: 100%;
            height: 100%;
            background: transparent;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .visual-art img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .visual-chip {
            position: absolute;
            background: #fff;
            border-radius: 16px;
            padding: 12px 14px;
            box-shadow: 0 12px 26px rgba(15, 23, 42, 0.18);
            font-size: 13px;
            color: #334155;
            width: 180px;
        }

        .visual-chip span {
            display: block;
            font-weight: 700;
            margin-top: 4px;
        }

        .chip-top {
            top: 16%;
            right: 14%;
        }

        .chip-bottom {
            bottom: 18%;
            left: 12%;
        }

        @media (max-width: 960px) {
            .auth-shell {
                grid-template-columns: 1fr;
            }

            .auth-visual {
                min-height: 360px;
            }

            .chip-top {
                right: 6%;
            }

            .chip-bottom {
                left: 6%;
            }
        }

        @media (max-width: 560px) {
            .auth-card {
                padding: 28px 24px;
            }

            .auth-card h1 {
                font-size: 28px;
            }

            .visual-chip {
                width: 150px;
                font-size: 12px;
            }

        }
    </style>
</head>

<body class="theme-teacher">
    <div class="bg-shapes">
        <div class="shape star"></div>
        <div class="shape pentagon"></div>
        <div class="shape dot"></div>
    </div>

    <main class="auth-shell">
        <section class="auth-card">
            <div class="card-meta">
                <span class="pill">PORTAL GURU</span>                
            </div>
            <h1>Selamat Datang!</h1>
            <p class="lead">Masuk untuk mengelola kelas, materi, dan memantau progres belajar siswa.</p>

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('teacher.login.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email Pengguna</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16v16H4z" opacity="0.2" fill="currentColor"></path>
                            <path d="m4 6 8 6 8-6" />
                        </svg>
                        <input type="email" id="email" name="email" required autofocus placeholder="guru@demo.test">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="4" y="11" width="16" height="9" rx="2" />
                            <path d="M8 11V7a4 4 0 0 1 8 0v4" />
                        </svg>
                        <input type="password" id="password" name="password" required placeholder="Masukkan kata sandi">
                    </div>
                </div>

                <button type="submit" class="btn-primary">
                    Masuk Sekarang
                    <span>📘</span>
                </button>
            </form>

            <div class="helper">Butuh bantuan login? <a href="{{ route('home') }}">Tanya Admin</a></div>

            <div class="link-row">
                <a href="{{ route('home') }}">Kembali ke Beranda</a>
            </div>
        </section>

        <section class="auth-visual">
            <div class="visual-art">
                <img src="{{ asset('images/login_guru.png') }}" alt="Ilustrasi login guru" loading="lazy" />
            </div>          
        </section>
    </main>
</body>

</html>
