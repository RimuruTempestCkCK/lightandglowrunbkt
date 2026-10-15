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
      background: linear-gradient(135deg, #EB1355, #FF5B84);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 20px;
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
      color: var(--goers-branding-500);
      border-bottom-color: var(--goers-branding-500);
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
          <span id="cmsBrandLogoText">GOERS</span><span class="dot">.</span>
        </a>

        <div style="font-size:14px; font-weight:700; color:var(--goers-navy-900); display:flex; align-items:center; gap:8px;">
          <i data-lucide="ticket" style="width:18px;height:18px; color:var(--goers-branding-500);"></i>
          Dashboard Tiket & Transaksi Saya
        </div>

        <div class="goers-nav-actions">
          <a href="{{ route('home') }}#konser-section" class="btn-signup" style="padding:8px 16px; font-size:13px;">
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
                  Menunggu Verifikasi Admin
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
                  @if($ord->proof_of_payment)
                    · Bukti: <a href="{{ asset('storage/' . $ord->proof_of_payment) }}" target="_blank" style="color:#10B981; font-weight:700; text-decoration:underline;">Lihat Bukti</a>
                  @endif
                </div>
              </div>
              <div style="text-align:right; display:flex; flex-direction:column; justify-content:space-between;">
                <div>
                  <span style="font-size:11px; color:#64748B;">Total Tagihan:</span>
                  <div style="font-size:18px; font-weight:800; color:var(--goers-branding-500);">Rp {{ number_format($ord->total_price, 0, ',', '.') }}</div>
                </div>
                <div>
                  @if($ord->status === 'Pembayaran disetujui')
                    @php
                      $ticketForOrder = $digitalTickets->firstWhere('order_id', $ord->id);
                    @endphp
                    @if($ticketForOrder)
                      <button class="btn-signup" style="padding:8px 16px; font-size:12px;" onclick="showMyTicket('{{ $ord->ticket_name }}', '{{ $ord->order_number }}', '{{ $ticketForOrder->qr_token }}', '{{ $ticketForOrder->attendee_name }}', '25 Apr 2026')">
                        <i data-lucide="qr-code" style="width:14px;height:14px; vertical-align:middle; margin-right:4px;"></i>
                        Lihat E-Tiket
                      </button>
                    @endif
                  @elseif($ord->status === 'Menunggu verifikasi')
                    <button class="btn-login" style="padding:8px 16px; font-size:12px;" onclick="checkStatusPending('{{ $ord->order_number }}')">
                      Cek Status
                    </button>
                  @else
                    <span style="font-size:12px; color:#EF4444; font-weight:600;">{{ $ord->reject_reason ?? 'Pesanan ditolak' }}</span>
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
            <p style="font-size:13px; color:var(--goers-gray-700); margin:0;">Tunjukkan QR Code berikut di layar ponsel Anda kepada petugas scanner saat masuk ke area Jam Gadang.</p>
          </div>

          <div style="display:flex; flex-wrap:wrap; gap:24px; justify-content:center;">
            @forelse($digitalTickets as $dt)
              <div style="max-width:400px; width:100%; background:#0F172A; border-radius:18px; overflow:hidden; color:#fff; box-shadow:0 12px 30px rgba(0,0,0,0.15); margin-bottom:16px;">
                <div style="background:linear-gradient(135deg, #EB1355, #881337); padding:20px; text-align:center;">
                  <span style="font-size:11px; letter-spacing:2px; text-transform:uppercase; opacity:0.8;">OFFICIAL E-TICKET</span>
                  <h3 style="font-size:18px; font-weight:800; margin:4px 0;">Light And Glow Bukittinggi 2026</h3>
                  <p style="font-size:12px; margin:0; opacity:0.9;">25 April 2026 · Jam Gadang, Bukittinggi</p>
                </div>

                <div style="padding:24px; text-align:center;">
                  <div style="background:#fff; border-radius:14px; padding:16px; display:inline-block; margin-bottom:14px;">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ urlencode($dt->qr_token) }}" alt="QR Code" style="width:170px; height:170px;">
                  </div>
                  <div style="font-family:monospace; font-size:14px; font-weight:700; color:#38BDF8; letter-spacing:1px; margin-bottom:8px;">{{ $dt->ticket_code }}</div>
                  @if($dt->is_used)
                    <span style="background:rgba(239,68,68,0.2); color:#F87171; font-size:11px; font-weight:700; padding:4px 10px; border-radius:20px;">✓ SUDAH CHECK-IN ({{ \Carbon\Carbon::parse($dt->used_at)->format('H:i') }} WIB)</span>
                  @else
                    <span style="background:rgba(16,185,129,0.2); color:#34D399; font-size:11px; font-weight:700; padding:4px 10px; border-radius:20px;">✓ TIKET AKTIF & SIAP DIPAKAI</span>
                  @endif

                  <div style="border-top:1px dashed #334155; margin-top:20px; padding-top:16px; text-align:left; font-size:12px; color:#94A3B8; line-height:1.7;">
                    <div><strong>Nama Pemegang:</strong> <span style="color:#fff;">{{ $dt->attendee_name }}</span></div>
                    <div><strong>Kategori:</strong> <span style="color:#fff;">{{ $dt->ticket_name }}</span></div>
                    <div><strong>No. Pesanan:</strong> <span style="color:#fff;">{{ $dt->order_number }}</span></div>
                    <div><strong>Gate Masuk:</strong> <span style="color:#fff;">{{ $dt->gate ?? 'Gate 1 (Akses Utama)' }}</span></div>
                  </div>

                  <div style="margin-top:20px;">
                    <button class="btn-signup" style="width:100%; justify-content:center; padding:10px;" onclick="downloadTicketPDF('{{ $dt->ticket_code }}')">
                      <i data-lucide="download" style="width:16px;height:16px; margin-right:6px;"></i>
                      Unduh E-Tiket (PNG/PDF)
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

    function showMyTicket(title, orderId, token, name, date) {
      Swal.fire({
        title: 'E-Tiket Digital',
        html: `
          <div style="text-align:center; padding:10px;">
            <div style="background:#0F172A; color:#fff; padding:14px; border-radius:10px; margin-bottom:12px; text-align:left;">
              <div style="font-size:11px; color:#94A3B8; text-transform:uppercase;">Light And Glow Bukittinggi</div>
              <div style="font-size:16px; font-weight:800; color:#fff; margin-top:2px;">${name}</div>
              <div style="font-size:12px; color:#38BDF8;">${title} · ${orderId}</div>
            </div>
            <div style="background:#fff; border:2px dashed #CBD5E1; padding:12px; border-radius:10px; display:inline-block; margin-bottom:10px;">
              <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=${token}" alt="QR" style="width:150px; height:150px;">
            </div>
            <div style="font-size:13px; font-family:monospace; font-weight:700; color:#0F172A;">${token}</div>
            <p style="font-size:12px; color:#64748B; margin-top:6px;">Tunjukkan QR Code ini kepada petugas di gate untuk di-scan.</p>
          </div>
        `,
        confirmButtonColor: '#EB1355',
        confirmButtonText: 'Tutup'
      });
    }

    function checkStatusPending(orderId) {
      Swal.fire({
        icon: 'info',
        title: 'Sedang Diverifikasi',
        html: `Pesanan <b>${orderId}</b> telah masuk ke antrean verifikasi admin.<br><small style="color:gray;">Admin sedang mencocokkan mutasi bukti transfer Anda. Tiket digital & QR Code akan otomatis terbit begitu disetujui.</small>`,
        confirmButtonColor: '#EB1355',
        confirmButtonText: 'Oke, Mengerti'
      });
    }

    function downloadTicketPDF() {
      Swal.fire({
        icon: 'success',
        title: 'Mengunduh E-Tiket...',
        text: 'File tiket digital (PDF) sedang diunduh ke perangkat Anda.',
        timer: 1500,
        showConfirmButton: false
      });
    }
  </script>
</body>
</html>
