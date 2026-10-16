<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $ticket->name }} · Detail & Benefit Tiket Resmi | Light And Glow Bukittinggi 2026</title>
  <meta name="description" content="Informasi lengkap paket {{ $ticket->name }}, fasilitas peserta, dan benefit resmi Light and Glow Bukittinggi 2026." />
  <meta name="theme-color" content="#070B19" />

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
  <link rel="alternate icon" href="{{ asset('favicon.ico') }}" />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,400;0,500;0,700;1,400&family=Montserrat:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- External Stylesheet -->
  <link rel="stylesheet" href="{{ asset('style.css') }}" />

  <style>
    .ticket-page-bg {
      background: #F8FAFC;
      min-height: calc(100vh - 80px);
      padding: 32px 0 64px;
    }

    .ticket-back-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 24px;
    }

    .btn-back-home {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-weight: 700;
      font-size: 14px;
      color: #0F172A;
      background: #ffffff;
      border: 1px solid var(--goers-gray-300);
      padding: 8px 18px;
      border-radius: var(--radius-full);
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
      transition: all 0.2s;
    }

    .btn-back-home:hover {
      border-color: #00B4D8;
      color: #0077B6;
      transform: translateX(-2px);
    }

    .ticket-detail-grid {
      display: grid;
      grid-template-columns: 1.1fr 0.9fr;
      gap: 32px;
      align-items: start;
    }

    @media (max-width: 900px) {
      .ticket-detail-grid {
        grid-template-columns: 1fr;
        gap: 24px;
      }
    }

    /* Left Card: Media & Benefits */
    .ticket-main-card {
      background: #ffffff;
      border-radius: 20px;
      border: 1px solid var(--goers-gray-300);
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    }

    .ticket-cover-wrap {
      position: relative;
      width: 100%;
      height: 320px;
      background: #070B19;
      overflow: hidden;
    }

    @media (max-width: 600px) {
      .ticket-cover-wrap {
        height: 220px;
      }
    }

    .ticket-cover-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 0.92;
    }

    .ticket-cover-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, transparent 40%, rgba(7, 11, 25, 0.85) 100%);
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 24px;
      color: #fff;
    }

    .ticket-category-tag {
      display: inline-block;
      background: linear-gradient(135deg, #00E5FF, #00B4D8);
      color: #070B19;
      font-weight: 800;
      font-size: 11px;
      padding: 4px 10px;
      border-radius: 999px;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      margin-bottom: 8px;
      width: fit-content;
      box-shadow: 0 0 10px rgba(0,229,255,0.4);
    }

    .ticket-title-big {
      font-family: var(--font-family-heading);
      font-size: 28px;
      font-weight: 800;
      line-height: 1.25;
      color: #fff;
    }

    @media (max-width: 600px) {
      .ticket-title-big {
        font-size: 22px;
      }
    }

    .ticket-card-content {
      padding: 32px;
    }

    @media (max-width: 600px) {
      .ticket-card-content {
        padding: 20px;
      }
    }

    /* Benefits Section */
    .benefit-box {
      background: #F8FAFC;
      border-radius: 16px;
      border: 1px solid #E2E8F0;
      padding: 24px;
      margin-bottom: 28px;
    }

    .benefit-box-title {
      font-family: var(--font-family-heading);
      font-size: 18px;
      font-weight: 800;
      color: var(--goers-navy-900);
      margin-bottom: 16px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .benefit-box-title .badge-icon {
      width: 28px;
      height: 28px;
      border-radius: 8px;
      background: rgba(0, 180, 216, 0.15);
      color: #0077B6;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .benefit-list {
      list-style: none;
      display: grid;
      grid-template-columns: 1fr;
      gap: 12px;
    }

    .benefit-item {
      display: flex;
      align-items: center;
      gap: 12px;
      background: #ffffff;
      padding: 12px 16px;
      border-radius: 12px;
      border: 1px solid #E2E8F0;
      font-size: 14px;
      font-weight: 600;
      color: #1E293B;
      transition: all 0.2s;
    }

    .benefit-item:hover {
      border-color: #00E5FF;
      box-shadow: 0 2px 10px rgba(0,229,255,0.1);
      transform: translateX(4px);
    }

    .benefit-check {
      width: 22px;
      height: 22px;
      border-radius: 50%;
      background: #DCFCE7;
      color: #16A34A;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      font-size: 12px;
      font-weight: 800;
    }

    /* Event Specs Table */
    .event-info-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
      margin-bottom: 24px;
    }

    .event-info-table tr {
      border-bottom: 1px solid #F1F5F9;
    }

    .event-info-table td {
      padding: 10px 0;
    }

    .event-info-label {
      color: #64748B;
      font-weight: 600;
      width: 35%;
    }

    .event-info-value {
      color: #0F172A;
      font-weight: 700;
    }

    /* Right Sticky Checkout Card */
    .checkout-sticky-card {
      background: #ffffff;
      border-radius: 20px;
      border: 1px solid var(--goers-gray-300);
      padding: 32px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.06);
      position: sticky;
      top: 96px;
    }

    @media (max-width: 600px) {
      .checkout-sticky-card {
        padding: 20px;
        position: static;
      }
    }

    .price-large-wrap {
      margin-bottom: 20px;
      padding-bottom: 18px;
      border-bottom: 1px dashed #CBD5E1;
    }

    .price-large-label {
      font-size: 13px;
      font-weight: 600;
      color: #64748B;
      margin-bottom: 4px;
    }

    .price-large-amount {
      font-family: var(--font-family-heading);
      font-size: 32px;
      font-weight: 800;
      color: #0077B6;
    }

    .quota-info-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 12px;
      font-weight: 700;
      padding: 4px 12px;
      border-radius: 999px;
      margin-top: 6px;
    }

    .btn-checkout-action {
      width: 100%;
      background: linear-gradient(135deg, #00E5FF 0%, #00B4D8 100%);
      color: #070B19;
      font-weight: 800;
      font-size: 16px;
      padding: 14px 20px;
      border-radius: var(--radius-full);
      box-shadow: 0 4px 16px rgba(0, 229, 255, 0.4);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      cursor: pointer;
      border: none;
      transition: all 0.2s;
      font-family: 'Montserrat', sans-serif;
    }

    .btn-checkout-action:hover:not(:disabled) {
      background: linear-gradient(135deg, #76FF03 0%, #00E5FF 100%);
      box-shadow: 0 6px 20px rgba(118, 255, 3, 0.5);
      transform: translateY(-2px);
    }

    .btn-checkout-action:disabled {
      background: #94A3B8 !important;
      color: #F1F5F9 !important;
      cursor: not-allowed !important;
      box-shadow: none !important;
      opacity: 0.85;
    }

    .security-badge {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 12px;
      color: #64748B;
      margin-top: 16px;
      justify-content: center;
    }

    /* Modal Checkout Direct QRIS */
    .checkout-modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.65);
      backdrop-filter: blur(4px);
      z-index: 10000;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 16px;
    }

    .checkout-modal-overlay.active {
      display: flex;
    }

    .checkout-modal-content {
      background: #ffffff;
      border-radius: 20px;
      max-width: 520px;
      width: 100%;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(0,0,0,0.25);
      animation: modalFadeIn 0.25s ease-out;
    }
  </style>
