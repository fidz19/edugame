<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Poster</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            font-size: 24px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            padding: 8px 16px;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .navbar a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-header h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 10px;
        }

        .page-header p {
            color: #666;
            font-size: 16px;
        }

        .posters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        .poster-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            max-width: 350px;
            margin: 0 auto;
        }

        .poster-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .poster-card .poster-image-container {
            width: 100%;
            height: 400px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .poster-card img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .poster-card-body {
            padding: 20px;
            text-align: center;
        }

        .poster-card h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .poster-card p {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            word-break: break-word;
            overflow-wrap: break-word;
        }

        .poster-category {
            display: inline-block;
            background: #e0e7ff;
            color: #4c51bf;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            margin-top: 10px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state img {
            max-width: 200px;
            opacity: 0.5;
            margin-bottom: 20px;
        }

        .empty-state p {
            color: #999;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1>📸 Galeri Poster Edukatif</h1>
        <div>
            <a href="{{ route('home') }}">🏠 Beranda</a>
        </div>
    </div>

    <div class="container">
        <div class="page-header">
            <h2>Galeri Poster Edukatif</h2>
            <p>Lihat dan pelajari dari poster-poster edukatif yang menarik!</p>
        </div>

        @if($posters->count() > 0)
            <div class="posters-grid">
                @foreach($posters as $poster)
                    <div class="poster-card"
                        onclick="openLightbox('{{ asset('storage/' . $poster->image) }}', '{{ $poster->title }}')"
                        style="cursor: pointer;">
                        <div class="poster-image-container">
                            <img src="{{ asset('storage/' . $poster->image) }}" alt="{{ $poster->title }}">
                        </div>
                        <div class="poster-card-body">
                            <h3>{{ $poster->title }}</h3>
                            @if($poster->description)
                                <p>{{ Str::limit($poster->description, 100) }}</p>
                            @endif
                            @if($poster->category)
                                <span class="poster-category">{{ $poster->category }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <p>📭 Belum ada poster yang tersedia saat ini.</p>
                <p style="font-size: 14px; margin-top: 10px;">Silakan kembali lagi nanti!</p>
            </div>
        @endif
    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); z-index: 9999; justify-content: center; align-items: center;"
        onclick="closeLightbox()">
        <div style="position: relative; max-width: 90%; max-height: 90%; text-align: center;">
            <img id="lightbox-image" src="" alt=""
                style="max-width: 100%; max-height: 85vh; border-radius: 10px; box-shadow: 0 10px 50px rgba(0,0,0,0.5);">
            <h3 id="lightbox-title" style="color: white; margin-top: 20px; font-size: 24px;"></h3>
            <button onclick="closeLightbox()"
                style="position: absolute; top: -40px; right: -40px; background: white; border: none; border-radius: 50%; width: 40px; height: 40px; font-size: 24px; cursor: pointer; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">×</button>
        </div>
    </div>

    <script>
        function openLightbox(imageSrc, title) {
            event.stopPropagation();
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            const lightboxTitle = document.getElementById('lightbox-title');

            lightboxImage.src = imageSrc;
            lightboxTitle.textContent = title;
            lightbox.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close on ESC key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
    </script>
</body>

</html>