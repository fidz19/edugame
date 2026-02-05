<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Orang Tua - Taman Belajar Sedjati</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            /* align-items: center; removed to allow scrolling on small screens */
            padding: 40px 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background Elements */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: backgroundMove 20s linear infinite;
            z-index: 0;
        }

        @keyframes backgroundMove {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(50px, 50px);
            }
        }

        /* Floating Decorative Elements */
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 15s ease-in-out infinite;
        }

        .shape1 {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape2 {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape3 {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-30px) rotate(180deg);
            }
        }

        .register-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 45px;
            border-radius: 30px;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 470px;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            animation: slideIn 0.5s ease-out;
            margin: auto;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .register-header .icon-wrapper {
            font-size: 4.5rem;
            margin-bottom: 20px;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .register-header h1 {
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 32px;
            margin-bottom: 12px;
            font-weight: 800;
        }

        .register-header p {
            color: #666;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-weight: 600;
            font-size: 15px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-group small {
            display: block;
            margin-top: 6px;
            color: #999;
            font-size: 13px;
        }

        .btn-register {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 17px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-top: 10px;
        }

        .btn-register::before {
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

        .btn-register:hover::before {
            width: 400px;
            height: 400px;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.5);
        }

        .btn-register:active {
            transform: translateY(-1px);
        }

        .alert {
            padding: 14px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
            animation: slideIn 0.3s ease-out;
        }

        .alert-error {
            background: linear-gradient(135deg, #fee 0%, #fdd 100%);
            color: #c33;
            border: 2px solid #fcc;
        }

        .alert-success {
            background: linear-gradient(135deg, #efe 0%, #dfd 100%);
            color: #3c3;
            border: 2px solid #cfc;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 2px solid #e0e0e0;
        }

        .login-link p {
            color: #666;
            font-size: 15px;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .back-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .error-text {
            color: #c33;
            font-size: 13px;
            margin-top: 6px;
            display: block;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="floating-shapes">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>
    </div>

    <div class="register-container">
        <div class="register-header">
            <div class="icon-wrapper">👨‍👩‍👧‍👦</div>
            <h1>Daftar Akun Orang Tua</h1>
            <p>Pantau perkembangan belajar anak Anda</p>
        </div>

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

        <form action="{{ route('parent.register.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="parent_name">👤 Nama Lengkap</label>
                <input type="text" id="parent_name" name="parent_name" required autofocus
                    placeholder="Masukkan nama lengkap Anda" value="{{ old('parent_name') }}">
                @error('parent_name')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">📧 Email</label>
                <input type="email" id="email" name="email" required placeholder="contoh@email.com"
                    value="{{ old('email') }}">
                @error('email')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">🔑 Kata Sandi</label>
                <input type="password" id="password" name="password" required placeholder="Minimal 8 karakter">
                <small>Kata sandi minimal 8 karakter</small>
                @error('password')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">🔒 Konfirmasi Kata Sandi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    placeholder="Ketik ulang password">
            </div>

	            <div class="form-group">
	                <label for="gender">♂️♀️ Jenis Kelamin (Opsional)</label>
	                <select id="gender" name="gender">
	                    <option value="">Pilih jenis kelamin...</option>
	                    <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
	                    <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
	                </select>
	                @error('gender')
	                    <span class="error-text">{{ $message }}</span>
	                @enderror
	            </div>

            <button type="submit" class="btn-register">Daftar Sekarang</button>
        </form>

        <div class="login-link">
            <p>Sudah punya akun?
                <a href="{{ route('parent.login') }}">Masuk di sini</a>
            </p>
        </div>

        <div class="back-link">
            <a href="{{ route('home') }}">← Kembali ke Beranda</a>
        </div>
    </div>
</body>

</html>
