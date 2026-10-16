<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Pembeli · Riwayat Transaksi & E-Tiket Saya | Light And Glow Bukittinggi</title>
  <meta name="description" content="Cek riwayat pembelian tiket dan lihat e-tiket digital ber-QR Code unik Anda." />
  <meta name="theme-color" content="#EB1355" />
  
  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
  <link rel="alternate icon" href="{{ asset('favicon.ico') }}" />

  <!-- Google Fonts: Karla & Montserrat & Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,400;0,500;0,700;1,400&family=Montserrat:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Template Stylesheet -->
  <link rel="stylesheet" href="{{ asset('style.css') }}" />

  <style>
    .buyer-dashboard-wrap {
      background: #F8FAFC;
      min-height: calc(100vh - 120px);
      padding: 40px 0 60px;
    }
    .buyer-header-card {
      background: #ffffff;
      border-radius: 16px;
      padding: 28px;
      border: 1px solid var(--goers-gray-300);
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 28px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.03);
    }
    @media (max-width: 768px) {
      .buyer-header-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
      }
    }
    .buyer-profile-info {
      display: flex;
      align-items: center;
      gap: 16px;
    }
    .buyer-avatar {
      width: 56px;
      height: 56px;
      border-radius: 50%;
      background: linear-gradient(135deg, #00E5FF, #0077B6);
      color: #070B19;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 20px;
      box-shadow: 0 0 16px rgba(0, 229, 255, 0.45);
    }
    .buyer-nav-tabs {
      display: flex;
      gap: 12px;
      border-bottom: 2px solid var(--goers-gray-300);
      margin-bottom: 24px;
    }
    .buyer-tab-item {
      padding: 12px 20px;
      font-weight: 700;
      font-size: 15px;
      color: var(--goers-gray-700);
      cursor: pointer;
      border-bottom: 3px solid transparent;
      margin-bottom: -2px;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: all 0.2s;
    }
    .buyer-tab-item.active {
      color: #0077B6;
      border-bottom-color: #00E5FF;
    }
    .order-card {
      background: #ffffff;
      border-radius: 16px;
      border: 1px solid var(--goers-gray-300);
      padding: 24px;
      margin-bottom: 20px;
      transition: all 0.2s;
      box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    }
    .order-card:hover {
      box-shadow: 0 8px 24px rgba(0,0,0,0.06);
      border-color: #E2E8F0;
    }
    .order-card-head {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid var(--goers-gray-300);
      padding-bottom: 14px;
      margin-bottom: 16px;
    }
    .order-card-body {
      display: flex;
      gap: 20px;
    }
    @media (max-width: 640px) {
      .order-card-body {
        flex-direction: column;
      }
    }
    .order-thumb {
      width: 120px;
      height: 90px;
      border-radius: 10px;
      object-fit: cover;
      flex-shrink: 0;
    }
    .order-info {
      flex: 1;
    }
    .status-pill {
      font-size: 12px;
      font-weight: 800;
      padding: 4px 12px;
      border-radius: 20px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .status-pill.success {
      background: #DCFCE7;
      color: #15803D;
    }
    .status-pill.pending {
      background: #FEF3C7;
      color: #B45309;
    }
    .status-pill.danger {
      background: #FEE2E2;
      color: #B91C1C;
    }
    .ticket-qr-box {
      border: 2px dashed #CBD5E1;
      padding: 16px;
      border-radius: 12px;
      text-align: center;
      background: #F8FAFC;
    }
    .qr-container {
      position: relative;
      display: inline-block;
      border-radius: 14px;
      overflow: hidden;
      background: #ffffff;
      padding: 14px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .qr-container.is-expired img {
      filter: grayscale(100%) blur(1.5px) opacity(0.35);
    }
    .qr-expired-overlay {
      position: absolute;
      inset: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background: rgba(15, 23, 42, 0.45);
      border-radius: 14px;
      pointer-events: none;
      z-index: 5;
    }
    .qr-expired-cross {
      width: 72px;
      height: 72px;
      border-radius: 50%;
      background: rgba(239, 68, 68, 0.95);
      color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 20px rgba(239, 68, 68, 0.6);
      border: 3px solid #ffffff;
      margin-bottom: 6px;
      animation: pulseAlert 2s infinite ease-in-out;
    }
    @keyframes pulseAlert {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.06); }
    }
    .qr-expired-label {
      background: #EF4444;
      color: #ffffff;
      font-size: 11px;
      font-weight: 800;
      letter-spacing: 1.5px;
      padding: 4px 12px;
      border-radius: 999px;
      text-transform: uppercase;
      box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }
    .proof-preview-modal-img {
      max-width: 100%;
      max-height: 70vh;
      object-fit: contain;
      border-radius: 12px;
      border: 1px solid var(--goers-gray-300);
      background: #F8FAFC;
    }

    /* Mobile Enhancements */
    @media (max-width: 768px) {
      .buyer-dashboard-wrap {
        padding: 20px 0 40px;
      }
      .buyer-header-card {
        padding: 18px;
        margin-bottom: 20px;
      }
      .buyer-nav-tabs {
        overflow-x: auto;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
        gap: 6px;
        padding-bottom: 2px;
      }
      .buyer-tab-item {
        padding: 10px 14px;
        font-size: 13px;
        flex-shrink: 0;
      }
      .order-card {
        padding: 16px;
      }
      .order-card-head {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }
      .order-thumb {
        width: 100%;
        height: 160px;
      }
      .order-card-body {
        flex-direction: column;
      }
      .order-card-action-col {
        text-align: left !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: space-between !important;
        border-top: 1px dashed #E2E8F0;
        padding-top: 14px;
        margin-top: 8px;
      }
      .goers-header .goers-nav-wrapper {
        flex-wrap: wrap;
        height: auto;
        padding: 10px 0;
        gap: 10px;
      }
    }

    /* ==========================================================================
       PRINT SPECIFIC STYLES: Ensures 1 Single Clean Page for PDF & Print
       ========================================================================== */
    @page {
      size: A4 portrait;
      margin: 10mm;
    }

    @media print {
      /* Hide all website background elements, headers, navbars, tabs, modals except printable area */
      body, html {
        background: #ffffff !important;
        color: #0F172A !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        height: auto !important;
      }

      .top-bar,
      .goers-header,
      .buyer-dashboard-wrap,
      .goers-footer,
      #proofModal,
      .modal-header,
      .modal-footer,
      .modal-close-btn,
      .btn-signup,
      .btn-login {
        display: none !important;
      }

      /* Modal Overlay becomes normal container in print */
      body.printing-ticket #eTicketModal.modal-overlay,
      body.printing-invoice #invoiceModal.modal-overlay,
      #eTicketModal.modal-overlay.active,
      #invoiceModal.modal-overlay.active {
        display: block !important;
        position: static !important;
        background: transparent !important;
        backdrop-filter: none !important;
        padding: 0 !important;
        inset: auto !important;
        width: 100% !important;
        height: auto !important;
      }

      body.printing-invoice #eTicketModal,
      body.printing-ticket #invoiceModal {
        display: none !important;
      }

      /* Base modal styles */
      #eTicketModal .modal-content,
      #invoiceModal .modal-content {
        display: block !important;
        position: static !important;
        background: #ffffff !important;
        color: #0F172A !important;
        border-radius: 16px !important;
        margin: 0 auto !important;
        padding: 0 !important;
        box-shadow: none !important;
        animation: none !important;
        page-break-inside: avoid !important;
        break-inside: avoid !important;
      }

      /* Specific for e-Ticket Pass */
      #eTicketModal .modal-content {
        max-width: 480px !important;
        border: 2px solid #00B4D8 !important;
        overflow: hidden !important;
      }

      /* Specific for Invoice */
      #invoiceModal .modal-content {
        max-width: 620px !important;
        border: 1px solid #CBD5E1 !important;
      }

      #printableTicketArea,
      #printableInvoiceArea {
        padding: 24px 28px !important;
        color: #0F172A !important;
        background: #ffffff !important;
        page-break-inside: avoid !important;
        break-inside: avoid !important;
      }

      /* Header Logo inside printable areas */
      .print-doc-header {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        border-bottom: 2px solid #0F172A !important;
        padding-bottom: 14px !important;
        margin-bottom: 18px !important;
      }

      .print-brand-wrap {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
      }

      .print-brand-logo {
        height: 48px !important;
        width: auto !important;
        object-fit: contain !important;
      }

      .print-brand-title {
        font-size: 18px !important;
        font-weight: 900 !important;
        color: #070B19 !important;
        letter-spacing: 0.5px !important;
        line-height: 1.1 !important;
      }

      .print-brand-sub {
        font-size: 11px !important;
        color: #64748B !important;
        font-weight: 600 !important;
      }

      /* e-Ticket Pass specific styling */
      .ticket-print-header {
        background: linear-gradient(135deg, #070B19, #0C1227) !important;
        color: #ffffff !important;
        padding: 16px 20px !important;
        text-align: center !important;
        border-radius: 12px 12px 0 0 !important;
        margin: -24px -28px 18px -28px !important;
      }

      .ticket-print-header h2 {
        color: #ffffff !important;
        font-size: 18px !important;
        margin: 4px 0 2px !important;
      }

      .ticket-print-header p {
        color: #94A3B8 !important;
        font-size: 12px !important;
        margin: 0 !important;
      }

      .qr-container {
        border: 2px dashed #00B4D8 !important;
        padding: 12px !important;
        box-shadow: none !important;
        background: #F8FAFC !important;
        display: inline-block !important;
        margin-bottom: 10px !important;
        border-radius: 12px !important;
      }

      .qr-container img {
        width: 160px !important;
        height: 160px !important;
      }

      #modalETicketCode {
        color: #0284C7 !important;
        font-size: 15px !important;
        font-weight: 800 !important;
        margin-bottom: 12px !important;
      }

      #printableTicketArea .print-ticket-info,
      #printableInvoiceArea .invoice-table-wrap,
      #printableInvoiceArea .invoice-info-box {
        background: #F8FAFC !important;
        border: 1px solid #E2E8F0 !important;
        color: #1E293B !important;
        border-radius: 10px !important;
        padding: 14px 16px !important;
        font-size: 12px !important;
        line-height: 1.8 !important;
      }

      #printableTicketArea .print-ticket-info strong,
      #printableInvoiceArea strong {
        color: #0F172A !important;
      }

      #printableTicketArea .print-ticket-info span,
      #printableInvoiceArea span {
        color: #64748B !important;
      }

      .print-footer-notice {
        display: block !important;
        margin-top: 14px !important;
        padding-top: 10px !important;
        border-top: 1px dashed #CBD5E1 !important;
        font-size: 10.5px !important;
        color: #64748B !important;
        text-align: center !important;
      }
    }
  </style>
