<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Permainan - Taman Belajar Sedjati</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom, #87CEEB 0%, #E0F7FA 60%, #FFFFFF 100%);
            color: #1e293b;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Efek Gelembung */
        .bubbles {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; z-index: 1;
        }
        .bubble {
            position: absolute; bottom: -150px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            box-shadow: 0 0 25px rgba(255, 255, 255, 0.9);
            animation: rise linear infinite;
        }
        @keyframes rise {
            0% { 
                transform: translateY(0) translateX(0) rotate(0deg); 
                opacity: 0.7; 
            }
            50% { 
                transform: translateY(-50vh) translateX(30px) rotate(180deg); 
                opacity: 0.8; 
            }
            100% { 
                transform: translateY(-140vh) translateX(60px) rotate(360deg); 
                opacity: 0; 
            }
        }
        .bubble:nth-child(1) { width: 60px; height: 60px; left: 8%; animation-duration: 15s; animation-delay: 0s; }
        .bubble:nth-child(2) { width: 80px; height: 80px; left: 22%; animation-duration: 20s; animation-delay: 2s; }
        .bubble:nth-child(3) { width: 40px; height: 40px; left: 35%; animation-duration: 12s; animation-delay: 5s; }
        .bubble:nth-child(4) { width: 100px; height: 100px; left: 50%; animation-duration: 22s; animation-delay: 1s; }
        .bubble:nth-child(5) { width: 70px; height: 70px; left: 65%; animation-duration: 18s; animation-delay: 7s; }
        .bubble:nth-child(6) { width: 50px; height: 50px; left: 80%; animation-duration: 14s; animation-delay: 4s; }
        .bubble:nth-child(7) { width: 90px; height: 90px; left: 12%; animation-duration: 19s; animation-delay: 3s; }
        .bubble:nth-child(8) { width: 55px; height: 55px; left: 92%; animation-duration: 16s; animation-delay: 6s; }
        .bubble:nth-child(9) { width: 65px; height: 65px; left: 45%; animation-duration: 17s; animation-delay: 8s; }
        .bubble:nth-child(10) { width: 75px; height: 75px; left: 28%; animation-duration: 21s; animation-delay: 4s; }

        /* Interactive bubble effects */
        .bubble {
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .bubble:hover {
            transform: scale(1.1);
        }

        .bubble.popping {
            animation: pop 0.3s ease-out forwards;
        }

        @keyframes pop {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.5);
                opacity: 0.5;
            }
            100% {
                transform: scale(0);
                opacity: 0;
            }
        }


        header {
            text-align: center;
            padding: 80px 20px 60px;
            background: rgba(135, 206, 235, 0.3);
            position: relative;
            z-index: 2;
            margin: 0;
        }
        h1 {
            font-size: 3rem;
            color: #1e3a8a;
            text-shadow: 0 2px 10px rgba(255, 255, 255, 0.8);
            margin-bottom: 15px;
            font-weight: 700;
        }
        header p {
            font-size: 1.1rem;
            color: #334155;
            margin-bottom: 30px;
        }

        .welcome-box {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            padding: 20px 40px;
            border-radius: 50px;
            display: inline-block;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
            margin-bottom: 25px;
            font-size: 1.3rem;
            color: white;
            font-weight: 600;
        }

        .back-btn {
            position: absolute;
            top: 20px; left: 20px;
            background: #FFD700;
            color: #1e293b;
            padding: 12px 24px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 8px 20px rgba(255,215,0,0.4);
            z-index: 3;
            transition: all 0.3s ease;
        }
        .back-btn:hover {
            background: #FFEC8B;
            transform: scale(1.05);
        }

        .games-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            padding: 40px 8%;
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .game-card {
            background: rgba(255, 255, 255, 0.9);
            border: 6px solid #FFFFFF;
            border-radius: 30px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.4s ease;
            box-shadow: 0 15px 40px rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(10px);
        }
        .game-card:hover {
            transform: translateY(-15px) scale(1.05);
            box-shadow: 0 25px 60px rgba(255, 255, 255, 0.7);
            border-color: #FFFFFF;
        }
        .game-placeholder {
            background: #E0F7FA;
            height: 200px;
            border-radius: 25px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4.5rem;
            color: #87CEEB;
        }
        .game-card h3 {
            font-size: 1.8rem;
            color: #1e3a8a;
            margin: 15px 0;
        }
        .game-card p {
            font-size: 1.1rem;
            color: #334155;
            margin-bottom: 25px;
        }
        .play-btn {
            background: #FFD700;
            color: #1e293b;
            padding: 14px 32px;
            border: none;
            border-radius: 50px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(255,215,0,0.4);
            font-size: 1.1rem;
            text-decoration: none;
            display: inline-block;
        }
        .play-btn:hover {
            background: #FFEC8B;
            transform: translateY(-3px);
        }

        footer {
            text-align: center;
            padding: 30px;
            background: rgba(255, 255, 255, 0.8);
            color: #1e3a8a;
            position: relative;
            z-index: 2;
        }
    </style>
    <style>
        .btn-history {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
            margin-top: 20px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
            animation: pulse-btn 2s infinite;
        }

        .btn-history:hover {
            transform: scale(1.1) translateY(-5px);
            box-shadow: 0 15px 35px rgba(37, 99, 235, 0.6);
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }

        .btn-history:active {
            transform: scale(0.95);
        }

        @keyframes pulse-btn {
            0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7); }
            70% { box-shadow: 0 0 0 20px rgba(59, 130, 246, 0); }
            100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
        }
    </style>