</head>
<body data-buyer-logged-in="{{ !empty($buyer) ? '1' : '0' }}" data-login-url="{{ route('buyer.login') }}">

  <!-- Header -->
  <header class="goers-header">
    <div class="goers-container">
      <div class="goers-nav-wrapper">
        <a href="{{ route('home') }}" class="goers-brand-logo">
          <img src="{{ asset('logo-lightandrun.png') }}" alt="Light and Glow" class="brand-logo-img" />
          <span id="cmsBrandLogoText">LIGHT & GLOW</span><span class="dot">.</span>
        </a>

        <div style="font-size:14px; font-weight:700; color:var(--goers-navy-900); display:flex; align-items:center; gap:8px;">
          Preview & Fasilitas Tiket Resmi
        </div>

        <div class="goers-nav-actions">
          @if(!empty($buyer))
            <a href="{{ route('buyer.dashboard') }}" class="btn-login" style="padding:8px 16px; font-size:13px;">
              Tiket Saya ({{ Str::limit($buyer['name'], 10) }})
            </a>
          @else
            <a href="{{ route('buyer.login') }}" class="btn-login" style="padding:8px 16px; font-size:13px;">
              Masuk
            </a>
          @endif
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="ticket-page-bg">
    <div class="goers-container">
      
      <!-- Back Bar -->
      <div class="ticket-back-bar">
        <a href="{{ route('home') }}#tiket-section" class="btn-back-home">
          <i data-lucide="arrow-left" style="width:16px;height:16px;"></i>
          Kembali ke Katalog Tiket
        </a>
        <div style="font-size:12px; color:#64748B;">
          Status: <strong>{{ $ticket->remaining_quota > 0 ? 'Tersedia' : 'Habis Terjual' }}</strong>
        </div>
      </div>

      @php
        $isSoldOut = ($ticket->remaining_quota <= 0);
        $imgUrl = $ticket->image ?: asset('poster-lightandglowrun.jpeg');
        // Parse list benefit (baris per baris atau dipisahkan koma)
        $benefitsRaw = trim($ticket->benefits ?? '');
        $benefitList = [];
        if (!empty($benefitsRaw)) {
          if (str_contains($benefitsRaw, "\n")) {
            $benefitList = array_filter(array_map('trim', explode("\n", $benefitsRaw)));
          } elseif (str_contains($benefitsRaw, ',')) {
            $benefitList = array_filter(array_map('trim', explode(',', $benefitsRaw)));
          } else {
            $benefitList = [$benefitsRaw];
          }
        }
      @endphp

      <div class="ticket-detail-grid">
        
        <!-- Left: Image Cover & List Benefit -->
        <div class="ticket-main-card">
          <div class="ticket-cover-wrap">
            <img src="{{ $imgUrl }}" alt="{{ $ticket->name }}" class="ticket-cover-img" />
            <div class="ticket-cover-overlay">
              <span class="ticket-category-tag">{{ strtoupper($ticket->category ?? 'REGULER') }}</span>
              <h1 class="ticket-title-big">{{ $ticket->name }}</h1>
            </div>
          </div>

          <div class="ticket-card-content">
            
            <!-- List Benefit (Sesuai Pamflet & Database) -->
            <div class="benefit-box">
              <div class="benefit-box-title">
                <div class="badge-icon">
                  <i data-lucide="gift" style="width:16px;height:16px;"></i>
                </div>
                <span>Fasilitas & Benefit Peserta:</span>
              </div>

              @if(count($benefitList) > 0)
                <ul class="benefit-list">
                  @foreach($benefitList as $b)
                    <li class="benefit-item">
                      <span class="benefit-check">✓</span>
                      <span>{{ $b }}</span>
                    </li>
                  @endforeach
                </ul>
              @else
                <p style="font-size:13px; color:#64748B; margin:0;">
                  Paket tiket mencakup akses area lari malam 5K dan area konser musik resmi Light And Glow Bukittinggi 2026.
                </p>
              @endif
            </div>

            <!-- Informasi Jadwal & Lokasi -->
            <h3 style="font-family:var(--font-family-heading); font-size:16px; font-weight:800; color:var(--goers-navy-900); margin-bottom:14px;">
              Detail Penyelenggaraan:
            </h3>
            <table class="event-info-table">
              <tr>
                <td class="event-info-label">Nama Acara</td>
                <td class="event-info-value">{{ $event->title ?? 'Light And Glow Bukittinggi 2026' }}</td>
              </tr>
              <tr>
                <td class="event-info-label">Hari & Tanggal</td>
                <td class="event-info-value">
                  {{ !empty($event->event_date) ? \Carbon\Carbon::parse($event->event_date)->translatedFormat('l, d F Y') : 'Sabtu, 25 April 2026' }}
                </td>
              </tr>
              <tr>
                <td class="event-info-label">Waktu Start</td>
                <td class="event-info-value">
                  {{ !empty($event->start_time) ? substr($event->start_time, 0, 5) . ' WIB' : '17:00 WIB' }} - 
                  {{ !empty($event->end_time) ? substr($event->end_time, 0, 5) . ' WIB' : '23:30 WIB' }}
                </td>
              </tr>
              <tr>
                <td class="event-info-label">Lokasi / Venue</td>
                <td class="event-info-value">{{ $event->location ?? 'Jam Gadang, Bukittinggi, Sumatera Barat' }}</td>
              </tr>
              <tr>
                <td class="event-info-label">Akses Gate</td>
                <td class="event-info-value">Gate 1 & Gate 2 (Sesuai E-Tiket QR)</td>
              </tr>
              <tr>
                <td class="event-info-label">Penukaran Race Pack</td>
                <td class="event-info-value">Mulai Pukul 14.00 WIB di Booth Penukaran Panitia</td>
              </tr>
            </table>

            <!-- Section QRIS Resmi Acara -->
            <div style="margin-top:20px; background:#F8FAFC; border:1.5px solid #E2E8F0; border-radius:16px; padding:18px;">
              <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                <div style="display:flex; align-items:center; gap:8px;">
                  <span style="font-weight:800; font-size:14px; color:#0F172A;">QRIS Resmi Pembayaran</span>
                  <span style="font-size:10px; font-weight:800; background:#DCFCE7; color:#15803D; padding:2px 8px; border-radius:12px;">TERVERIFIKASI</span>
                </div>
                <span style="font-size:11px; color:#64748B;">{{ $event->qris_merchant_name ?? 'LIGHT AND GLOW BUKITTINGGI' }}</span>
              </div>

              <div style="display:flex; flex-wrap:wrap; gap:16px; align-items:center;">
                <div style="background:#fff; border:1px solid #CBD5E1; border-radius:12px; padding:10px; width:130px; height:130px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                  @if(!empty($event->qris_image))
                    <img src="{{ Str::startsWith($event->qris_image, ['http://', 'https://']) ? $event->qris_image : asset(ltrim($event->qris_image, '/')) }}" alt="QRIS Resmi Panitia" style="width:100%; height:100%; object-fit:contain; border-radius:8px;" />
                  @else
                    <div style="text-align:center; padding:6px; color:#94A3B8; font-size:11px;">
                      <i data-lucide="qr-code" style="width:32px;height:32px;margin:0 auto 4px;color:#CBD5E1;"></i>
                      <span>QRIS Diperbarui saat Checkout</span>
                    </div>
                  @endif
                </div>
                <div style="flex:1; min-width:200px;">
                  <p style="font-size:12px; color:#475569; margin:0 0 8px; line-height:1.5;">
                    Pembayaran tiket dapat dilakukan langsung melalui pemindaian barcode QRIS toko resmi panitia di atas menggunakan aplikasi BCA, Mandiri, Dana, GoPay, OVO, atau LinkAja.
                  </p>
                  <span style="font-size:11px; color:#0284C7; font-weight:700;">
                    ✓ Barcode QRIS & rincian total tagihan juga akan ditampilkan lengkap di modal checkout.
                  </span>
                </div>
              </div>
            </div>

            <div style="background:#FFFBEB; border:1px solid #FDE68A; border-radius:12px; padding:14px; font-size:13px; color:#B45309; line-height:1.6; margin-top:16px;">
              <strong>Catatan Penting:</strong> E-tiket digital ber-QR code unik akan langsung terbit di dashboard akun Anda setelah pembayaran diverifikasi oleh panitia. Tiket hanya dapat dipindai <strong>1 kali</strong> di gerbang masuk.
            </div>

          </div>
        </div>

        <!-- Right: Checkout Box -->
        <div class="checkout-sticky-card">
          <div class="price-large-wrap">
            <div class="price-large-label">Harga Tiket Resmi:</div>
            <div class="price-large-amount">Rp {{ number_format($ticket->price, 0, ',', '.') }}</div>
            
            <div style="margin-top:8px;">
              @if($isSoldOut)
                <span class="quota-info-pill" style="background:#FEE2E2; color:#B91C1C; border:1px solid #FECACA;">
                  <i data-lucide="alert-circle" style="width:13px;height:13px;"></i> Kuota Habis Terjual
                </span>
              @elseif($ticket->remaining_quota <= 15)
                <span class="quota-info-pill" style="background:#FEF3C7; color:#B45309; border:1px solid #FDE68A;">
                  <i data-lucide="clock" style="width:13px;height:13px;"></i> Sisa Kuota Menipis: {{ $ticket->remaining_quota }} Tiket
                </span>
              @else
                <span class="quota-info-pill" style="background:#DCFCE7; color:#15803D; border:1px solid #BBF7D0;">
                  <i data-lucide="check-circle" style="width:13px;height:13px;"></i> Tersedia: {{ $ticket->remaining_quota }} Tiket
                </span>
              @endif
            </div>
          </div>

          <div style="margin-bottom:20px;">
            <label style="display:block; font-size:13px; font-weight:700; color:#0F172A; margin-bottom:6px;">Metode Pembayaran:</label>
            <div style="display:flex; align-items:center; gap:10px; background:#F8FAFC; border:1.5px solid #CBD5E1; border-radius:12px; padding:12px 14px;">
              <span style="font-weight:800; font-size:14px; color:#0F172A;">QRIS Instant</span>
              <span style="font-size:11px; background:#E0F9FE; color:#0077B6; padding:2px 8px; border-radius:6px; font-weight:700; margin-left:auto;">{{ $event->qris_merchant_name ?? 'BCA / Mandiri / Dana / GoPay' }}</span>
            </div>
          </div>

          @if($isSoldOut)
            <button class="btn-checkout-action" disabled>
              Tiket Habis Terjual
            </button>
          @else
            <button class="btn-checkout-action" onclick="handleStartCheckout()">
              <i data-lucide="ticket" style="width:18px;height:18px;"></i>
              Pesan Tiket Ini Sekarang
            </button>
          @endif

          <div class="security-badge">
            <i data-lucide="shield-check" style="width:16px;height:16px; color:#10B981;"></i>
            <span>Transaksi 100% Aman & Terenkripsi</span>
          </div>
        </div>

      </div>

    </div>
  </main>

  <!-- Modal Checkout Pembeli (Untuk Proses Pembayaran QRIS) -->
  <div class="checkout-modal-overlay" id="checkoutModal">
    <div class="checkout-modal-content">
      
      <!-- Step 1: Form Identitas Pembeli -->
      <div id="modalStepForm" style="display:flex; flex-direction:column; padding:24px;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px; border-bottom:1px solid #E2E8F0; padding-bottom:12px;">
          <h3 style="font-size:17px; font-weight:800; color:#0F172A; margin:0;">Data Pemesan Tiket</h3>
          <button onclick="closeCheckoutModal()" style="border:none; background:none; cursor:pointer; color:#64748B;"><i data-lucide="x" style="width:20px;height:20px;"></i></button>
        </div>

        <div id="checkoutFormError" style="display:none; background:#FEF2F2; color:#B91C1C; padding:10px 14px; border-radius:8px; font-size:13px; font-weight:600; margin-bottom:14px;"></div>

        <div style="margin-bottom:14px;">
          <label style="display:block; font-size:13px; font-weight:700; color:#0F172A; margin-bottom:4px;">Nama Lengkap (Sesuai KTP) *</label>
          <input type="text" id="buyerInputName" value="{{ $buyer['name'] ?? '' }}" placeholder="Nama Pemegang Tiket" class="goers-search-input" style="height:42px; border-radius:10px; padding:0 14px;" />
        </div>

        <div style="margin-bottom:14px;">
          <label style="display:block; font-size:13px; font-weight:700; color:#0F172A; margin-bottom:4px;">Email Aktif (E-Tiket dikirim ke sini) *</label>
          <input type="email" id="buyerInputEmail" value="{{ $buyer['email'] ?? '' }}" placeholder="nama@email.com" class="goers-search-input" style="height:42px; border-radius:10px; padding:0 14px;" />
        </div>

        <div style="margin-bottom:18px;">
          <label style="display:block; font-size:13px; font-weight:700; color:#0F172A; margin-bottom:4px;">Nomor WhatsApp *</label>
          <input type="text" id="buyerInputPhone" value="{{ $buyer['phone'] ?? '' }}" placeholder="08xxxxxxxxxx" class="goers-search-input" style="height:42px; border-radius:10px; padding:0 14px;" />
        </div>

        <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:12px; padding:14px; margin-bottom:18px; display:flex; justify-content:space-between; align-items:center;">
          <div>
            <div style="font-size:12px; color:#64748B;">Total Tagihan (1 Tiket):</div>
            <div style="font-size:18px; font-weight:800; color:#0077B6;">Rp {{ number_format($ticket->price, 0, ',', '.') }}</div>
          </div>
          <span style="font-size:12px; font-weight:700; background:#DCFCE7; color:#15803D; padding:4px 10px; border-radius:20px;">QRIS Otomatis</span>
        </div>

        <button type="button" id="btnSubmitOrder" class="btn-checkout-action" onclick="submitTicketOrder()">
          Lanjut ke Pembayaran QRIS →
        </button>
      </div>

      <!-- Step 2: Bayar QRIS & Upload Bukti -->
      <div id="modalStepPay" style="display:none; flex-direction:column; padding:24px; text-align:center;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px; border-bottom:1px solid #E2E8F0; padding-bottom:10px;">
          <h3 id="payOrderTitle" style="font-size:16px; font-weight:800; color:#0F172A; margin:0;">Pembayaran QRIS</h3>
          <button onclick="closeCheckoutModal()" style="border:none; background:none; cursor:pointer; color:#64748B;"><i data-lucide="x" style="width:20px;height:20px;"></i></button>
        </div>

        <p style="font-size:13px; color:#64748B; margin-bottom:12px;">Scan kode QRIS berikut menggunakan aplikasi m-Banking atau E-Wallet apa saja:</p>

        <div style="border:2px dashed #CBD5E1; padding:14px; border-radius:16px; display:inline-block; margin:0 auto 12px; background:#fff;">
          <img id="qrisCodeImage" src="" alt="QRIS" style="width:200px; height:200px; display:block; object-fit:contain;" />
        </div>

        <div style="font-size:14px; font-weight:800; color:#0F172A; margin-bottom:4px;">Total: <span id="payTotalText" style="color:#0077B6;">Rp {{ number_format($ticket->price, 0, ',', '.') }}</span></div>
        <div style="font-size:11px; color:#94A3B8; margin-bottom:16px;">Nomor Pesanan: <strong id="payOrderNumberText">-</strong></div>

        <!-- Form Upload Bukti -->
        <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:12px; padding:14px; text-align:left; margin-bottom:16px;">
          <label style="display:block; font-size:12px; font-weight:700; color:#0F172A; margin-bottom:6px;">Unggah Bukti Transfer / Screenshot Pembayaran:</label>
          <input type="file" id="proofFileInput" accept="image/*" style="font-size:12px; width:100%;" />
        </div>

        <button type="button" id="btnUploadProof" class="btn-checkout-action" onclick="submitPaymentProof()">
          Kirim Bukti Pembayaran
        </button>
      </div>

      <!-- Step 3: Sukses -->
      <div id="modalStepSuccess" style="display:none; flex-direction:column; padding:32px 24px; text-align:center;">
        <div style="width:60px; height:60px; border-radius:50%; background:#DCFCE7; color:#15803D; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
          <i data-lucide="check" style="width:32px;height:32px;"></i>
        </div>
        <h3 style="font-size:20px; font-weight:800; color:#0F172A; margin-bottom:8px;">Pesanan Berhasil Dikirim!</h3>
        <p style="font-size:13px; color:#64748B; line-height:1.6; margin-bottom:24px;">
          Bukti pembayaran Anda telah diterima dan sedang diverifikasi oleh panitia. Anda dapat langsung memantau status pesanan dan e-tiket di halaman <strong>Tiket Saya</strong>.
        </p>
        <a href="{{ route('buyer.dashboard') }}" class="btn-checkout-action">
          Buka Dashboard Tiket Saya →
        </a>
      </div>

    </div>
  </div>

  <!-- Footer -->
  <footer class="goers-footer" style="padding:24px 0; border-top:1px solid #E2E8F0; text-align:center; font-size:12px; color:#94A3B8;">
    &copy; 2026 Light And Glow Bukittinggi · Penjualan Tiket Resmi
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      if (window.lucide) lucide.createIcons();
    });

    let currentOrderId = null;

    function handleStartCheckout() {
      const isLogged = document.body.getAttribute('data-buyer-logged-in') === '1';
      if (!isLogged) {
        window.location.href = "{{ route('buyer.login') }}";
        return;
      }
      document.getElementById('modalStepForm').style.display = 'flex';
      document.getElementById('modalStepPay').style.display = 'none';
      document.getElementById('modalStepSuccess').style.display = 'none';
      document.getElementById('checkoutModal').classList.add('active');
      if (window.lucide) lucide.createIcons();
    }

    function closeCheckoutModal() {
      document.getElementById('checkoutModal').classList.remove('active');
    }

    function submitTicketOrder() {
      const name = document.getElementById('buyerInputName').value.trim();
      const email = document.getElementById('buyerInputEmail').value.trim();
      const phone = document.getElementById('buyerInputPhone').value.trim();
      const errEl = document.getElementById('checkoutFormError');

      if (!name || !email || !phone) {
        errEl.textContent = 'Mohon isi nama lengkap, email, dan nomor WhatsApp.';
        errEl.style.display = 'block';
        return;
      }
      errEl.style.display = 'none';

      const btn = document.getElementById('btnSubmitOrder');
      btn.disabled = true;
      btn.textContent = 'Memproses Pesanan...';

      fetch('/api/checkout', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
          ticket_type_id: {{ $ticket->id }},
          name: name,
          email: email,
          phone: phone,
          quantity: 1,
          payment_method: 'QRIS'
        })
      })
      .then(res => res.json())
      .then(data => {
        btn.disabled = false;
        btn.textContent = 'Lanjut ke Pembayaran QRIS →';

        if (!data.success) {
          errEl.textContent = data.message || 'Gagal membuat pesanan tiket.';
          errEl.style.display = 'block';
          return;
        }

        currentOrderId = data.order_id;
        document.getElementById('payOrderTitle').textContent = `Pembayaran ${data.order_number}`;
        document.getElementById('payOrderNumberText').textContent = data.order_number;
        document.getElementById('payTotalText').textContent = data.total_formatted || 'Rp {{ number_format($ticket->price, 0, ",", ".") }}';
        
        const qrUrl = data.qris_image_url || `https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=${encodeURIComponent(data.qris_payload)}`;
        document.getElementById('qrisCodeImage').src = qrUrl;

        document.getElementById('modalStepForm').style.display = 'none';
        document.getElementById('modalStepPay').style.display = 'flex';
        if (window.lucide) lucide.createIcons();
      })
      .catch(err => {
        btn.disabled = false;
        btn.textContent = 'Lanjut ke Pembayaran QRIS →';
        errEl.textContent = err.message || 'Terjadi kesalahan jaringan.';
        errEl.style.display = 'block';
      });
    }

    function submitPaymentProof() {
      const fileInput = document.getElementById('proofFileInput');
      if (!fileInput.files || fileInput.files.length === 0) {
        alert('Silakan pilih file bukti transfer terlebih dahulu!');
        return;
      }

      const btn = document.getElementById('btnUploadProof');
      btn.disabled = true;
      btn.textContent = 'Mengunggah Bukti...';

      const formData = new FormData();
      formData.append('proof_of_payment', fileInput.files[0]);

      fetch(`/api/orders/${currentOrderId}/upload-proof`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        btn.disabled = false;
        btn.textContent = 'Kirim Bukti Pembayaran';

        if (data.success) {
          document.getElementById('modalStepPay').style.display = 'none';
          document.getElementById('modalStepSuccess').style.display = 'flex';
          if (window.lucide) lucide.createIcons();
        } else {
          alert(data.message || 'Gagal mengunggah bukti.');
        }
      })
      .catch(err => {
        btn.disabled = false;
        btn.textContent = 'Kirim Bukti Pembayaran';
        alert('Terjadi kesalahan saat mengunggah bukti.');
      });
    }
  </script>
</body>
</html>
