<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Light and Glow Bukittinggi 2026 | Tiket Resmi Lari Malam & Konser</title>
  <meta name="description" content="Dapatkan tiket resmi Light and Glow Bukittinggi 2026. Lari malam 5K bertabur cahaya neon glow-in-the-dark dan konser musik spektakuler di Jam Gadang!" />
  <meta name="theme-color" content="#EB1355" />
  
  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
  <link rel="alternate icon" href="{{ asset('favicon.ico') }}" />

  <!-- Google Fonts: Karla & Montserrat & Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,400;0,500;0,700;1,400&family=Montserrat:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- External Stylesheet -->
  <link rel="stylesheet" href="{{ asset('style.css') }}" />
</head>
<body data-buyer-logged-in="{{ !empty($buyer) ? '1' : '0' }}" data-login-url="{{ route('buyer.login') }}">

  <!-- Top Announcement Bar -->
  <div class="top-bar">
    <div class="goers-container" style="display:flex; justify-content:space-between; align-items:center; width:100%;">
      <div>
        <span id="cmsTopBar">⚡ Registrasi <strong>Light and Glow Bukittinggi 2026</strong> Resmi Dibuka! Kuota terbatas.</span> <a href="#tiket-section">Beli Tiket Sekarang</a>
      </div>
      <div class="top-bar-right">
        <a href="#help-section" class="top-bar-item">
          <i data-lucide="help-circle" style="width:14px; height:14px;"></i>
          Informasi Acara
        </a>
        <div class="top-bar-item">
          <i data-lucide="map-pin" style="width:14px; height:14px;"></i>
          Jam Gadang, Bukittinggi
        </div>
      </div>
    </div>
  </div>

  <!-- Main Sticky Header -->
  <header class="goers-header">
    <div class="goers-container">
      <div class="goers-nav-wrapper">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="goers-brand-logo" id="cmsBrandLogoLink">
          <img src="{{ asset('logo-lightandrun.png') }}" alt="Light and Glow Bukittinggi" class="brand-logo-img" />
          <span id="cmsBrandLogoText">LIGHT & GLOW</span><span class="dot">.</span>
        </a>

        <!-- Desktop Search Bar -->
        <div class="goers-search-box">
          <i data-lucide="search" class="goers-search-icon" style="width:18px; height:18px;"></i>
          <input type="text" id="mainSearchInput" class="goers-search-input" placeholder="Cari kategori tiket Light and Glow..." onkeyup="filterEvents(this.value)" />
        </div>

        <!-- Navigation Actions -->
        <div class="goers-nav-actions">
          <div class="nav-links-desktop" style="display:flex; align-items:center; gap:12px;">
            <a href="#tiket-section" class="nav-btn-link">Tiket</a>
            <a href="#highlight-section" class="nav-btn-link">Highlight Acara</a>
            <a href="#rute-section" class="nav-btn-link">Rute & Venue</a>
            @if(!empty($buyer))
              <a href="{{ route('buyer.dashboard') }}" class="nav-btn-link" style="color:var(--goers-branding-500); font-weight:700;">
                <i data-lucide="ticket" style="width:14px;height:14px; vertical-align:middle;"></i>
                Tiket Saya
              </a>
            @endif
          </div>

          @if(!empty($buyer))
            <a href="{{ route('buyer.dashboard') }}" class="btn-login" style="border-color:var(--goers-branding-500); color:var(--goers-branding-500);">
              <i data-lucide="user" style="width:14px;height:14px; vertical-align:middle; display:inline-block; margin-right:4px;"></i>{{ Str::limit($buyer['name'], 12) }}
            </a>
            <form action="{{ route('buyer.logout') }}" method="POST" style="display:inline;">
              @csrf
              <button type="submit" class="btn-login" style="border:none; color:#64748B; padding:8px 12px;" title="Keluar">
                <i data-lucide="log-out" style="width:16px;height:16px;"></i>
              </button>
            </form>
          @else
            <a href="{{ route('buyer.login') }}" class="btn-login">Masuk</a>
            <a href="{{ route('buyer.register') }}" class="btn-signup">Daftar</a>
          @endif
          
          <button class="mobile-menu-toggle" onclick="toggleMobileDrawer()" aria-label="Buka Menu">
            <span class="mobile-menu-text">Menu</span>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Search Row -->
    <div class="mobile-search-row">
      <div class="goers-search-box" style="display:block; max-width:100%;">
        <i data-lucide="search" class="goers-search-icon" style="width:18px; height:18px;"></i>
        <input type="text" class="goers-search-input" placeholder="Cari tiket Light and Glow..." onkeyup="filterEvents(this.value)" />
      </div>
    </div>
  </header>

  <!-- Mobile Drawer -->
  <div class="drawer-overlay" id="drawerOverlay" onclick="toggleMobileDrawer()"></div>
  <div class="mobile-drawer" id="mobileDrawer">
    <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid var(--goers-gray-300); padding-bottom:16px;">
      <a href="{{ route('home') }}" class="goers-brand-logo">
        <img src="{{ asset('logo-lightandrun.png') }}" alt="Light and Glow" class="brand-logo-img" style="height:32px;" />
        <span style="font-size:16px;">LIGHT & GLOW</span><span class="dot">.</span>
      </a>
      <button onclick="toggleMobileDrawer()" class="mobile-drawer-close">Tutup</button>
    </div>
    <!-- Search inside Mobile Drawer -->
    <div style="margin-top:16px;">
      <div style="position:relative; width:100%;">
        <input type="text" class="goers-search-input" placeholder="Cari tiket..." onkeyup="filterEvents(this.value)" style="height:40px; padding:0 16px; font-size:13px; background:#F8FAFC;" />
      </div>
    </div>

    <!-- Navigation links -->
    <div style="display:flex; flex-direction:column; gap:8px; margin-top:16px;">
      <a href="#tiket-section" onclick="toggleMobileDrawer()" class="mobile-drawer-nav-link">Kategori Tiket</a>
      <a href="#highlight-section" onclick="toggleMobileDrawer()" class="mobile-drawer-nav-link">Highlight Acara</a>
      <a href="#rute-section" onclick="toggleMobileDrawer()" class="mobile-drawer-nav-link">Rute & Venue</a>
      <a href="#help-section" onclick="toggleMobileDrawer()" class="mobile-drawer-nav-link">Informasi Acara</a>
    </div>
    <div style="margin-top:auto; display:flex; flex-direction:column; gap:10px;">
      @if(!empty($buyer))
        <a href="{{ route('buyer.dashboard') }}" class="btn-login" style="width:100%; text-align:center; display:block; border-color:var(--goers-branding-500); color:var(--goers-branding-500);">🎫 Tiket Saya ({{ $buyer['name'] }})</a>
        <form action="{{ route('buyer.logout') }}" method="POST" style="width:100%;">
          @csrf
          <button type="submit" class="btn-login" style="width:100%; text-align:center; display:block; border:1px solid #CBD5E1; color:#64748B;">Keluar</button>
        </form>
      @else
        <a href="{{ route('buyer.login') }}" class="btn-login" style="width:100%; text-align:center; display:block;">Masuk Akun</a>
        <a href="{{ route('buyer.register') }}" class="btn-signup" style="width:100%; text-align:center; display:block;">Daftar Akun Baru</a>
      @endif
      <a href="{{ route('login') }}" style="font-size:11px; text-align:center; color:#94A3B8; margin-top:6px;">Portal Admin</a>
    </div>
  </div>

  <!-- Hero Banner Carousel -->
  <section class="goers-hero-section">
    <div class="goers-container">
      <div class="hero-slider-container">
        <!-- Slider Track -->
        <div class="hero-slider" id="heroSlider">
          
          <!-- Slide 1: Light and Glow Main -->
          <div class="hero-slide">
            <img src="{{ asset('poster-lightandglowrun.jpeg') }}" alt="Poster Light and Glow Run Bukittinggi 2026" id="cmsSlide1Img" class="hero-slide-bg" style="object-position: top center;" />
            <div class="hero-slide-overlay" style="background: linear-gradient(90deg, rgba(7, 11, 25, 0.92) 0%, rgba(7, 11, 25, 0.65) 50%, rgba(7, 11, 25, 0.25) 100%);"></div>
            <div class="hero-slide-content">
              <span class="hero-tag" id="cmsSlide1Tag" style="background:linear-gradient(135deg, #00E5FF, #00B4D8); color:#070B19; font-weight:800; box-shadow:0 0 12px rgba(0,229,255,0.5);">⚡ Run • Light • Music • Together</span>
              <h1 class="hero-title" id="cmsSlide1Title" style="color:#ffffff;">LIGHT AND GLOW RUN <span style="color:#00E5FF; text-shadow:0 0 20px rgba(0,229,255,0.7);">BUKITTINGGI 2026</span></h1>
              <p class="hero-desc" id="cmsSlide1Desc" style="color:#D8E7FA;">Lari malam 5K bertabur cahaya neon bersinar bersama ribuan pelari, LED stick, dan berujung konser DJ spektakuler di Lapangan Wirabraja Bukittinggi!</p>
              <a href="#tiket-section" class="btn-hero-action">
                <i data-lucide="ticket" style="width:18px;height:18px;"></i>
                Beli Tiket Sekarang
              </a>
            </div>
          </div>

          <!-- Slide 2: 5K Glow Experience -->
          <div class="hero-slide">
            <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=1200&auto=format&fit=crop&q=80" alt="Hero Slide 2" id="cmsSlide2Img" class="hero-slide-bg" />
            <div class="hero-slide-overlay"></div>
            <div class="hero-slide-content">
              <span class="hero-tag" id="cmsSlide2Tag" style="background:var(--goers-teal);">5K Glow Experience</span>
              <h1 class="hero-title" id="cmsSlide2Title">Sensasi Lari Malam Penuh Cahaya di Jam Gadang</h1>
              <p class="hero-desc" id="cmsSlide2Desc">Jelajahi keindahan malam Kota Wisata Bukittinggi bersama ribuan pelari dengan jersey neon, LED glasses, dan medali finisher eksklusif.</p>
              <a href="#tiket-section" class="btn-hero-action" style="background:var(--goers-teal);">
                <i data-lucide="compass" style="width:18px;height:18px;"></i>
                Pilih Paket Tiket
              </a>
            </div>
          </div>

          <!-- Slide 3: Live Music & Light Show -->
          <div class="hero-slide">
            <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=1200&q=80" alt="Hero Slide 3" id="cmsSlide3Img" class="hero-slide-bg" />
            <div class="hero-slide-overlay"></div>
            <div class="hero-slide-content">
              <span class="hero-tag" id="cmsSlide3Tag" style="background:#7B1FA2;">Music & Light Show</span>
              <h1 class="hero-title" id="cmsSlide3Title">Pesta Cahaya Spektakuler & Live Music Stage</h1>
              <p class="hero-desc" id="cmsSlide3Desc">Nikmati dentuman panggung hiburan musik langsung, pertunjukan laser cahaya megah, dan pesta kembang api di pelataran Jam Gadang!</p>
              <a href="#tiket-section" class="btn-hero-action" style="background:#7B1FA2;">
                <i data-lucide="sparkles" style="width:18px;height:18px;"></i>
                Dapatkan Tiket VIP
              </a>
            </div>
          </div>

        </div>

        <!-- Slider Navigation -->
        <button class="slider-arrow prev" onclick="slideHero(-1)"><i data-lucide="chevron-left" style="width:24px;height:24px;"></i></button>
        <button class="slider-arrow next" onclick="slideHero(1)"><i data-lucide="chevron-right" style="width:24px;height:24px;"></i></button>

        <!-- Slider Dots -->
        <div class="slider-dots" id="sliderDots">
          <div class="slider-dot active" onclick="goToSlide(0)"></div>
          <div class="slider-dot" onclick="goToSlide(1)"></div>
          <div class="slider-dot" onclick="goToSlide(2)"></div>
        </div>
      </div>
    </div>
  </section>

  {{--
  <!-- Category Shortcut Grid -->
  <section class="goers-categories-bar">
    <div class="goers-container">
      <div class="category-grid">
        <div class="category-card" onclick="filterByCategory('konser')">
          <div class="category-icon-wrapper cat-concert">
            <i data-lucide="music-2"></i>
          </div>
          <span class="category-name">Konser & Musik</span>
        </div>

        <div class="category-card" onclick="filterByCategory('wisata')">
          <div class="category-icon-wrapper cat-attraction">
            <i data-lucide="ferris-wheel"></i>
          </div>
          <span class="category-name">Tempat Wisata</span>
        </div>

        <div class="category-card" onclick="filterByCategory('olahraga')">
          <div class="category-icon-wrapper cat-sport">
            <i data-lucide="activity"></i>
          </div>
          <span class="category-name">Olahraga & Run</span>
        </div>

        <div class="category-card" onclick="filterByCategory('travel')">
          <div class="category-icon-wrapper cat-travel">
            <i data-lucide="plane"></i>
          </div>
          <span class="category-name">Travel & Tour</span>
        </div>

        <div class="category-card" onclick="filterByCategory('pameran')">
          <div class="category-icon-wrapper cat-exhibition">
            <i data-lucide="palette"></i>
          </div>
          <span class="category-name">Pameran & Seni</span>
        </div>

        <div class="category-card" onclick="location.href='#crowd-section'">
          <div class="category-icon-wrapper cat-meetup">
            <i data-lucide="users"></i>
          </div>
          <span class="category-name">Crowd Meetup</span>
        </div>

        <div class="category-card" onclick="filterByCategory('workshop')">
          <div class="category-icon-wrapper cat-workshop">
            <i data-lucide="graduation-cap"></i>
          </div>
          <span class="category-name">Workshop Edu</span>
        </div>

        <div class="category-card" onclick="filterByCategory('all')">
          <div class="category-icon-wrapper cat-more">
            <i data-lucide="grid"></i>
          </div>
          <span class="category-name">Semua Kategori</span>
        </div>
      </div>
    </div>
  </section>
  --}}

  <!-- Section 1: Kategori Tiket Light & Glow -->
  <section class="section-wrap" id="tiket-section">
    <div class="goers-container">
      <div class="section-header">
        <div class="section-title-wrap">
          <span class="section-badge"><i data-lucide="sparkles" style="width:14px;height:14px;"></i> Tiket Resmi Light and Glow 2026</span>
          <h2 class="section-title" id="cmsConcertTitle">Kategori Tiket & Paket Peserta</h2>
          <p class="section-subtitle" id="cmsConcertDesc">Pilih tiket favoritmu untuk sensasi lari malam 5K dan konser spektakuler di Jam Gadang Bukittinggi</p>
        </div>
        <a href="#tiket-section" class="btn-view-all">Semua Kategori <i data-lucide="arrow-right" style="width:16px;height:16px;"></i></a>
      </div>

      <div class="event-grid" id="eventsContainer">
        @forelse($tickets as $t)
          @php
            $isSoldOut = ($t->remaining_quota <= 0);
            $quotaClass = $isSoldOut ? 'sold-out' : ($t->remaining_quota <= 15 ? 'low' : 'available');
            $imgUrl = $t->image ?: 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=600&q=80';
            $category = $t->category ?: 'Festival Run';
            $formattedPrice = 'Rp ' . number_format($t->price, 0, ',', '.');
          @endphp
          <div class="event-card {{ $isSoldOut ? 'is-sold-out' : '' }}" data-category="konser" data-name="{{ $t->name }}">
            <div class="event-thumbnail">
              <span class="event-badge-floating">{{ $category }}</span>
              @if($isSoldOut)
                <span class="event-badge-sold-out">HABIS</span>
              @elseif(!empty($t->benefits))
                <span class="event-badge-sale">{{ Str::limit($t->benefits, 18) }}</span>
              @endif
              <img src="{{ $imgUrl }}" alt="{{ $t->name }}" loading="lazy" />
            </div>
            <div class="event-body">
              <div>
                <div class="event-date-row">
                  <i data-lucide="calendar" style="width:14px;height:14px;"></i>
                  Sabtu, 25 April 2026
                </div>
                <h3 class="event-name">{{ $t->name }}</h3>
                <div class="event-location-row" style="margin-bottom: 8px;">
                  <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                  Jam Gadang, Bukittinggi
                </div>
                
                <!-- Indikator Kuota Tiket Tersisa -->
                <div style="margin-bottom: 12px;">
                  @if($isSoldOut)
                    <span class="ticket-quota-badge sold-out">
                      <i data-lucide="alert-circle" style="width:12px;height:12px;"></i> Tiket Habis Terjual
                    </span>
                  @else
                    <span class="ticket-quota-badge {{ $quotaClass }}">
                      <i data-lucide="ticket" style="width:12px;height:12px;"></i> Sisa: {{ $t->remaining_quota }} Tiket
                    </span>
                  @endif
                </div>
              </div>
              <div class="event-footer">
                <div>
                  <span class="price-label">Mulai dari</span>
                  <div class="price-value">{{ $formattedPrice }}</div>
                </div>
                @if($isSoldOut)
                  <button class="btn-buy-ticket btn-sold-out" disabled>Tiket Habis</button>
                @else
                  <button class="btn-buy-ticket" onclick="showTicketDetail('{{ addslashes($t->name) }}', '{{ $formattedPrice }}', '25 April 2026', 'Jam Gadang, Bukittinggi', '{{ $imgUrl }}', '{{ addslashes($category) }}', {{ $t->id }}, {{ $t->remaining_quota }})">Beli Tiket</button>
                @endif
              </div>
            </div>
          </div>
        @empty
          <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #64748B;">
            Belum ada tiket yang tersedia saat ini.
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Section 2: Highlight & Sensasi Light & Glow -->
  <div class="goers-container" id="highlight-section">
    <section class="goers-crowd-section">
      <div class="crowd-shapes"></div>
      <div class="goers-container">
        <div class="crowd-layout">
          <!-- Left: Copy & Explanation -->
          <div>
            <div class="crowd-tag">
              Agenda Resmi Acara
            </div>
            <h2 class="crowd-title" id="cmsCrowdTitle">
              Atmosfer Pesta Cahaya <span>& Musik Spektakuler</span>
            </h2>
            <p class="crowd-description" id="cmsCrowdDesc">
              Bergabung bersama ribuan pelari dan penikmat musik di Lapangan Wirabraja, Bukittinggi. Nikmati pengalaman 5K Night Run berlampu neon, pertunjukan laser, serta panggung DJ performance spektakuler.
            </p>

            <div class="crowd-chips">
              <span class="crowd-chip">5K Night Run</span>
              <span class="crowd-chip">Glow Stick & LED Glasses</span>
              <span class="crowd-chip">DJ & Live Music</span>
              <span class="crowd-chip">Medali Finisher</span>
              <span class="crowd-chip">Glow Photobooth</span>
              <span class="crowd-chip">Bazaar Kuliner</span>
            </div>
          </div>

          <!-- Right: Interactive Live Meetup Demo Card -->
          <div>
            <div class="crowd-preview-card">
              <div class="crowd-meetup-header">
                <div class="crowd-avatar">
                  <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80" alt="Official Team" />
                </div>
                <div class="crowd-author-info">
                  <h4>Panitia Light & Glow 2026</h4>
                  <span>Penyelenggara Acara</span>
                </div>
              </div>

              <div class="crowd-meetup-body">
                <div class="meetup-title">5K Night Run & Concert Bukittinggi</div>
                <p style="font-size:13px; color:#D5E4F9; margin-bottom:12px; line-height:1.6;">
                  "Pengambilan race pack dimulai pukul 14:00 WIB di lokasi acara. Lari malam start pukul 19:45 WIB dan dilanjutkan panggung DJ performance spektakuler!"
                </p>
                <div class="meetup-meta">
                  <div class="meetup-meta-item">
                    Lapangan Wirabraja
                  </div>
                  <div class="meetup-meta-item">
                    Sabtu, 28 November 2026
                  </div>
                  <div class="meetup-meta-item">
                    Start 19:45 WIB
                  </div>
                </div>
              </div>

              <div class="crowd-participants-row">
                <div style="display:flex; align-items:center; gap:8px;">
                  <div class="participants-avatars">
                    <img src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=100&q=80" alt="User 1" />
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80" alt="User 2" />
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=100&q=80" alt="User 3" />
                    <div class="more-count">+500</div>
                  </div>
                  <span style="font-size:12px; color:#ADC9F4;">Peserta Terdaftar</span>
                </div>

                <a href="#tiket-section" class="btn-buy-ticket" style="background:var(--goers-branding-500); padding:8px 18px; text-decoration:none;">
                  Daftar Sekarang
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  {{--
  <!-- Section 3: Tempat Wisata & Destinasi Liburan -->
  <section class="section-wrap" id="wisata-section">
    <div class="goers-container">
      <div class="section-header">
        <div class="section-title-wrap">
          <span class="section-badge" style="color:var(--goers-teal);"><i data-lucide="palmtree" style="width:14px;height:14px;"></i> Destinasi Favorit</span>
          <h2 class="section-title">Tempat Wisata & Liburan Seru</h2>
          <p class="section-subtitle">Beli tiket masuk wisata, waterpark, dan wahana atraksi langsung tanpa antre</p>
        </div>
        <a href="#all" class="btn-view-all" style="color:var(--goers-teal);">Lihat Semua <i data-lucide="arrow-right" style="width:16px;height:16px;"></i></a>
      </div>

      <div class="event-grid">
        <!-- Wisata Card 1 -->
        <div class="event-card" data-category="wisata" data-name="Taman Safari & Wild Adventure">
          <div class="event-thumbnail">
            <span class="event-badge-floating" style="background:var(--goers-teal);">Wisata Alam</span>
            <img src="https://images.unsplash.com/photo-1534567153574-2b12153a87f0?auto=format&fit=crop&w=600&q=80" alt="Safari Wild" loading="lazy" />
          </div>
          <div class="event-body">
            <div>
              <div class="event-date-row" style="color:var(--goers-teal);">
                <i data-lucide="clock" style="width:14px;height:14px;"></i>
                Buka Setiap Hari (08:30 - 17:00)
              </div>
              <h3 class="event-name">Taman Safari Wild Life Experience & Animal Show</h3>
              <div class="event-location-row">
                <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                Cisarua, Bogor
              </div>
            </div>
            <div class="event-footer">
              <div>
                <span class="price-label">Tiket Terusan</span>
                <div class="price-value" style="color:var(--goers-teal);">Rp 150.000</div>
              </div>
              <button class="btn-buy-ticket" onclick="showTicketDetail('Taman Safari Wild Life Experience & Animal Show', 'Rp 150.000', 'Buka Setiap Hari', 'Cisarua, Bogor', 'https://images.unsplash.com/photo-1534567153574-2b12153a87f0?auto=format&fit=crop&w=600&q=80', 'Tempat Wisata')">Pesan Tiket</button>
            </div>
          </div>
        </div>

        <!-- Wisata Card 2 -->
        <div class="event-card" data-category="wisata" data-name="Ocean Blue Marine Park">
          <div class="event-thumbnail">
            <span class="event-badge-floating" style="background:var(--goers-teal);">Akuarium</span>
            <span class="event-badge-sale">Promo Family</span>
            <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=600&q=80" alt="Ocean Aquarium" loading="lazy" />
          </div>
          <div class="event-body">
            <div>
              <div class="event-date-row" style="color:var(--goers-teal);">
                <i data-lucide="clock" style="width:14px;height:14px;"></i>
                Buka Setiap Hari (10:00 - 21:00)
              </div>
              <h3 class="event-name">Ocean Blue Underwater World & Marine Tunnel</h3>
              <div class="event-location-row">
                <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                Ancol, Jakarta Utara
              </div>
            </div>
            <div class="event-footer">
              <div>
                <span class="price-label">Mulai dari</span>
                <div class="price-value" style="color:var(--goers-teal);">Rp 115.000</div>
              </div>
              <button class="btn-buy-ticket" onclick="showTicketDetail('Ocean Blue Underwater World & Marine Tunnel', 'Rp 115.000', 'Setiap Hari', 'Ancol, Jakarta Utara', 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=600&q=80', 'Tempat Wisata')">Pesan Tiket</button>
            </div>
          </div>
        </div>

        <!-- Wisata Card 3 -->
        <div class="event-card" data-category="wisata" data-name="NuArt Sculpture Park Bandung">
          <div class="event-thumbnail">
            <span class="event-badge-floating" style="background:var(--goers-teal);">Galeri Seni</span>
            <img src="https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?auto=format&fit=crop&w=600&q=80" alt="NuArt Sculpture Park" loading="lazy" />
          </div>
          <div class="event-body">
            <div>
              <div class="event-date-row" style="color:var(--goers-teal);">
                <i data-lucide="clock" style="width:14px;height:14px;"></i>
                Rabu - Minggu (09:00 - 17:00)
              </div>
              <h3 class="event-name">Jelajah Museum Seni NuArt Sculpture Park</h3>
              <div class="event-location-row">
                <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                Setraduta, Bandung
              </div>
            </div>
            <div class="event-footer">
              <div>
                <span class="price-label">Tiket Masuk</span>
                <div class="price-value" style="color:var(--goers-teal);">Rp 50.000</div>
              </div>
              <button class="btn-buy-ticket" onclick="showTicketDetail('Jelajah Museum Seni NuArt Sculpture Park', 'Rp 50.000', 'Rabu - Minggu', 'Setraduta, Bandung', 'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?auto=format&fit=crop&w=600&q=80', 'Wisata Seni')">Pesan Tiket</button>
            </div>
          </div>
        </div>

        <!-- Wisata Card 4 -->
        <div class="event-card" data-category="wisata" data-name="Puncak Tea Garden Tour">
          <div class="event-thumbnail">
            <span class="event-badge-floating" style="background:var(--goers-teal);">Ekowisata</span>
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" alt="Tea Garden Tour" loading="lazy" />
          </div>
          <div class="event-body">
            <div>
              <div class="event-date-row" style="color:var(--goers-teal);">
                <i data-lucide="clock" style="width:14px;height:14px;"></i>
                Buka Tiap Weekend
              </div>
              <h3 class="event-name">Sunrise Walk & Tea Walk Experience Gunung Mas</h3>
              <div class="event-location-row">
                <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                Puncak, Jawa Barat
              </div>
            </div>
            <div class="event-footer">
              <div>
                <span class="price-label">Mulai dari</span>
                <div class="price-value" style="color:var(--goers-teal);">Rp 35.000</div>
              </div>
              <button class="btn-buy-ticket" onclick="showTicketDetail('Sunrise Walk & Tea Walk Gunung Mas', 'Rp 35.000', 'Weekend', 'Puncak, Jawa Barat', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80', 'Tempat Wisata')">Pesan Tiket</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  --}}

  <!-- Section 4: Highlight Rute & Spot Ikonik Bukittinggi -->
  <section class="section-wrap" id="rute-section">
    <div class="goers-container">
      <div class="section-header">
        <div class="section-title-wrap">
          <span class="section-badge"><i data-lucide="map-pin" style="width:14px;height:14px;"></i> Rute & Venue Event</span>
          <h2 class="section-title">Highlight Rute & Spot Ikonik Bukittinggi</h2>
          <p class="section-subtitle">Rute lari malam 5K melewati berbagai ikon wisata malam Kota Bukittinggi yang mempesona</p>
        </div>
      </div>

      <div class="destination-grid">
        <div class="destination-card">
          <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=400&q=80" alt="Jam Gadang" />
          <div class="destination-overlay">
            <div class="destination-city">Jam Gadang</div>
            <div class="destination-count">Start & Finish / Main Stage</div>
          </div>
        </div>

        <div class="destination-card">
          <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" alt="Ngarai Sianok" />
          <div class="destination-overlay">
            <div class="destination-city">Ngarai Sianok</div>
            <div class="destination-count">Panorama Viewpoint & Photobooth</div>
          </div>
        </div>

        <div class="destination-card">
          <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=400&q=80" alt="Benteng Fort de Kock" />
          <div class="destination-overlay">
            <div class="destination-city">Fort de Kock</div>
            <div class="destination-count">Neon Light Tunnel Zone</div>
          </div>
        </div>

        <div class="destination-card">
          <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=400&q=80" alt="Jembatan Limpapeh" />
          <div class="destination-overlay">
            <div class="destination-city">Jembatan Limpapeh</div>
            <div class="destination-count">Cheering Station & DJ Booth</div>
          </div>
        </div>

        <div class="destination-card">
          <img src="https://images.unsplash.com/photo-1555899434-94d1368aa7af?auto=format&fit=crop&w=400&q=80" alt="Pasar Atas" />
          <div class="destination-overlay">
            <div class="destination-city">Pelataran Pasar Atas</div>
            <div class="destination-count">Glow Festival Food & Bazaar</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="goers-footer" id="help-section">
    <div class="goers-container">
      <div class="footer-top-grid">
        <!-- Brand & Description -->
        <div class="footer-brand">
          <img src="{{ asset('logo-lightandrun.png') }}" alt="Light and Glow Bukittinggi" class="footer-logo-img" />
          <h2>LIGHT & GLOW<span>.</span></h2>
          <p>
            Light and Glow Bukittinggi 2026 adalah perayaan akbar lari malam 5K dan konser spektakuler bertabur cahaya neon terbesar di Kota Bukittinggi, Sumatera Barat. Menyatukan semangat olahraga, pesona visual cahaya, dan hiburan panggung berkelas.
          </p>
          <div class="social-links">
            <a href="#" class="social-icon-btn" aria-label="Instagram">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
            </a>
            <a href="#" class="social-icon-btn" aria-label="Facebook">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
            <a href="#" class="social-icon-btn" aria-label="Twitter / X">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
            </a>
          </div>
        </div>

        <!-- Col 1 -->
        <div class="footer-col">
          <h4>Navigasi</h4>
          <ul class="footer-links">
            <li><a href="#tiket-section">Kategori Tiket</a></li>
            <li><a href="#highlight-section">Highlight Acara</a></li>
            <li><a href="#rute-section">Rute & Venue</a></li>
            <li><a href="{{ route('buyer.dashboard') }}">Tiket Saya</a></li>
            <li><a href="{{ route('login') }}">Admin Portal</a></li>
          </ul>
        </div>

        <!-- Col 2 -->
        <div class="footer-col">
          <h4>Tentang Acara</h4>
          <ul class="footer-links">
            <li><a href="#">Light & Glow 2026</a></li>
            <li><a href="#">Jadwal Pengambilan Race Pack</a></li>
            <li><a href="#">Tata Tertib Lari Malam</a></li>
            <li><a href="#">Line-up Musisi Konser</a></li>
            <li><a href="#">Panduan Akses & Parkir</a></li>
          </ul>
        </div>

        <!-- Col 3 -->
        <div class="footer-col">
          <h4>Bantuan & Info</h4>
          <ul class="footer-links">
            <li><a href="#">Pusat Informasi Tiket</a></li>
            <li><a href="#">Tata Cara Bayar QRIS</a></li>
            <li><a href="#">Hubungi Panitia Pelaksana</a></li>
            <li><a href="#">Syarat dan Ketentuan</a></li>
            <li><a href="#">Kebijakan Privasi</a></li>
          </ul>
        </div>

        <!-- Col 4: Newsletter -->
        <div class="footer-col">
          <h4>Info Kuota & Promo</h4>
          <p style="font-size:12px; margin-bottom:12px; color:#9CA3AF;">Dapatkan kabar update kuota tiket dan info bintang tamu panggung konser langsung ke emailmu.</p>
          <form class="newsletter-form" onsubmit="handleSubscribe(event)">
            <div class="newsletter-input-group">
              <input type="email" required placeholder="Alamat email Anda..." class="newsletter-input" />
              <button type="submit" class="btn-newsletter">Kirim</button>
            </div>
            <span id="subSuccess" style="color:#10B981; font-size:12px; display:none;">Terima kasih telah berlangganan!</span>
          </form>
        </div>
      </div>

      <!-- Footer Bottom -->
      <div class="footer-bottom">
        <div>
          &copy; 2026 Light and Glow Run Bukittinggi. All Rights Reserved.
        </div>
        <div style="display:flex; gap:16px;">
          <a href="#" style="color:#9CA3AF;">Kebijakan Privasi</a>
          <span>•</span>
          <a href="#" style="color:#9CA3AF;">Syarat & Ketentuan</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Cookie Banner -->
  <div class="cookie-banner" id="cookieBanner">
    <div class="cookie-text">
      Kami menggunakan cookies untuk mempermudah pengalaman Anda saat memesan tiket di website resmi Light and Glow Bukittinggi.
    </div>
    <button class="btn-cookie-accept" onclick="acceptCookies()">Saya Setuju</button>
  </div>

  <!-- Ticket Detail & Booking Modal (Berdasarkan template Goers, Tanpa SweetAlert) -->
  <div class="modal-overlay" id="ticketModal" onclick="closeModalOnOverlay(event)">
    <div class="modal-content" style="max-height:92vh; display:flex; flex-direction:column;">
      
      <!-- STEP 1: Detail Tiket -->
      <div id="bookingStepDetail" style="display:flex; flex-direction:column; height:100%; overflow:hidden;">
        <div class="modal-header">
          <h3 id="modalTitle">Detail Tiket Light & Glow</h3>
          <button class="modal-close-btn" onclick="closeTicketModal()"><i data-lucide="x" style="width:20px;height:20px;"></i></button>
        </div>
        <div class="modal-body" style="overflow-y:auto; flex:1;">
          <img id="modalImg" class="modal-image" src="" alt="Detail Tiket" />
          <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
            <span id="modalCategory" style="background:var(--goers-branding-100); color:var(--goers-branding-500); font-weight:800; font-size:12px; padding:4px 10px; border-radius:4px;">Kategori</span>
            <span id="modalDate" style="font-size:13px; font-weight:700; color:var(--goers-navy-900);">Tanggal</span>
          </div>
          <h2 id="modalEventName" style="font-size:20px; font-weight:800; color:var(--goers-navy-900); margin-bottom:10px;">Nama Paket Tiket</h2>
          <div style="display:flex; align-items:center; gap:6px; font-size:13px; color:var(--goers-gray-700); margin-bottom:16px;">
            <i data-lucide="map-pin" style="width:16px;height:16px;"></i>
            <span id="modalLocation">Jam Gadang, Bukittinggi</span>
          </div>
          <div style="border-top:1px solid var(--goers-gray-300); padding-top:14px;">
            <h4 style="font-size:14px; font-weight:700; margin-bottom:6px;">Tentang Tiket & Event:</h4>
            <p style="font-size:13px; color:var(--goers-gray-800); line-height:1.6;">
              E-tiket resmi dan QR Code unik akan otomatis tersimpan di menu <strong>Tiket Saya</strong> & dikirimkan ke email Anda setelah pembayaran QRIS diverifikasi oleh admin. Tunjukkan QR Code digital kepada petugas scanner saat pengambilan race pack dan hari acara.
            </p>
          </div>
        </div>
        <div class="modal-footer">
          <div>
            <span style="font-size:11px; color:var(--goers-gray-700);">Harga Total</span>
            <div id="modalPrice" style="font-size:20px; font-weight:800; color:var(--goers-branding-500);">Rp 0</div>
          </div>
          <button class="btn-signup" style="padding:10px 24px;" onclick="proceedCheckout()">Pesan Sekarang</button>
        </div>
      </div>

      <!-- STEP 2: Form Data Diri Pembeli -->
      <div id="bookingStepForm" style="display:none; flex-direction:column; height:100%; overflow:hidden;">
        <div class="modal-header">
          <div style="display:flex; align-items:center; gap:8px;">
            <button onclick="switchBookingStep('detail')" style="color:var(--goers-navy-900); display:flex; align-items:center;" title="Kembali"><i data-lucide="arrow-left" style="width:20px;height:20px;"></i></button>
            <h3 style="margin:0;">Data Diri Pembeli</h3>
          </div>
          <button class="modal-close-btn" onclick="closeTicketModal()"><i data-lucide="x" style="width:20px;height:20px;"></i></button>
        </div>
        <div class="modal-body" style="overflow-y:auto; flex:1;">
          <div style="background:#FFF1F2; border:1px solid #FECDD3; padding:12px 14px; border-radius:10px; margin-bottom:16px; display:flex; justify-content:space-between; align-items:center;">
            <div>
              <div style="font-size:12px; color:#9F1239;">Paket Dipilih:</div>
              <strong id="formSelectedTicketName" style="color:#0F172A; font-size:14px;">-</strong>
            </div>
            <div id="formSelectedTicketPrice" style="font-weight:800; color:#EB1355; font-size:16px;">-</div>
          </div>

          <form id="buyerCheckoutForm" onsubmit="submitCheckoutOrder(event)" style="display:flex; flex-direction:column; gap:14px;">
            <div>
              <label style="display:block; font-size:12px; font-weight:700; color:#0F172A; margin-bottom:4px;">Nama Lengkap (Sesuai KTP / Tanda Pengenal) <span style="color:#EB1355;">*</span></label>
              <input type="text" id="custName" class="newsletter-input" style="width:100%; border-color:#CBD5E1; color:#0F172A; background:#fff; font-size:13px; height:42px; border-radius:8px;" required placeholder="Contoh: Rian Hidayat" value="{{ $buyer['name'] ?? '' }}">
            </div>
            <div>
              <label style="display:block; font-size:12px; font-weight:700; color:#0F172A; margin-bottom:4px;">Alamat Email Aktif (Pengiriman E-Tiket) <span style="color:#EB1355;">*</span></label>
              <input type="email" id="custEmail" class="newsletter-input" style="width:100%; border-color:#CBD5E1; color:#0F172A; background:#fff; font-size:13px; height:42px; border-radius:8px;" required placeholder="Contoh: rian@email.com" value="{{ $buyer['email'] ?? '' }}">
            </div>
            <div>
              <label style="display:block; font-size:12px; font-weight:700; color:#0F172A; margin-bottom:4px;">Nomor WhatsApp Aktif <span style="color:#EB1355;">*</span></label>
              <input type="tel" id="custPhone" class="newsletter-input" style="width:100%; border-color:#CBD5E1; color:#0F172A; background:#fff; font-size:13px; height:42px; border-radius:8px;" required placeholder="Contoh: 081234567890" value="{{ $buyer['phone'] ?? '' }}">
            </div>
            <div>
              <label style="display:block; font-size:12px; font-weight:700; color:#0F172A; margin-bottom:4px;">Nomor KTP / NIK / Kartu Pelajar (Opsional)</label>
              <input type="text" id="custNik" class="newsletter-input" style="width:100%; border-color:#CBD5E1; color:#0F172A; background:#fff; font-size:13px; height:42px; border-radius:8px;" placeholder="Contoh: 1375012304950001" value="{{ $buyer['nik'] ?? '' }}">
            </div>
            <div id="checkoutFormError" style="display:none; color:#DC2626; font-size:12px; background:#FEF2F2; padding:8px 12px; border-radius:6px; border:1px solid #FCA5A5;"></div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-login" onclick="switchBookingStep('detail')" style="border-color:#CBD5E1; color:#64748B;">Kembali</button>
          <button type="button" id="btnSubmitCheckout" class="btn-signup" style="padding:10px 24px;" onclick="document.getElementById('buyerCheckoutForm').requestSubmit()">
            Lanjut ke Pembayaran QRIS →
          </button>
        </div>
      </div>

      <!-- STEP 3: Pembayaran QRIS (Template Style) -->
      <div id="bookingStepPayment" style="display:none; flex-direction:column; height:100%; overflow:hidden;">
        <div class="modal-header">
          <div>
            <h3 style="margin:0; font-size:16px;" id="payModalOrderNumber">Pembayaran QRIS</h3>
            <span style="font-size:11px; color:#64748B;">Scan kode QRIS berikut menggunakan aplikasi m-Banking atau e-Wallet</span>
          </div>
          <button class="modal-close-btn" onclick="closeTicketModal()"><i data-lucide="x" style="width:20px;height:20px;"></i></button>
        </div>
        <div class="modal-body" style="overflow-y:auto; flex:1; text-align:center;">
          <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:10px; padding:12px; margin-bottom:14px; text-align:left;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:4px;">
              <span style="font-size:12px; color:#64748B;">Pesanan Atas Nama:</span>
              <strong id="payModalBuyerName" style="font-size:13px; color:#0F172A;">-</strong>
            </div>
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:4px;">
              <span style="font-size:12px; color:#64748B;">Kategori Tiket:</span>
              <span id="payModalTicketName" style="font-size:12px; font-weight:700; color:#0F172A;">-</span>
            </div>
            <div style="display:flex; justify-content:space-between; align-items:center; border-top:1px dashed #CBD5E1; padding-top:6px; margin-top:6px;">
              <span style="font-size:12px; font-weight:700; color:#0F172A;">Total Tagihan:</span>
              <span id="payModalTotalAmount" style="font-size:18px; font-weight:900; color:#EB1355;">-</span>
            </div>
          </div>

          <!-- QRIS Image Box -->
          <div style="background:#ffffff; border:2px solid #E2E8F0; border-radius:14px; padding:16px; display:inline-block; margin-bottom:12px; box-shadow:0 6px 16px rgba(0,0,0,0.06);">
            <img id="payModalQrisImg" src="" alt="QRIS Code" style="width:200px; height:200px; margin:0 auto; display:block;" />
            <div style="font-size:11px; font-weight:800; color:#0F172A; margin-top:10px; letter-spacing:0.05em;">QRIS STANDAR PEMBAYARAN NASIONAL</div>
            <div style="font-size:10px; color:#64748B; margin-top:2px;">BCA · Mandiri · BRI · BNI · GoPay · OVO · ShopeePay · DANA</div>
          </div>

          <div style="background:#FFFBEB; border:1px solid #FDE68A; border-radius:10px; padding:10px 14px; text-align:left; font-size:12px; color:#92400E; line-height:1.5;">
            <strong>Petunjuk Pembayaran:</strong>
            <ol style="margin:4px 0 0 18px; padding:0;">
              <li>Buka aplikasi m-Banking atau e-Wallet pilihan Anda.</li>
              <li>Scan kode QRIS di atas dan selesaikan pembayaran sesuai nominal tepat.</li>
              <li>Simpan bukti/screenshot transfer dan klik tombol di bawah untuk unggah bukti.</li>
            </ol>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-login" onclick="closeTicketModal()" style="border-color:#CBD5E1; color:#64748B;">Bayar Nanti</button>
          <button type="button" class="btn-signup" style="padding:10px 22px; background:#10B981;" onclick="switchBookingStep('upload')">
            <i data-lucide="upload" style="width:16px;height:16px; vertical-align:middle; display:inline-block; margin-right:4px;"></i>
            Saya Sudah Bayar (Unggah Bukti)
          </button>
        </div>
      </div>

      <!-- STEP 4: Unggah Bukti Pembayaran -->
      <div id="bookingStepUpload" style="display:none; flex-direction:column; height:100%; overflow:hidden;">
        <div class="modal-header">
          <div style="display:flex; align-items:center; gap:8px;">
            <button onclick="switchBookingStep('payment')" style="color:var(--goers-navy-900); display:flex; align-items:center;" title="Kembali ke QRIS"><i data-lucide="arrow-left" style="width:20px;height:20px;"></i></button>
            <h3 style="margin:0;">Unggah Bukti Transfer</h3>
          </div>
          <button class="modal-close-btn" onclick="closeTicketModal()"><i data-lucide="x" style="width:20px;height:20px;"></i></button>
        </div>
        <div class="modal-body" style="overflow-y:auto; flex:1;">
          <div style="background:#F0FDF4; border:1px solid #BBF7D0; border-radius:10px; padding:12px 14px; margin-bottom:16px; color:#166534; font-size:13px;">
            Pesanan: <strong id="uploadOrderNumber">-</strong><br>
            Nominal Tagihan: <strong id="uploadOrderTotal">-</strong>
          </div>

          <form id="uploadProofForm" onsubmit="submitPaymentProof(event)" style="display:flex; flex-direction:column; gap:14px;">
            <div>
              <label style="display:block; font-size:12px; font-weight:700; color:#0F172A; margin-bottom:6px;">Foto / Screenshot Bukti Pembayaran QRIS <span style="color:#EB1355;">*</span></label>
              <input type="file" id="proofFileInput" accept="image/*" required style="width:100%; padding:10px; border:2px dashed #CBD5E1; border-radius:10px; background:#F8FAFC; cursor:pointer;" onchange="previewProofImage(this)">
              <div id="proofPreviewContainer" style="display:none; margin-top:10px; text-align:center;">
                <img id="proofPreviewImg" src="" style="max-height:180px; max-width:100%; border-radius:8px; border:1px solid #E2E8F0; margin:0 auto;" alt="Pratinjau Bukti">
              </div>
            </div>
            <div>
              <label style="display:block; font-size:12px; font-weight:700; color:#0F172A; margin-bottom:4px;">Catatan Tambahan (Opsional)</label>
              <input type="text" id="proofNoteInput" class="newsletter-input" style="width:100%; border-color:#CBD5E1; color:#0F172A; background:#fff; font-size:13px; height:42px; border-radius:8px;" placeholder="Contoh: Transfer via BCA atas nama Rian">
            </div>
            <div id="uploadFormError" style="display:none; color:#DC2626; font-size:12px; background:#FEF2F2; padding:8px 12px; border-radius:6px; border:1px solid #FCA5A5;"></div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-login" onclick="switchBookingStep('payment')" style="border-color:#CBD5E1; color:#64748B;">Kembali</button>
          <button type="button" id="btnSubmitProof" class="btn-signup" style="padding:10px 24px; background:#10B981;" onclick="document.getElementById('uploadProofForm').requestSubmit()">
            Kirim Bukti Pembayaran
          </button>
        </div>
      </div>

      <!-- STEP 5: Sukses & Menunggu Verifikasi Admin -->
      <div id="bookingStepSuccess" style="display:none; flex-direction:column; height:100%; overflow:hidden;">
        <div class="modal-header">
          <h3 style="margin:0; color:#10B981;">Bukti Berhasil Dikirim!</h3>
          <button class="modal-close-btn" onclick="closeTicketModal()"><i data-lucide="x" style="width:20px;height:20px;"></i></button>
        </div>
        <div class="modal-body" style="overflow-y:auto; flex:1; text-align:center; padding:30px 20px;">
          <div style="width:64px; height:64px; border-radius:50%; background:#DCFCE7; color:#16A34A; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
            <i data-lucide="check" style="width:36px;height:36px;"></i>
          </div>
          <h3 style="font-size:18px; font-weight:800; color:#0F172A; margin-bottom:6px;">Terima Kasih, Bukti Pembayaran Telah Diterima!</h3>
          <p style="font-size:13px; color:#64748B; line-height:1.6; max-width:440px; margin:0 auto 18px;">
            Pesanan Anda <strong id="successOrderNumber" style="color:#0F172A;">-</strong> sedang diverifikasi oleh admin. Tiket digital ber-QR Code unik akan otomatis aktif di halaman <strong>Tiket Saya</strong> begitu pembayaran disetujui.
          </p>
          <div style="background:#FFFBEB; border:1px solid #FDE68A; border-radius:10px; padding:12px; display:inline-block; font-size:12px; color:#92400E; margin-bottom:20px;">
            Status: <span style="font-weight:800; color:#D97706;">Menunggu Verifikasi Admin</span>
          </div>
        </div>
        <div class="modal-footer" style="justify-content:center;">
          <a href="{{ route('buyer.dashboard') }}" class="btn-signup" style="padding:12px 28px; text-decoration:none;">
            Buka Halaman Tiket Saya →
          </a>
        </div>
      </div>

    </div>
  </div>

  <!-- Modal Peringatan Harus Login (Bila Pembeli Belum Login) -->
  <div class="modal-overlay" id="requireLoginModal" onclick="closeRequireLoginModal(event)">
    <div class="modal-content" style="max-width:440px; text-align:center; padding:28px 24px;">
      <div style="width:58px; height:58px; border-radius:50%; background:#FFF1F2; color:#EB1355; display:flex; align-items:center; justify-content:center; margin:0 auto 14px;">
        <i data-lucide="lock" style="width:28px;height:28px;"></i>
      </div>
      <h3 style="font-size:18px; font-weight:800; color:var(--goers-navy-900); margin-bottom:8px;">Harus Masuk Terlebih Dahulu</h3>
      <p style="font-size:13px; color:var(--goers-gray-700); line-height:1.6; margin-bottom:22px;">
        Untuk melakukan pemesanan tiket <strong>Light and Glow Bukittinggi 2026</strong>, Anda harus masuk ke akun pembeli terlebih dahulu agar e-tiket dapat tersimpan dengan aman di riwayat Anda.
      </p>
      <div style="display:flex; flex-direction:column; gap:10px;">
        <a href="{{ route('buyer.login') }}" class="btn-signup" style="width:100%; text-align:center; padding:12px; font-size:14px; text-decoration:none;">
          Masuk ke Akun Saya
        </a>
        <a href="{{ route('buyer.register') }}" class="btn-login" style="width:100%; text-align:center; padding:10px; font-size:13px; border-color:var(--goers-gray-400); color:var(--goers-navy-900); text-decoration:none;">
          Belum punya akun? Daftar Sekarang
        </a>
        <button type="button" onclick="closeRequireLoginModal()" style="color:#94A3B8; font-size:12px; margin-top:4px; background:none; border:none; cursor:pointer;">
          Tutup
        </button>
      </div>
    </div>
  </div>

  <!-- External JavaScript Logic -->
  <script src="{{ asset('script.js') }}"></script>

  
  <!-- Full CMS Dynamic Hydration Script -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      try {
        const raw = localStorage.getItem('goers_full_cms');
        if (!raw) return;
        const d = JSON.parse(raw);
        if (d.brandLogoText && d.brandLogoText.toUpperCase().includes('GOERS')) {
          localStorage.removeItem('goers_full_cms');
          return;
        }
        if (d.brandLogoText) {
          const el = document.getElementById('cmsBrandLogoText');
          if (el) el.textContent = d.brandLogoText;
        }
        if (d.topBarText) {
          const el = document.getElementById('cmsTopBar');
          if (el) el.innerHTML = d.topBarText;
        }

        // Hero Slide 1
        if (d.slide1Tag) { const el = document.getElementById('cmsSlide1Tag'); if (el) el.textContent = d.slide1Tag; }
        if (d.slide1Img) { const el = document.getElementById('cmsSlide1Img'); if (el) el.src = d.slide1Img; }
        if (d.slide1Title) { const el = document.getElementById('cmsSlide1Title'); if (el) el.textContent = d.slide1Title; }
        if (d.slide1Desc) { const el = document.getElementById('cmsSlide1Desc'); if (el) el.textContent = d.slide1Desc; }

        // Hero Slide 2
        if (d.slide2Tag) { const el = document.getElementById('cmsSlide2Tag'); if (el) el.textContent = d.slide2Tag; }
        if (d.slide2Img) { const el = document.getElementById('cmsSlide2Img'); if (el) el.src = d.slide2Img; }
        if (d.slide2Title) { const el = document.getElementById('cmsSlide2Title'); if (el) el.textContent = d.slide2Title; }
        if (d.slide2Desc) { const el = document.getElementById('cmsSlide2Desc'); if (el) el.textContent = d.slide2Desc; }

        // Hero Slide 3
        if (d.slide3Tag) { const el = document.getElementById('cmsSlide3Tag'); if (el) el.textContent = d.slide3Tag; }
        if (d.slide3Img) { const el = document.getElementById('cmsSlide3Img'); if (el) el.src = d.slide3Img; }
        if (d.slide3Title) { const el = document.getElementById('cmsSlide3Title'); if (el) el.textContent = d.slide3Title; }
        if (d.slide3Desc) { const el = document.getElementById('cmsSlide3Desc'); if (el) el.textContent = d.slide3Desc; }

        // Concert Headers
        if (d.concertHeaderTitle) { const el = document.getElementById('cmsConcertTitle'); if (el) el.textContent = d.concertHeaderTitle; }
        if (d.concertHeaderDesc) { const el = document.getElementById('cmsConcertDesc'); if (el) el.textContent = d.concertHeaderDesc; }

        // Crowd & GEM
        if (d.crowdTitle) { const el = document.getElementById('cmsCrowdTitle'); if (el) el.innerHTML = d.crowdTitle; }
        if (d.crowdDesc) { const el = document.getElementById('cmsCrowdDesc'); if (el) el.textContent = d.crowdDesc; }
        if (d.gemTitle) { const el = document.getElementById('cmsGemTitle'); if (el) el.textContent = d.gemTitle; }
        if (d.gemDesc) { const el = document.getElementById('cmsGemDesc'); if (el) el.textContent = d.gemDesc; }

        // Selesai sinkronisasi konten CMS
      } catch (e) {
        console.error('Error synchronizing CMS to landing page', e);
      }
    });
  </script>
</body>
