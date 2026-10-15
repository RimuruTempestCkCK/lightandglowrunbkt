<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Inter+Tight:wght@500;600;700&family=JetBrains+Mono:wght@400;500&display=swap">
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
  <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
  <title>Dashboard Admin | Light And Glow Bukittinggi</title>
  <script>
    !function(){
      try{
        var t=localStorage.getItem("dash26-theme"),e=window.matchMedia("(prefers-color-scheme: dark)").matches;
        document.documentElement.setAttribute("data-theme",t||(e?"dark":"light"))
      }catch(t){
        document.documentElement.setAttribute("data-theme","light")
      }
    }()
  </script>
  <script defer="defer" src="{{ asset('adminator/runtime.096d507f.js') }}"></script>
  <script defer="defer" src="{{ asset('adminator/2026.5a84696f.js') }}"></script>
  <link href="{{ asset('adminator/style.76ee5eee.css') }}" rel="stylesheet">
  <style>
    .kpi-grid-3 {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 1.25rem;
      margin-bottom: 24px;
    }
    @media (max-width: 992px) {
      .kpi-grid-3 {
        grid-template-columns: 1fr;
      }
    }
    .badge-status {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 4px 10px;
      border-radius: 9999px;
      font-size: 0.75rem;
      font-weight: 600;
    }
    .badge-status.warning {
      background: rgba(245, 158, 11, 0.15);
      color: #d97706;
    }
    .badge-status.success {
      background: rgba(16, 185, 129, 0.15);
      color: #059669;
    }
    .badge-status.danger {
      background: rgba(239, 68, 68, 0.15);
      color: #dc2626;
    }
    .progress-bar-container {
      width: 100%;
      height: 8px;
      background: var(--bg-hover, #f1f5f9);
      border-radius: 999px;
      overflow: hidden;
      margin-top: 8px;
    }
    .progress-bar-fill {
      height: 100%;
      background: linear-gradient(90deg, #ec4899, #8b5cf6);
      border-radius: 999px;
    }
  </style>
</head>
<body data-active="dashboard" data-crumbs="Workspace | Dashboard">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        <!-- Hero Section -->
        <section class="hero">
          <div class="hero-text">
            <span class="eyebrow" id="heroDate">Light and Glow Run Bukittinggi 2026</span>
            <h1 class="hero-title">Selamat Datang, <span class="accent">Admin Light & Glow</span></h1>
            <p class="hero-sub">Ringkasan transaksi dan pantauan data penjualan tiket secara real-time dari database.</p>
          </div>
          <div class="hero-actions">
            <a href="{{ route('admin.verifikasi') }}" class="btn btn--primary">
              <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
              Verifikasi Pesanan ({{ $pendingCount }})
            </a>
            <a href="{{ route('admin.tiket') }}" class="btn btn--ghost">
              <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 10h18M3 16h18M9 4v16"/></svg>
              Kelola Tiket
            </a>
          </div>
        </section>

        <!-- KPI Grid: HANYA 3 KARTU PERSIS SESUAI PERMINTAAN USER -->
        <section class="kpi-grid-3" aria-label="Key metrics">
          <!-- Card 1: Total Pesanan -->
          <article class="kpi-card c-primary">
            <div class="kpi-top">
              <div class="kpi-identity">
                <div class="kpi-icon primary">
                  <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                </div>
                <div class="kpi-label">Total Pesanan</div>
              </div>
              <span class="kpi-pill up">+24%</span>
            </div>
            <div class="kpi-value">{{ $totalOrdersCount }}</div>
            <div class="kpi-compare">
              <svg class="up" viewBox="0 0 24 24"><path d="M7 17l10-10M7 7h10v10"/></svg>
              Seluruh transaksi terdata
            </div>
          </article>

          <!-- Card 2: Tiket Terbit (Aktif) -->
          <article class="kpi-card c-success">
            <div class="kpi-top">
              <div class="kpi-identity">
                <div class="kpi-icon success">
                  <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div class="kpi-label">Tiket Terbit (Aktif)</div>
              </div>
              <span class="kpi-pill up">{{ $activeTicketsCount }} Tiket</span>
            </div>
            <div class="kpi-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            <div class="kpi-compare">
              <svg class="up" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
              Total dana telah masuk
            </div>
          </article>

          <!-- Card 3: Menunggu Verifikasi -->
          <article class="kpi-card c-danger">
            <div class="kpi-top">
              <div class="kpi-identity">
                <div class="kpi-icon danger">
                  <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div class="kpi-label">Menunggu Verifikasi</div>
              </div>
              <span class="kpi-pill down">{{ $pendingCount }} Antrean</span>
            </div>
            <div class="kpi-value">{{ $pendingCount }}</div>
            <div class="kpi-compare">
              <svg class="down" viewBox="0 0 24 24"><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
              Perlu tindakan di menu Verifikasi
            </div>
          </article>
        </section>

        <!-- Konten Database Nyata: Data Transaksi Terkini & Kuota Tiket -->
        <div class="grid">
          <!-- Tabel Transaksi Terbaru (Database Nyata) -->
          <section class="col-8 card">
            <div class="card-head">
              <div class="card-title-wrap">
                <span class="eyebrow">Database Transaksi</span>
                <h2 class="card-title">Daftar Pesanan Tiket Terbaru</h2>
              </div>
              <a class="card-action" href="{{ route('admin.pesanan') }}">
                Lihat Semua ({{ $totalOrdersCount }})
                <svg viewBox="0 0 24 24"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
              </a>
            </div>

            <div style="overflow-x: auto;">
              <table class="table">
                <thead>
                  <tr>
                    <th>No. Pesanan</th>
                    <th>Pembeli</th>
                    <th>Kategori Tiket</th>
                    <th>Jumlah</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($recentOrders as $order)
                    <tr>
                      <td class="cell-name">
                        <span style="font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; font-weight: 600; color: var(--accent, #ec4899);">
                          {{ $order->order_number }}
                        </span>
                      </td>
                      <td>
                        <div style="font-weight: 500;">{{ $order->buyer_name }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted, #94a3b8);">{{ $order->buyer_email }}</div>
                      </td>
                      <td><span class="tag t-new">{{ $order->ticket_name }}</span></td>
                      <td style="text-align: center; font-weight: 600;">{{ $order->quantity }}</td>
                      <td class="cell-price pos" style="font-family: 'JetBrains Mono', monospace;">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                      </td>
                      <td>
                        @if($order->status === 'Pembayaran disetujui')
                          <span class="badge-status success">Disetujui</span>
                        @elseif($order->status === 'Menunggu verifikasi')
                          <span class="badge-status warning">Menunggu</span>
                        @else
                          <span class="badge-status danger">{{ $order->status }}</span>
                        @endif
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" style="text-align: center; padding: 2rem; color: var(--text-muted, #94a3b8);">
                        Belum ada data pesanan yang masuk.
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </section>

          <!-- Status Kuota Tiket & Gateway Masuk (Database Nyata) -->
          <section class="col-4 card">
            <div class="card-head">
              <div class="card-title-wrap">
                <span class="eyebrow">Alokasi & Gate</span>
                <h2 class="card-title">Ketersediaan Kuota Tiket</h2>
              </div>
              <a class="card-action" href="{{ route('admin.tiket') }}">Kelola</a>
            </div>

            <div style="padding: 0.5rem 0 1.25rem 0;">
              @foreach($ticketTypes as $ticket)
                @php
                  $sold = max(0, $ticket->total_quota - $ticket->remaining_quota);
                  $percentage = $ticket->total_quota > 0 ? round(($sold / $ticket->total_quota) * 100) : 0;
                @endphp
                <div style="margin-bottom: 1.25rem;">
                  <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 4px;">
                    <div>
                      <strong style="font-size: 0.9rem;">{{ $ticket->name }}</strong>
                      <span style="font-size: 0.75rem; color: var(--text-muted, #94a3b8); margin-left: 6px;">{{ $ticket->category }}</span>
                    </div>
                    <div style="font-size: 0.8rem; font-weight: 600;">
                      {{ $sold }} / {{ $ticket->total_quota }}
                    </div>
                  </div>
                  <div class="progress-bar-container">
                    <div class="progress-bar-fill" style="width: {{ min(100, $percentage) }}%;"></div>
                  </div>
                  <div style="display: flex; justify-content: space-between; font-size: 0.72rem; color: var(--text-muted, #94a3b8); margin-top: 4px;">
                    <span>Sisa kuota: <strong>{{ $ticket->remaining_quota }}</strong></span>
                    <span>Rp {{ number_format($ticket->price, 0, ',', '.') }}</span>
                  </div>
                </div>
              @endforeach
            </div>

            <div style="border-top: 1px solid var(--border-color, #e2e8f0); padding-top: 1rem; margin-top: auto;">
              <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
                <span style="font-size: 0.8rem; color: var(--text-muted, #94a3b8);">Total Check-in Venue:</span>
                <span style="font-weight: 700; color: #10b981; font-size: 1rem;">{{ $checkInCount }} Peserta</span>
              </div>
              <div style="display: flex; align-items: center; justify-content: space-between;">
                <span style="font-size: 0.8rem; color: var(--text-muted, #94a3b8);">Pesanan Ditolak:</span>
                <span style="font-weight: 600; color: #ef4444; font-size: 0.9rem;">{{ $rejectedCount }} Transaksi</span>
              </div>
            </div>
          </section>
        </div>
      </main>
      <div data-shell-footer></div>
    </div>
  </div>
</body>
</html>