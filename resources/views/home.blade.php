@extends('layouts.app')

@section('title', 'Home')

@section('content')
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #1a1a1a 0%, #333333 100%);
        color: #FFFFFF;
        padding: 0;
        position: relative;
        min-height: 600px;
        display: flex;
        align-items: center;
    }

    .hero-content {
        position: relative;
        width: 100%;
        min-height: 600px;
    }

    /* Poster Slider - Full Width Background */
    .hero-poster-slider {
        position: absolute;
        width: 100%;
        height: 100%;
        min-height: 600px;
        top: 0;
        left: 0;
        z-index: 1;
    }

    .poster-slide {
        display: none;
        animation: fadeIn 0.5s ease-in-out;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
    }

    .poster-slide::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        z-index: 5;
    }

    .poster-slide.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .poster-slide-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        z-index: 1;
    }

    .poster-slide-info {
        position: absolute;
        bottom: 30px;
        left: 30px;
        right: 30px;
        background: rgba(0, 0, 0, 0.7);
        padding: 20px;
        border-radius: 8px;
        z-index: 10;
    }

    .poster-slide h2 {
        font-size: 22px;
        font-weight: 700;
        color: #FFFFFF;
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .poster-slide p {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.6;
        margin: 0;
    }

    .poster-nav {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 20;
    }

    .poster-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.4);
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid rgba(255, 255, 255, 0.6);
    }

    .poster-dot:hover {
        background-color: rgba(255, 255, 255, 0.7);
    }

    .poster-dot.active {
        background-color: #FF9900;
        border-color: #FF9900;
    }

    /* Left side - Text content (Overlay di kanan) */
    .hero-text-content {
        position: absolute;
        z-index: 10;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        width: 100%;
        max-width: 600px;
        padding: 0 40px;
    }

    .hero-headline {
        font-size: 48px;
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.2;
        color: #FFFFFF;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
    }

    .hero-subtext {
        font-size: 18px;
        font-weight: 300;
        margin-bottom: 40px;
        opacity: 0.95;
        line-height: 1.6;
        color: #FFFFFF;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }

    .hero-buttons {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .hero-buttons .btn-primary {
        background-color: #FF9900;
        color: #FFFFFF;
    }

    .hero-buttons .btn-primary:hover {
        background-color: #FF7700;
    }

    .hero-buttons .btn-secondary {
        background-color: #FFFFFF;
        color: #1a1a1a;
        border-color: #FFFFFF;
    }

    .hero-buttons .btn-secondary:hover {
        background-color: #1a1a1a;
        color: #FFFFFF;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .hero-text-content {
            padding: 0 30px;
        }

        .hero-headline {
            font-size: 40px;
        }

        .hero-subtext {
            font-size: 16px;
        }
    }

    @media (max-width: 768px) {
        .hero-content {
            min-height: 500px;
        }

        .hero-poster-slider {
            min-height: 500px;
        }

        .hero-text-content {
            padding: 0 20px;
            max-width: 90%;
        }

        .hero-headline {
            font-size: 32px;
        }

        .hero-subtext {
            font-size: 14px;
        }

        .poster-slide-info {
            bottom: 20px;
            left: 20px;
            right: 20px;
            padding: 15px;
        }

        .poster-slide h2 {
            font-size: 18px;
        }

        .poster-slide p {
            font-size: 12px;
        }
    }
    
    /* Services Grid */
    .service-card {
        background-color: #FFFFFF;
        border-radius: 10px;
        padding: 40px 30px;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid #E8E8E8;
        box-shadow: 0 4px 12px rgba(229, 113, 8, 0.25);
    }
    
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(229, 113, 8, 0.35);
    }
    
    .service-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 25px;
        background-color: #F8F8F8;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
    }
    
    .service-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 15px;
    }
    
    .service-description {
        font-size: 14px;
        color: #1A1A1A;
        margin-bottom: 25px;
        line-height: 1.6;
    }
    
    @media (max-width: 768px) {
        .hero-headline {
            font-size: 32px;
        }
        
        .hero-subtext {
            font-size: 16px;
        }
        
        .hero-buttons {
            flex-direction: column;
            gap: 15px;
        }
    }

    /* News Section */
    .news-section {
        background: linear-gradient(135deg, #F9F9F9 0%, #EFEFEF 100%);
        padding: 80px 20px;
    }

    .news-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 50px;
    }

    .news-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .news-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    .news-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: #E8E8E8;
    }

    .news-card-content {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .news-date {
        font-size: 12px;
        color: #FF9900;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .news-title {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 12px;
        line-height: 1.4;
    }

    .news-excerpt {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
        margin-bottom: 15px;
        flex-grow: 1;
    }

    .news-link {
        color: #FF9900;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .news-link:hover {
        color: #FF7700;
        gap: 12px;
    }

    .news-empty {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }

    .news-empty p {
        font-size: 16px;
    }

</style>

<!-- Hero Section with Poster Slider -->
<section class="hero-section">
    <div class="hero-content">
        <!-- Poster Slider - Full Width Background -->
        <div class="hero-poster-slider">
            <!-- Placeholder jika tidak ada poster -->
            <div class="poster-slide active" data-title="{{ $homeContent->title ?? 'Solusi Gas Industri Terpercaya' }}" data-description="{{ $homeContent->content ?? 'Penyedia gas industri berkualitas tinggi dengan jaringan distribusi terluas dan layanan pelanggan terbaik. Full Tank, Full Volume!' }}">
                @if($homeContent->poster_image)
                    <img src="{{ asset('storage/' . $homeContent->poster_image) }}" alt="Poster" class="poster-slide-image">
                @else
                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #1a1a1a 0%, #333333 100%); display: flex; align-items: center; justify-content: center;">
                        <p style="color: white; font-size: 18px;">Poster tidak tersedia</p>
                    </div>
                @endif
            </div>
            
            <div class="poster-nav">
                <span class="poster-dot active" onclick="currentSlide(1)"></span>
            </div>
            </div>
        </div>


        <!-- Left Side - Text Content (Overlay di kanan) -->
        <div class="hero-text-content">
            <h1 class="hero-headline" id="heroHeadline">
                Solusi Gas Industri Terpercaya
            </h1>
            <p class="hero-subtext" id="heroSubtext">
                Penyedia gas industri berkualitas tinggi dengan jaringan distribusi terluas dan layanan pelanggan terbaik. Full Tank, Full Volume!
            </p>
            <div class="hero-buttons">
                <a href="/contact" class="btn-primary">Hubungi Kami</a>
                <a href="/about" class="btn-secondary">Lebih Lanjut</a>
            </div>
        </div>
    </div>
</section>


<!-- Services Section -->
<section class="py-20 px-4 bg-white">
    <div class="max-w-6xl mx-auto">
        <h2 class="section-title">PT AIKO INDONESIA</h2>
        <p class="section-subtitle">
            Mitra Strategis Energi, Penggerak Pertumbuhan Bisnis Anda.
        </p>
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Placeholder jika tidak ada service cards -->
            <div class="service-card">
                <div class="service-icon" style="background: linear-gradient(135deg, rgba(255, 153, 0, 0.1), rgba(255, 136, 0, 0.1));">
                    🏭
                </div>
                <h3 class="service-title">Service Belum Tersedia</h3>
                <p class="service-description">Tambahkan service cards melalui admin dashboard untuk menampilkannya di sini.</p>
            </div>
        </div>
        </div>
    </div>
</section>

<script>
    let slideIndex = 1;
    let slideTimer;

    // Auto advance slides every 5 seconds
    function autoSlide() {
        slideIndex++;
        if (slideIndex > 4) {
            slideIndex = 1;
        }
        showSlide(slideIndex);
        slideTimer = setTimeout(autoSlide, 5000);
    }

    function currentSlide(n) {
        clearTimeout(slideTimer);
        slideIndex = n;
        showSlide(slideIndex);
        slideTimer = setTimeout(autoSlide, 5000);
    }

    function showSlide(n) {
        const slides = document.getElementsByClassName('poster-slide');
        const dots = document.getElementsByClassName('poster-dot');
        
        if (n > slides.length) {
            slideIndex = 1;
        }
        if (n < 1) {
            slideIndex = slides.length;
        }
        
        for (let i = 0; i < slides.length; i++) {
            slides[i].classList.remove('active');
        }
        for (let i = 0; i < dots.length; i++) {
            dots[i].classList.remove('active');
        }
        
        slides[slideIndex - 1].classList.add('active');
        dots[slideIndex - 1].classList.add('active');
        
        // Update heading and subtext from slide data
        const activeSlide = slides[slideIndex - 1];
        const headline = document.getElementById('heroHeadline');
        const subtext = document.getElementById('heroSubtext');
        
        if (activeSlide && headline && subtext) {
            const title = activeSlide.getAttribute('data-title');
            const description = activeSlide.getAttribute('data-description');
            
            if (title) headline.textContent = title;
            if (description) subtext.textContent = description;
        }
    }

    // Start auto slide on page load
    document.addEventListener('DOMContentLoaded', function() {
        showSlide(slideIndex);
        slideTimer = setTimeout(autoSlide, 5000);
    });
</script>

<!-- News Section HTML -->
<section class="news-section">
    <div class="news-container">
        <h2 class="section-title">Berita Terbaru</h2>
        <p class="section-subtitle">
            Informasi dan update terkini dari PT AIKO Indonesia
        </p>

        <div class="news-empty">
            <p>Belum ada berita terbaru.</p>
        </div>
    </div>
</section>

@endsection