</head>
<body>

    <div class="bubbles">
        <div class="bubble"></div><div class="bubble"></div><div class="bubble"></div>
        <div class="bubble"></div><div class="bubble"></div><div class="bubble"></div>
        <div class="bubble"></div><div class="bubble"></div><div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <script>
        // Interactive bubble functionality
        document.addEventListener('DOMContentLoaded', function() {
            const bubbles = document.querySelectorAll('.bubble');
            
            bubbles.forEach(bubble => {
                bubble.addEventListener('click', function(e) {
                    // Add popping animation
                    this.classList.add('popping');
                    
                    // Create splash effect
                    createSplash(e.clientX, e.clientY);
                    
                    // Remove bubble after animation
                    setTimeout(() => {
                        this.classList.remove('popping');
                        // Reset bubble position to create new one
                        this.style.animation = 'none';
                        setTimeout(() => {
                            this.style.animation = '';
                        }, 10);
                    }, 300);
                });
            });
            
            function createSplash(x, y) {
                const splash = document.createElement('div');
                splash.style.position = 'fixed';
                splash.style.left = x + 'px';
                splash.style.top = y + 'px';
                splash.style.width = '10px';
                splash.style.height = '10px';
                splash.style.borderRadius = '50%';
                splash.style.background = 'rgba(255, 255, 255, 0.8)';
                splash.style.pointerEvents = 'none';
                splash.style.zIndex = '999';
                splash.style.animation = 'splash 0.5s ease-out forwards';
                
                document.body.appendChild(splash);
                
                // Create multiple splash particles
                for (let i = 0; i < 8; i++) {
                    const particle = document.createElement('div');
                    const angle = (Math.PI * 2 * i) / 8;
                    const distance = 30 + Math.random() * 20;
                    
                    particle.style.position = 'fixed';
                    particle.style.left = x + 'px';
                    particle.style.top = y + 'px';
                    particle.style.width = '5px';
                    particle.style.height = '5px';
                    particle.style.borderRadius = '50%';
                    particle.style.background = 'rgba(135, 206, 235, 0.8)';
                    particle.style.pointerEvents = 'none';
                    particle.style.zIndex = '999';
                    
                    const tx = Math.cos(angle) * distance;
                    const ty = Math.sin(angle) * distance;
                    
                    particle.style.animation = `particle 0.6s ease-out forwards`;
                    particle.style.setProperty('--tx', tx + 'px');
                    particle.style.setProperty('--ty', ty + 'px');
                    
                    document.body.appendChild(particle);
                    
                    setTimeout(() => particle.remove(), 600);
                }
                
                setTimeout(() => splash.remove(), 500);
            }
        });
        
        // Add splash animation styles
        const style = document.createElement('style');
        style.textContent = `
            @keyframes splash {
                0% {
                    transform: scale(1);
                    opacity: 1;
                }
                100% {
                    transform: scale(3);
                    opacity: 0;
                }
            }
            
            @keyframes particle {
                0% {
                    transform: translate(0, 0) scale(1);
                    opacity: 1;
                }
                100% {
                    transform: translate(var(--tx), var(--ty)) scale(0);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>

    <a href="{{ route('home') }}" class="back-btn">← Kembali ke Beranda</a>

    <header>
        <h1>🌊 Permainan Kelas {{ $student->kelas ?? 'Taman Belajar Sedjati' }} 🫧</h1>
        <p>Belajar bahasa dengan petualangan seru di lautan biru yang cerah!</p>
        @if(session('student_name'))
            <div class="welcome-box">
                🎉 Selamat datang, {{ session('student_name') }}! 🎉
            </div>
            <br>
            <a href="{{ route('games.history') }}" class="btn-history" style="text-decoration: none;">
                <span style="font-size: 1.5rem;">📜</span> Riwayat Nilai Saya
            </a>
        @endif

        @if($availableCategories->count() > 0)
            <div class="filter-section" style="margin-top: 30px; animation: slideIn 0.8s ease-out;">
                <p style="font-weight: 700; color: #1e3a8a; margin-bottom: 15px; font-size: 1.2rem;">📚 Pilih Pelajaran:</p>
                <div class="filter-buttons" style="display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('games.index') }}" 
                       class="filter-btn {{ !$selectedCategory ? 'active' : '' }}">
                       🌟 Semua
                    </a>
                    @foreach($availableCategories as $cat)
                        <a href="{{ route('games.index', ['category' => $cat]) }}" 
                           class="filter-btn {{ $selectedCategory == $cat ? 'active' : '' }}">
                           📖 {{ $cat }}
                        </a>
                    @endforeach
                </div>
            </div>

            <style>
                .filter-btn {
                    padding: 10px 25px;
                    background: white;
                    color: #1e3a8a;
                    border: 2px solid #e0f7fa;
                    border-radius: 50px;
                    text-decoration: none;
                    font-weight: 600;
                    transition: all 0.3s ease;
                    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
                }
                .filter-btn:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
                    border-color: #3b82f6;
                }
                .filter-btn.active {
                    background: #3b82f6;
                    color: white;
                    border-color: #3b82f6;
                    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
                }
            </style>
        @endif



        <style>
            .btn-history {
                background: white !important;
                color: #1e3a8a !important;
                padding: 15px 35px;
                border-radius: 50px;
                font-weight: bold;
                box-shadow: 0 8px 20px rgba(30, 58, 138, 0.2);
                transition: all 0.3s ease;
                display: inline-block;
                border: 2px solid #e0f7fa;
            }
            .btn-history:hover {
                background: #f0f9ff !important;
                transform: translateY(-3px);
                box-shadow: 0 12px 25px rgba(30, 58, 138, 0.3);
            }
            
            @keyframes slideIn {
                from { transform: translateY(-50px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }
            @keyframes popIn {
                from { transform: scale(0.8); opacity: 0; }
                to { transform: scale(1); opacity: 1; }
            }
        </style>
    </header>

    <div class="games-container">
        @forelse($games as $game)
            <div class="game-card">
                <div class="game-placeholder">
                    @if($game->thumbnail)
                        <img src="{{ asset($game->thumbnail) }}" alt="{{ $game->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 25px;">
                    @else
                        🎮
                    @endif
                </div>
                <h3>{{ $game->title }}</h3>
                <p>{{ $game->description }}</p>
                <form action="{{ route('games.start', $game->slug) }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="play-btn">
                        🚀 Main Sekarang
                    </button>
                </form>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                <h2 style="color: #1e3a8a; font-size: 2rem;">📭 Belum Ada Game</h2>
                <p style="color: #334155; font-size: 1.2rem; margin-top: 10px;">
                    Silakan tambahkan game melalui admin panel!
                </p>
            </div>
        @endforelse
    </div>

    <footer>
        <p>&copy; 2026 Taman Belajar Sedjati. Belajar bahasa jadi menyenangkan!</p>
    </footer>

</body>
</html>