</head>
<body>

  <!-- Top Announcement Bar -->
  <div class="top-bar">
    <div class="goers-container" style="display:flex; justify-content:space-between; align-items:center; width:100%;">
      <div>
        <span>⚡ Area Pembeli Tiket Resmi <strong>Light And Glow Bukittinggi 2026</strong></span>
      </div>
      <div class="top-bar-right">
        <a href="{{ route('home') }}" class="top-bar-item">
          <i data-lucide="arrow-left" style="width:14px; height:14px;"></i>
          Kembali ke Beranda
        </a>
      </div>
    </div>
  </div>

  <!-- Header -->
  <header class="goers-header">
    <div class="goers-container">
      <div class="goers-nav-wrapper">
        <a href="{{ route('home') }}" class="goers-brand-logo">
          <img src="{{ asset('logo-lightandrun.png') }}" alt="Light and Glow" class="brand-logo-img" />
          <span id="cmsBrandLogoText">LIGHT & GLOW</span><span class="dot">.</span>
        </a>

        <div style="font-size:14px; font-weight:700; color:var(--goers-navy-900); display:flex; align-items:center; gap:8px;">
          <i data-lucide="ticket" style="width:18px;height:18px; color:#00B4D8;"></i>
          Dashboard Tiket & Transaksi Saya
        </div>

        <div class="goers-nav-actions">
          <a href="{{ route('home') }}#tiket-section" class="btn-signup" style="padding:8px 16px; font-size:13px;">
            + Beli Tiket Lain
          </a>
          <a href="{{ route('login') }}" class="btn-login" style="padding:8px 16px; font-size:13px;">
            Portal Admin
          </a>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Buyer Content -->
  <main class="buyer-dashboard-wrap">
    <div class="goers-container">
      
      <!-- Buyer Profile Card -->
      @php
        $latestBuyer = $orders->first();
        $buyerName = $latestBuyer ? $latestBuyer->buyer_name : 'Sahabat Light and Glow';
        $buyerEmail = $latestBuyer ? $latestBuyer->buyer_email : 'info@lightandglow.id';
        $buyerPhone = $latestBuyer ? $latestBuyer->buyer_phone : '-';
        $initials = collect(explode(' ', $buyerName))->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->join('');
      @endphp
      <div class="buyer-header-card">
        <div class="buyer-profile-info">
          <div class="buyer-avatar">{{ $initials ?: 'LG' }}</div>
          <div>
            <h1 style="font-size:20px; font-weight:800; color:var(--goers-navy-900); margin-bottom:4px;">{{ $buyerName }}</h1>
            <p style="font-size:13px; color:var(--goers-gray-700); margin:0;">{{ $buyerEmail }} · {{ $buyerPhone }}</p>
          </div>
        </div>
        <div style="text-align:right;">
          <span style="font-size:12px; color:var(--goers-gray-700);">Total E-Tiket Terbit:</span>
          <div style="font-size:22px; font-weight:800; color:var(--goers-branding-500);">{{ $digitalTickets->count() }} Tiket Aktif</div>
        </div>
      </div>

      <!-- Navigation Tabs -->
      <div class="buyer-nav-tabs">
        <div class="buyer-tab-item active" id="tab-orders" onclick="switchBuyerTab('orders')">
          <i data-lucide="receipt" style="width:18px;height:18px;"></i>
          Riwayat Pembelian & Transaksi ({{ $orders->count() }})
        </div>
        <div class="buyer-tab-item" id="tab-tickets" onclick="switchBuyerTab('tickets')">
          <i data-lucide="qr-code" style="width:18px;height:18px;"></i>
          Tiket Digital Aktif & QR Code ({{ $digitalTickets->count() }})
        </div>
      </div>

      <!-- Section 1: Riwayat Pembelian -->
      <div id="content-orders">
        @forelse($orders as $ord)
          <div class="order-card">
            <div class="order-card-head">
              <div>
                <span style="font-size:12px; color:var(--goers-gray-700);">Nomor Pesanan:</span>
                <strong style="font-size:15px; color:var(--goers-navy-900); margin-left:4px;">{{ $ord->order_number }}</strong>
                <span style="font-size:12px; color:#94A3B8; margin-left:8px;">• {{ \Carbon\Carbon::parse($ord->created_at)->translatedFormat('d M Y, H:i') }} WIB</span>
              </div>
              @if($ord->status === 'Pembayaran disetujui')
                <span class="status-pill success">
                  <i data-lucide="check-circle" style="width:14px;height:14px;"></i>
                  Pembayaran Disetujui
                </span>
              @elseif($ord->status === 'Menunggu verifikasi')
                <span class="status-pill pending">
                  <i data-lucide="clock" style="width:14px;height:14px;"></i>
                  Menunggu Pembayaran Diverifikasi oleh Admin
                </span>
              @elseif($ord->status === 'Pembayaran ditolak')
                <span class="status-pill danger">
                  <i data-lucide="x-circle" style="width:14px;height:14px;"></i>
                  Pembayaran Ditolak
                </span>
              @else
                <span class="status-pill pending">
                  <i data-lucide="alert-circle" style="width:14px;height:14px;"></i>
                  {{ $ord->status }}
                </span>
              @endif
            </div>
            <div class="order-card-body">
              <img src="{{ $ord->ticket_image ?? 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?w=500&auto=format&fit=crop&q=60' }}" class="order-thumb" alt="{{ $ord->ticket_name }}">
              <div class="order-info">
                <span style="background:var(--goers-branding-100); color:var(--goers-branding-500); font-weight:800; font-size:11px; padding:2px 8px; border-radius:4px;">{{ strtoupper($ord->ticket_category ?? 'FESTIVAL') }}</span>
                <h3 style="font-size:16px; font-weight:800; color:var(--goers-navy-900); margin:6px 0 4px;">{{ $ord->ticket_name }}</h3>
                <p style="font-size:13px; color:var(--goers-gray-700); margin-bottom:8px;">Sabtu, 25 April 2026 · Jam Gadang Bukittinggi</p>
                <div style="font-size:12px; color:#64748B;">
                  Metode: <strong>{{ $ord->payment_method ?? 'QRIS' }}</strong> · Pemesan: <strong>{{ $ord->buyer_name }}</strong> ({{ $ord->quantity }} Tiket)
                  @php
                    $proofUrl = null;
                    if (!empty($ord->payment_proof)) {
                      $proofUrl = str_starts_with($ord->payment_proof, 'http') ? $ord->payment_proof : asset('storage/' . $ord->payment_proof);
                    }
                  @endphp
                  @if($proofUrl)
                    · Bukti: <button type="button" onclick="showProofModal('{{ $proofUrl }}', '{{ $ord->order_number }}')" style="background:none; border:none; padding:0; color:#10B981; font-weight:700; text-decoration:underline; cursor:pointer; font-size:12px; display:inline-flex; align-items:center; gap:4px;">
                      <i data-lucide="image" style="width:13px;height:13px;"></i> Lihat Bukti
                    </button>
                  @endif
                </div>
              </div>
              <div class="order-card-action-col" style="text-align:right; display:flex; flex-direction:column; justify-content:space-between;">
                <div>
                  <span style="font-size:11px; color:#64748B;">Total Tagihan:</span>
                  <div style="font-size:18px; font-weight:800; color:var(--goers-branding-500);">Rp {{ number_format($ord->total_amount ?? 0, 0, ',', '.') }}</div>
                </div>
                <div style="display:flex; flex-wrap:wrap; gap:8px; justify-content:flex-end;">
                  <button type="button" class="btn-login" style="padding:8px 14px; font-size:12px; border-color:#CBD5E1; color:#0F172A; display:inline-flex; align-items:center; gap:6px; background:#F8FAFC;" onclick='openInvoiceModal(@json($ord))'>
                    <i data-lucide="file-text" style="width:14px;height:14px; color:#0284C7;"></i>
                    Lihat Invoice
                  </button>

                  @if($ord->status === 'Pembayaran disetujui')
                    @php
                      $ticketForOrder = $digitalTickets->firstWhere('order_id', $ord->id);
                    @endphp
                    @if($ticketForOrder)
                      <button class="btn-signup" style="padding:8px 16px; font-size:12px;" onclick="openETicketModal('{{ $ord->ticket_name }}', '{{ $ord->order_number }}', '{{ $ticketForOrder->ticket_code }}', '{{ $ticketForOrder->qr_token }}', '{{ $ticketForOrder->holder_name }}', '{{ $ticketForOrder->status }}', '{{ $ticketForOrder->used_at }}', '{{ $ticketForOrder->ticket_category ?? 'FESTIVAL' }}', '{{ $ticketForOrder->gate ?? 'Gate 1 (Utama Jam Gadang)' }}')">
                        <i data-lucide="qr-code" style="width:14px;height:14px; vertical-align:middle; margin-right:4px;"></i>
                        Lihat E-Tiket
                      </button>
                    @endif
                  @elseif($ord->status === 'Menunggu verifikasi')
                    <button class="btn-login" style="padding:8px 14px; font-size:12px;" onclick="checkStatusPending('{{ $ord->order_number }}')">
                      Cek Status
                    </button>
                  @else
                    <span style="font-size:12px; color:#EF4444; font-weight:600; align-self:center;">{{ $ord->rejection_reason ?? $ord->status }}</span>
                  @endif
                </div>
              </div>
            </div>
          </div>
        @empty
          <div style="background:#fff; border-radius:16px; border:1px solid #E2E8F0; padding:48px 24px; text-align:center;">
            <i data-lucide="ticket-x" style="width:48px;height:48px; color:#94A3B8; margin-bottom:12px;"></i>
            <h3 style="font-size:18px; font-weight:800; color:var(--goers-navy-900);">Belum Ada Pesanan</h3>
            <p style="font-size:13px; color:#64748B; margin-bottom:16px;">Anda belum melakukan pemesanan tiket Light and Glow Bukittinggi 2026.</p>
            <a href="{{ route('home') }}#konser-section" class="btn-signup" style="display:inline-flex; align-items:center; gap:8px;">
              Pesan Tiket Sekarang
            </a>
          </div>
        @endforelse
      </div>

      <!-- Section 2: Tiket Digital & QR Code -->
      <div id="content-tickets" style="display:none;">
        <div style="background:#ffffff; border-radius:16px; border:1px solid var(--goers-gray-300); padding:28px;">
          <div style="margin-bottom:20px;">
            <h2 style="font-size:18px; font-weight:800; color:var(--goers-navy-900); margin-bottom:4px;">Tiket Masuk Digital Resmi (E-Pass)</h2>
            <p style="font-size:13px; color:var(--goers-gray-700); margin:0;">Tunjukkan QR Code berikut di layar ponsel Anda kepada petugas scanner saat masuk ke area Jam Gadang. Tiket hanya dapat di-scan <strong>1 kali</strong> saja.</p>
          </div>

          <div style="display:flex; flex-wrap:wrap; gap:24px; justify-content:center;">
            @forelse($digitalTickets as $dt)
              @php
                $isUsed = ($dt->status === 'Sudah digunakan');
              @endphp
              <div style="max-width:400px; width:100%; background:#0F172A; border-radius:18px; overflow:hidden; color:#fff; box-shadow:0 12px 30px rgba(0,0,0,0.15); margin-bottom:16px; border:{{ $isUsed ? '2px solid rgba(239,68,68,0.5)' : '1px solid #1E293B' }};">
                <div style="background:{{ $isUsed ? 'linear-gradient(135deg, #475569, #1E293B)' : 'linear-gradient(135deg, #EB1355, #881337)' }}; padding:20px; text-align:center;">
                  <span style="font-size:11px; letter-spacing:2px; text-transform:uppercase; opacity:0.8;">OFFICIAL E-TICKET</span>
                  <h3 style="font-size:18px; font-weight:800; margin:4px 0;">Light And Glow Bukittinggi 2026</h3>
                  <p style="font-size:12px; margin:0; opacity:0.9;">25 April 2026 · Jam Gadang, Bukittinggi</p>
                </div>

                <div style="padding:24px; text-align:center;">
                  <!-- QR Code Container dengan Efek Expired & Logo X Merah jika sudah digunakan -->
                  <div class="qr-container {{ $isUsed ? 'is-expired' : '' }}" style="margin-bottom:14px;">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ urlencode($dt->qr_token) }}" alt="QR Code {{ $dt->ticket_code }}" style="width:170px; height:170px; display:block;">
                    
                    @if($isUsed)
                      <div class="qr-expired-overlay">
                        <div class="qr-expired-cross">
                          <svg viewBox="0 0 24 24" width="46" height="46" fill="none" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                          </svg>
                        </div>
                        <span class="qr-expired-label">EXPIRED</span>
                      </div>
                    @endif
                  </div>

                  <div style="font-family:monospace; font-size:14px; font-weight:700; color:{{ $isUsed ? '#94A3B8' : '#38BDF8' }}; letter-spacing:1px; margin-bottom:8px;">{{ $dt->ticket_code }}</div>
                  
                  @if($isUsed)
                    <div style="display:inline-flex; align-items:center; gap:6px; background:rgba(239,68,68,0.2); color:#F87171; font-size:11px; font-weight:800; padding:5px 12px; border-radius:20px; border:1px solid rgba(239,68,68,0.4);">
                      <i data-lucide="x-circle" style="width:13px;height:13px;"></i>
                      SUDAH CHECK-IN / EXPIRED ({{ !empty($dt->used_at) ? \Carbon\Carbon::parse($dt->used_at)->format('H:i') : '' }} WIB)
                    </div>
                  @else
                    <div style="display:inline-flex; align-items:center; gap:6px; background:rgba(16,185,129,0.2); color:#34D399; font-size:11px; font-weight:800; padding:5px 12px; border-radius:20px; border:1px solid rgba(16,185,129,0.4);">
                      <i data-lucide="check-circle" style="width:13px;height:13px;"></i>
                      TIKET AKTIF & SIAP DIPAKAI (1x SCAN)
                    </div>
                  @endif

                  <div style="border-top:1px dashed #334155; margin-top:20px; padding-top:16px; text-align:left; font-size:12px; color:#94A3B8; line-height:1.7;">
                    <div><strong>Nama Pemegang:</strong> <span style="color:#fff;">{{ $dt->holder_name }}</span></div>
                    <div><strong>Kategori:</strong> <span style="color:#fff;">{{ $dt->ticket_name }}</span></div>
                    <div><strong>No. Pesanan:</strong> <span style="color:#fff;">{{ $dt->order_number }}</span></div>
                    <div><strong>Gate Masuk:</strong> <span style="color:#fff;">{{ $dt->gate ?? 'Gate 1 (Akses Utama Jam Gadang)' }}</span></div>
                    @if($isUsed)
                      <div style="color:#EF4444; font-weight:700; margin-top:4px;">⚠ Tiket ini telah diverifikasi di gerbang & tidak dapat digunakan lagi.</div>
                    @endif
                  </div>

                  <div style="margin-top:20px; display:flex; gap:8px;">
                    <button class="btn-signup" style="flex:1; justify-content:center; padding:10px; font-size:13px;" onclick="openETicketModal('{{ $dt->ticket_name }}', '{{ $dt->order_number }}', '{{ $dt->ticket_code }}', '{{ $dt->qr_token }}', '{{ $dt->holder_name }}', '{{ $dt->status }}', '{{ $dt->used_at }}', '{{ $dt->ticket_category ?? 'FESTIVAL' }}', '{{ $dt->gate ?? 'Gate 1 (Utama Jam Gadang)' }}')">
                      <i data-lucide="maximize-2" style="width:15px;height:15px; margin-right:6px;"></i>
                      Buka E-Pass
                    </button>
                    <button class="btn-login" style="padding:10px 14px; background:rgba(255,255,255,0.08); border-color:#334155; color:#fff;" title="Unduh / Cetak Tiket" onclick="directDownloadTicket('{{ $dt->ticket_code }}', '{{ $dt->holder_name }}', '{{ $dt->ticket_name }}', '{{ $dt->qr_token }}', '{{ $dt->status }}')">
                      <i data-lucide="download" style="width:16px;height:16px;"></i>
                    </button>
                  </div>
                </div>
              </div>
            @empty
              <div style="text-align:center; padding:32px; color:#64748B;">
                <i data-lucide="qr-code" style="width:40px;height:40px; margin-bottom:8px; opacity:0.5;"></i>
                <p>Belum ada tiket digital yang aktif. Begitu verifikasi pembayaran disetujui admin, tiket Anda akan muncul otomatis di sini.</p>
              </div>
            @endforelse
          </div>
        </div>
      </div>

    </div>
  </main>

  <!-- ==================== POP UP MODAL: BUKTI PEMBAYARAN ==================== -->
  <div id="proofModal" class="modal-overlay">
    <div class="modal-content" style="max-width: 520px;">
      <div class="modal-header">
        <div style="display:flex; align-items:center; gap:8px;">
          <i data-lucide="receipt" style="width:20px;height:20px; color:#10B981;"></i>
          <h3 style="margin:0; font-size:16px; font-weight:800; color:var(--goers-navy-900);">Bukti Pembayaran <span id="proofOrderNumText" style="color:var(--goers-branding-500);"></span></h3>
        </div>
        <button class="modal-close-btn" onclick="closeProofModal()"><i data-lucide="x" style="width:20px;height:20px;"></i></button>
      </div>
      <div class="modal-body" style="text-align:center; padding:20px;">
        <div style="margin-bottom:14px; text-align:left; font-size:12px; color:var(--goers-gray-700); background:#F8FAFC; padding:10px 14px; border-radius:8px; border:1px solid #E2E8F0;">
          Berikut screenshot / file bukti transfer QRIS yang telah diunggah untuk pesanan ini.
        </div>
        <div style="background:#0F172A; border-radius:12px; padding:12px; display:inline-block; max-width:100%;">
          <img id="proofModalImg" src="" alt="Bukti Pembayaran" class="proof-preview-modal-img" />
        </div>
      </div>
      <div class="modal-footer" style="display:flex; justify-content:space-between; align-items:center;">
        <a id="proofModalDownloadLink" href="#" target="_blank" download class="btn-login" style="padding:8px 16px; font-size:12px; display:inline-flex; align-items:center; gap:6px; border-color:#CBD5E1; color:#0F172A;">
          <i data-lucide="external-link" style="width:14px;height:14px;"></i> Buka Gambar Asli
        </a>
        <button type="button" class="btn-signup" onclick="closeProofModal()" style="padding:8px 20px; font-size:12px;">Tutup</button>
      </div>
    </div>
  </div>

  <!-- ==================== POP UP MODAL: E-TIKET DIGITAL & UNDUH ==================== -->
  <div id="eTicketModal" class="modal-overlay">
    <div class="modal-content" style="max-width: 460px; background:#0F172A; color:#fff; border:1px solid #334155;">
      <div class="modal-header" style="border-bottom:1px solid #1E293B; background:transparent;">
        <div style="display:flex; align-items:center; gap:8px;">
          <img src="{{ asset('logo-lightandrun.png') }}" alt="Logo" style="height:22px; width:auto; object-fit:contain;">
          <h3 style="margin:0; font-size:15px; font-weight:800; color:#fff;">E-Tiket Light & Glow Bukittinggi</h3>
        </div>
        <button class="modal-close-btn" onclick="closeETicketModal()" style="color:#94A3B8;"><i data-lucide="x" style="width:20px;height:20px;"></i></button>
      </div>

      <div class="modal-body" id="printableTicketArea" style="text-align:center; padding:24px 20px;">
        <!-- Header Print E-Pass -->
        <div class="ticket-print-header" style="background:linear-gradient(135deg, #070B19, #0C1227); padding:16px 20px; text-align:center; border-radius:12px 12px 0 0; margin:-24px -20px 18px -20px;">
          <div style="display:flex; align-items:center; justify-content:center; gap:10px; margin-bottom:4px;">
            <img src="{{ asset('logo-lightandrun.png') }}" alt="Logo Light & Glow" style="height:36px; width:auto; object-fit:contain;">
            <div style="text-align:left;">
              <span style="font-size:10px; letter-spacing:2px; color:#00E5FF; font-weight:800; text-transform:uppercase; display:block;">OFFICIAL ENTRANCE PASS</span>
              <strong style="font-size:14px; color:#fff; letter-spacing:0.5px;">LIGHT & GLOW BUKITTINGGI</strong>
            </div>
          </div>
          <h2 id="modalETicketEventTitle" style="font-size:17px; font-weight:800; margin:4px 0 2px; color:#fff;">Light And Glow Bukittinggi 2026</h2>
          <p style="font-size:11.5px; color:#94A3B8; margin:0;">Sabtu, 25 April 2026 · Jam Gadang Bukittinggi</p>
        </div>

        <!-- QR Box dengan efek expired bila sudah check-in -->
        <div id="modalQRContainer" class="qr-container" style="margin-bottom:12px;">
          <img id="modalQRImage" src="" alt="QR" style="width:170px; height:170px; display:block;">
          <div id="modalQRExpiredOverlay" class="qr-expired-overlay" style="display:none;">
            <div class="qr-expired-cross">
              <svg viewBox="0 0 24 24" width="46" height="46" fill="none" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
              </svg>
            </div>
            <span class="qr-expired-label">EXPIRED</span>
          </div>
        </div>

        <div id="modalETicketCode" style="font-family:monospace; font-size:15px; font-weight:800; letter-spacing:1px; margin-bottom:8px; color:#38BDF8;">-</div>
        <div id="modalETicketStatusBadge" style="margin-bottom:16px;"></div>

        <div class="print-ticket-info" style="background:#1E293B; border-radius:12px; padding:14px 16px; text-align:left; font-size:12px; color:#CBD5E1; line-height:1.75;">
          <div style="display:flex; justify-content:space-between; margin-bottom:3px;">
            <span style="color:#94A3B8;">Nama Pemegang:</span>
            <strong id="modalETicketHolder" style="color:#fff;">-</strong>
          </div>
          <div style="display:flex; justify-content:space-between; margin-bottom:3px;">
            <span style="color:#94A3B8;">Kategori Tiket:</span>
            <strong id="modalETicketCategory" style="color:#fff;">-</strong>
          </div>
          <div style="display:flex; justify-content:space-between; margin-bottom:3px;">
            <span style="color:#94A3B8;">Nomor Pesanan:</span>
            <strong id="modalETicketOrder" style="color:#fff;">-</strong>
          </div>
          <div style="display:flex; justify-content:space-between;">
            <span style="color:#94A3B8;">Akses Gate:</span>
            <strong id="modalETicketGate" style="color:#fff;">Gate 1 (Utama Jam Gadang)</strong>
          </div>
        </div>

        <div class="print-footer-notice" style="display:none;">
          Tunjukkan QR Code ini pada layar atau lembar cetak kepada panitia di Gate Masuk.<br>
          © 2026 Light And Glow Bukittinggi · Tiket Resmi Terenkripsi QRIS & Database
        </div>
      </div>
      <div class="modal-footer" style="border-top:1px solid #1E293B; background:transparent; display:flex; gap:10px;">
        <button type="button" class="btn-signup" onclick="printETicket()" style="flex:1; justify-content:center; padding:10px; font-size:13px;">
          <i data-lucide="download" style="width:15px;height:15px; margin-right:6px;"></i>
          Unduh E-Tiket (PDF/Cetak)
        </button>
        <button type="button" class="btn-login" onclick="closeETicketModal()" style="border-color:#475569; color:#94A3B8; padding:10px 18px;">
          Tutup
        </button>
      </div>
    </div>
  </div>

  <!-- ==================== POP UP MODAL: INVOICE RESMI PEMBELIAN TIKET ==================== -->
  <div id="invoiceModal" class="modal-overlay">
    <div class="modal-content" style="max-width: 600px; background:#ffffff; color:#0F172A; border:1px solid #E2E8F0;">
      <div class="modal-header" style="border-bottom:1px solid #E2E8F0; background:#F8FAFC;">
        <div style="display:flex; align-items:center; gap:8px;">
          <img src="{{ asset('logo-lightandrun.png') }}" alt="Logo" style="height:22px; width:auto; object-fit:contain;">
          <h3 style="margin:0; font-size:16px; font-weight:800; color:#0F172A;">Invoice Pemesanan Tiket Resmi</h3>
        </div>
        <button class="modal-close-btn" onclick="closeInvoiceModal()" style="color:#64748B;"><i data-lucide="x" style="width:20px;height:20px;"></i></button>
      </div>

      <div class="modal-body" id="printableInvoiceArea" style="padding:28px 24px; text-align:left;">
        <!-- Header Invoice dengan Logo Resmi Web -->
        <div class="print-doc-header" style="display:flex; justify-content:space-between; align-items:center; border-bottom:2px solid #0F172A; padding-bottom:16px; margin-bottom:20px;">
          <div class="print-brand-wrap" style="display:flex; align-items:center; gap:12px;">
            <img src="{{ asset('logo-lightandrun.png') }}" alt="Logo Light & Glow" class="print-brand-logo" style="height:50px; width:auto; object-fit:contain;">
            <div>
              <div class="print-brand-title" style="font-size:19px; font-weight:900; color:#070B19; letter-spacing:0.5px; line-height:1.1;">LIGHT & GLOW<span style="color:#00B4D8;">.</span></div>
              <div class="print-brand-sub" style="font-size:11.5px; color:#64748B; font-weight:600; margin-top:2px;">5K Night Run & Konser Musik 2026</div>
              <div style="font-size:11px; color:#94A3B8;">Jam Gadang, Bukittinggi · Sumatera Barat</div>
            </div>
          </div>
          <div style="text-align:right;">
            <span style="font-size:11px; font-weight:800; letter-spacing:1px; color:#0284C7; text-transform:uppercase; background:#E0F2FE; padding:3px 10px; border-radius:4px; display:inline-block; margin-bottom:4px;">INVOICE PEMBELIAN</span>
            <div id="invOrderNumber" style="font-family:monospace; font-size:16px; font-weight:800; color:#0F172A;">#LG-XXXXX</div>
            <div id="invCreatedAt" style="font-size:11px; color:#64748B;">-</div>
          </div>
        </div>

        <!-- Info Pembeli & Verifikasi Admin (Grid 2 Kolom) -->
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:20px;">
          <div class="invoice-info-box" style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:10px; padding:14px; font-size:12px; line-height:1.75;">
            <div style="font-size:11px; font-weight:800; text-transform:uppercase; color:#0284C7; margin-bottom:6px; letter-spacing:0.5px; display:flex; align-items:center; gap:5px;">
              <i data-lucide="user" style="width:13px;height:13px;"></i> Data Pemesan:
            </div>
            <div><strong>Nama:</strong> <span id="invBuyerName" style="color:#0F172A;">-</span></div>
            <div><strong>Email:</strong> <span id="invBuyerEmail" style="color:#0F172A;">-</span></div>
            <div><strong>No. HP/WA:</strong> <span id="invBuyerPhone" style="color:#0F172A;">-</span></div>
            <div><strong>NIK:</strong> <span id="invBuyerNik" style="color:#0F172A;">-</span></div>
            <div><strong>Alamat:</strong> <span id="invBuyerAddress" style="color:#0F172A;">-</span></div>
          </div>

          <div class="invoice-info-box" style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:10px; padding:14px; font-size:12px; line-height:1.75;">
            <div style="font-size:11px; font-weight:800; text-transform:uppercase; color:#0284C7; margin-bottom:6px; letter-spacing:0.5px; display:flex; align-items:center; gap:5px;">
              <i data-lucide="check-circle" style="width:13px;height:13px;"></i> Status & Verifikasi:
            </div>
            <div><strong>Metode Bayar:</strong> <span id="invPaymentMethod" style="color:#0F172A;">QRIS</span></div>
            <div><strong>Status Transaksi:</strong> <span id="invStatusBadge">-</span></div>
            <div style="margin-top:6px; border-top:1px dashed #CBD5E1; padding-top:6px;">
              <strong>Waktu Verifikasi Admin:</strong>
              <div id="invVerifiedAt" style="font-weight:700; color:#047857;">-</div>
            </div>
            <div><strong>Diverifikasi Oleh:</strong> <span id="invVerifiedBy" style="color:#0F172A;">Admin Panitia</span></div>
          </div>
        </div>

        <!-- Tabel Rincian Tiket -->
        <div class="invoice-table-wrap" style="border:1px solid #E2E8F0; border-radius:10px; overflow:hidden; margin-bottom:20px;">
          <table style="width:100%; border-collapse:collapse; font-size:12px;">
            <thead style="background:#F1F5F9; color:#475569; font-weight:700;">
              <tr>
                <th style="padding:10px 14px; text-align:left;">Item / Kategori Tiket</th>
                <th style="padding:10px 14px; text-align:center;">Harga Satuan</th>
                <th style="padding:10px 14px; text-align:center;">Qty</th>
                <th style="padding:10px 14px; text-align:right;">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <tr style="border-bottom:1px solid #E2E8F0;">
                <td style="padding:12px 14px;">
                  <strong id="invTicketName" style="color:#0F172A; font-size:13px; display:block;">-</strong>
                  <span id="invTicketEventDate" style="color:#64748B; font-size:11px;">Sabtu, 25 April 2026 · Jam Gadang Bukittinggi</span>
                </td>
                <td id="invTicketPrice" style="padding:12px 14px; text-align:center; color:#475569;">-</td>
                <td id="invTicketQty" style="padding:12px 14px; text-align:center; font-weight:700; color:#0F172A;">1</td>
                <td id="invTicketSubtotal" style="padding:12px 14px; text-align:right; font-weight:800; color:#0F172A;">-</td>
              </tr>
            </tbody>
            <tfoot style="background:#F8FAFC;">
              <tr>
                <td colspan="3" style="padding:12px 14px; text-align:right; font-weight:800; color:#0F172A; font-size:13px;">Total Pembayaran:</td>
                <td id="invTotalAmount" style="padding:12px 14px; text-align:right; font-weight:900; font-size:16px; color:#0284C7;">-</td>
              </tr>
            </tfoot>
          </table>
        </div>

        <!-- Notice / Catatan Resmi -->
        <div class="print-footer-notice" style="border:1px dashed #CBD5E1; background:#F8FAFC; border-radius:8px; padding:10px 14px; font-size:11px; color:#64748B; text-align:center; line-height:1.6;">
          🔒 Invoice ini adalah bukti sah pemesanan tiket resmi <strong>Light And Glow Bukittinggi 2026</strong>.<br>
          Tercatat resmi dalam database MySQL sistem panitia pelaksana. Simpan bukti ini untuk pengambilan race pack / verifikasi di venue.
        </div>
      </div>

      <div class="modal-footer" style="border-top:1px solid #E2E8F0; background:#F8FAFC; display:flex; gap:10px; justify-content:flex-end;">
        <button type="button" class="btn-login" onclick="closeInvoiceModal()" style="border-color:#CBD5E1; color:#475569; padding:9px 18px; font-size:12px;">
          Tutup
        </button>
        <button type="button" class="btn-signup" onclick="printInvoice()" style="padding:9px 18px; font-size:12px; display:inline-flex; align-items:center; gap:6px;">
          <i data-lucide="printer" style="width:14px;height:14px;"></i>
          Cetak Invoice (PDF)
        </button>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="goers-footer" style="padding:24px 0; border-top:1px solid #E2E8F0;">
    <div class="goers-container" style="text-align:center; font-size:12px; color:#94A3B8;">
      &copy; 2026 Light And Glow Bukittinggi · Platform Pemesanan Tiket Resmi
    </div>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      if (window.lucide) {
        lucide.createIcons();
      }
    });

    function switchBuyerTab(tab) {
      document.getElementById('tab-orders').classList.toggle('active', tab === 'orders');
      document.getElementById('tab-tickets').classList.toggle('active', tab === 'tickets');
      
      document.getElementById('content-orders').style.display = tab === 'orders' ? 'block' : 'none';
      document.getElementById('content-tickets').style.display = tab === 'tickets' ? 'block' : 'none';
      
      if (window.lucide) lucide.createIcons();
    }

    // Modal Bukti Pembayaran
    function showProofModal(url, orderNum) {
      document.getElementById('proofOrderNumText').textContent = '#' + orderNum;
      document.getElementById('proofModalImg').src = url;
      document.getElementById('proofModalDownloadLink').href = url;
      document.getElementById('proofModal').classList.add('active');
      if (window.lucide) lucide.createIcons();
    }

    function closeProofModal() {
      document.getElementById('proofModal').classList.remove('active');
    }

    // Modal E-Tiket
    function openETicketModal(title, orderNum, ticketCode, qrToken, name, status, usedAt, category, gate) {
      const isUsed = (status === 'Sudah digunakan');
      document.getElementById('modalETicketHolder').textContent = name;
      document.getElementById('modalETicketCategory').textContent = title + ' (' + (category || 'FESTIVAL') + ')';
      document.getElementById('modalETicketOrder').textContent = '#' + orderNum;
      document.getElementById('modalETicketGate').textContent = gate || 'Gate 1 (Utama Jam Gadang)';
      document.getElementById('modalETicketCode').textContent = ticketCode;
      
      const qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + encodeURIComponent(qrToken);
      document.getElementById('modalQRImage').src = qrUrl;

      const container = document.getElementById('modalQRContainer');
      const overlay = document.getElementById('modalQRExpiredOverlay');
      const statusBadge = document.getElementById('modalETicketStatusBadge');

      if (isUsed) {
        container.classList.add('is-expired');
        overlay.style.display = 'flex';
        statusBadge.innerHTML = '<span style="background:rgba(239,68,68,0.25); color:#F87171; font-size:11px; font-weight:800; padding:4px 12px; border-radius:20px; border:1px solid rgba(239,68,68,0.5);">✓ SUDAH CHECK-IN / EXPIRED</span>';
      } else {
        container.classList.remove('is-expired');
        overlay.style.display = 'none';
        statusBadge.innerHTML = '<span style="background:rgba(16,185,129,0.25); color:#34D399; font-size:11px; font-weight:800; padding:4px 12px; border-radius:20px; border:1px solid rgba(16,185,129,0.5);">✓ TIKET AKTIF (HANYA BISA 1x SCAN)</span>';
      }

      document.getElementById('eTicketModal').classList.add('active');
      if (window.lucide) lucide.createIcons();
    }

    function closeETicketModal() {
      document.getElementById('eTicketModal').classList.remove('active');
    }

    // Direct Download & Print E-Tiket
    function directDownloadTicket(code, name, ticketName, qrToken, status) {
      openETicketModal(ticketName, '', code, qrToken, name, status, '', 'FESTIVAL', 'Gate 1 (Utama Jam Gadang)');
      setTimeout(() => {
        printETicket();
      }, 300);
    }

    function printETicket() {
      document.body.classList.remove('printing-invoice');
      document.body.classList.add('printing-ticket');
      window.print();
      document.body.classList.remove('printing-ticket');
    }

    // Modal Invoice
    function openInvoiceModal(order) {
      document.getElementById('invOrderNumber').textContent = '#' + (order.order_number || '');
      
      // Tanggal Pemesanan
      let createdDate = '-';
      if (order.created_at) {
        const d = new Date(order.created_at.replace(/-/g, '/'));
        createdDate = !isNaN(d) ? d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' }) + ' WIB' : order.created_at;
      }
      document.getElementById('invCreatedAt').textContent = createdDate;

      // Data Pembeli
      document.getElementById('invBuyerName').textContent = order.buyer_name || '-';
      document.getElementById('invBuyerEmail').textContent = order.buyer_email || '-';
      document.getElementById('invBuyerPhone').textContent = order.buyer_phone || '-';
      document.getElementById('invBuyerNik').textContent = order.buyer_nik || '-';
      document.getElementById('invBuyerAddress').textContent = order.buyer_address || '-';

      // Status & Verifikasi
      document.getElementById('invPaymentMethod').textContent = order.payment_method || 'QRIS';
      
      const statusBadge = document.getElementById('invStatusBadge');
      if (order.status === 'Pembayaran disetujui') {
        statusBadge.innerHTML = '<span style="background:#DCFCE7; color:#15803D; font-weight:800; font-size:11px; padding:2px 8px; border-radius:4px; display:inline-block;">✓ LUNAS / DISETUJUI</span>';
      } else if (order.status === 'Menunggu verifikasi') {
        statusBadge.innerHTML = '<span style="background:#FEF3C7; color:#B45309; font-weight:800; font-size:11px; padding:2px 8px; border-radius:4px; display:inline-block;">MENUNGGU VERIFIKASI</span>';
      } else {
        statusBadge.innerHTML = '<span style="background:#FEE2E2; color:#B91C1C; font-weight:800; font-size:11px; padding:2px 8px; border-radius:4px; display:inline-block;">' + (order.status || 'DITOLAK') + '</span>';
      }

      // Waktu Verifikasi Admin
      let verifiedDate = 'Menunggu verifikasi panitia';
      if (order.verified_at) {
        const vd = new Date(order.verified_at.replace(/-/g, '/'));
        verifiedDate = !isNaN(vd) ? vd.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' }) + ' WIB' : order.verified_at;
      } else if (order.status === 'Pembayaran disetujui') {
        verifiedDate = createdDate + ' (Otomatis/Admin)';
      }
      document.getElementById('invVerifiedAt').textContent = verifiedDate;
      document.getElementById('invVerifiedBy').textContent = order.verified_by_name ? ('Admin (' + order.verified_by_name + ')') : 'Panitia Light and Glow';

      // Rincian Item Tiket
      const qty = parseInt(order.quantity) || 1;
      const totalAmount = parseFloat(order.total_amount) || 0;
      const unitPrice = parseFloat(order.ticket_price) || (totalAmount / qty);

      document.getElementById('invTicketName').textContent = order.ticket_name + ' (' + (order.ticket_category || 'Reguler') + ')';
      document.getElementById('invTicketPrice').textContent = 'Rp ' + Number(unitPrice).toLocaleString('id-ID');
      document.getElementById('invTicketQty').textContent = qty;
      document.getElementById('invTicketSubtotal').textContent = 'Rp ' + Number(totalAmount).toLocaleString('id-ID');
      document.getElementById('invTotalAmount').textContent = 'Rp ' + Number(totalAmount).toLocaleString('id-ID');

      document.getElementById('invoiceModal').classList.add('active');
      if (window.lucide) lucide.createIcons();
    }

    function closeInvoiceModal() {
      document.getElementById('invoiceModal').classList.remove('active');
    }

    function printInvoice() {
      document.body.classList.remove('printing-ticket');
      document.body.classList.add('printing-invoice');
      window.print();
      document.body.classList.remove('printing-invoice');
    }

    function checkStatusPending(orderId) {
      const modal = document.createElement('div');
      modal.className = 'modal-overlay active';
      modal.innerHTML = `
        <div class="modal-content" style="max-width: 440px; text-align:center; padding:28px 24px;">
          <div style="width:54px; height:54px; border-radius:50%; background:#FEF3C7; color:#B45309; display:flex; align-items:center; justify-content:center; margin:0 auto 14px;">
            <i data-lucide="clock" style="width:28px;height:28px;"></i>
          </div>
          <h3 style="font-size:17px; font-weight:800; color:var(--goers-navy-900); margin-bottom:8px;">Pembayaran Sedang Diverifikasi</h3>
          <p style="font-size:13px; color:var(--goers-gray-700); line-height:1.6; margin-bottom:20px;">
            Pesanan <strong>#${orderId}</strong> sedang dicocokkan dengan mutasi bank / QRIS oleh panitia pelaksana. Begitu disetujui, QR Code tiket digital resmi Anda akan otomatis terbit di tab <strong>Tiket Digital</strong>.
          </p>
          <button class="btn-signup" style="width:100%; justify-content:center; padding:10px;" onclick="this.closest('.modal-overlay').remove()">
            Oke, Mengerti
          </button>
        </div>
      `;
      document.body.appendChild(modal);
      if (window.lucide) lucide.createIcons();
    }

    // Close modal on click backdrop or escape
    document.addEventListener('click', (e) => {
      if (e.target.classList.contains('modal-overlay')) {
        e.target.classList.remove('active');
      }
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        closeProofModal();
        closeETicketModal();
        closeInvoiceModal();
      }
    });
  </script>
</body>
</html>
