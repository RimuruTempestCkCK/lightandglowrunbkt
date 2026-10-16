<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Inter+Tight:wght@500;600;700&amp;family=JetBrains+Mono:wght@400;500&amp;display=swap">
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
  <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
  <title>Dashboard Admin · Light And Glow Bukittinggi</title>
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
</head>
<body data-active="dashboard" data-crumbs="Workspace | Dashboard Admin">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">

        <!-- Hero Section Asli Adminator 4.4.0 -->
        <section class="hero">
          <div class="hero-text">
            <span class="eyebrow" id="heroDate">Light and Glow Run Bukittinggi 2026</span>
            <h1 class="hero-title">Selamat Datang, <span class="accent">Admin Light & Glow</span></h1>
            <p class="hero-sub">Ringkasan transaksi penjualan tiket, status antrean verifikasi pembayaran, dan log gate masuk real-time dari database.</p>
          </div>
          <div class="hero-actions">
            @if($pendingCount > 0)
              <a href="{{ route('admin.verifikasi') }}" class="btn btn--primary">
                <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                Verifikasi Pesanan ({{ $pendingCount }})
              </a>
            @else
              <a href="{{ route('admin.verifikasi') }}" class="btn btn--ghost">
                <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                Verifikasi Bayar
              </a>
            @endif
            <a href="{{ route('admin.tiket') }}" class="btn btn--ghost">
              <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 10h18M3 16h18M9 4v16"/></svg>
              Kelola Tiket
            </a>
          </div>
        </section>

        <!-- KPI Grid 100% Asli Template Adminator 4.4.0 -->
        <section class="kpi-grid" aria-label="Key metrics">
          <!-- Card 1: Total Transaksi -->
          <article class="kpi-card c-primary">
            <div class="kpi-top">
              <div class="kpi-identity">
                <div class="kpi-icon primary">
                  <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                </div>
                <div class="kpi-label">Total Pesanan</div>
              </div>
              <span class="kpi-pill up"><svg viewBox="0 0 24 24"><path d="M7 17l10-10M7 7h10v10"/></svg> {{ $totalOrdersCount }} TX</span>
            </div>
            <div class="kpi-value">{{ $totalOrdersCount }}</div>
            <div class="kpi-compare">
              <svg class="up" viewBox="0 0 24 24"><path d="M7 17l10-10M7 7h10v10"/></svg>
              <strong>{{ $approvedCount }} disetujui</strong> <span class="sep">·</span> {{ $rejectedCount }} ditolak
            </div>
          </article>

          <!-- Card 2: Total Pendapatan -->
          <article class="kpi-card c-success">
            <div class="kpi-top">
              <div class="kpi-identity">
                <div class="kpi-icon success">
                  <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <div class="kpi-label">Total Pendapatan</div>
              </div>
              <span class="kpi-pill up"><svg viewBox="0 0 24 24"><path d="M7 17l10-10M7 7h10v10"/></svg> Lunas</span>
            </div>
            <div class="kpi-value" style="font-size: 32px;">
              Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </div>
            <div class="kpi-compare">
              <svg class="up" viewBox="0 0 24 24"><path d="M7 17l10-10M7 7h10v10"/></svg>
              Dana masuk <span class="sep">·</span> <strong>Terverifikasi</strong>
            </div>
          </article>

          <!-- Card 3: Tiket Terbit & Aktif -->
          <article class="kpi-card c-purple">
            <div class="kpi-top">
              <div class="kpi-identity">
                <div class="kpi-icon purple">
                  <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 10h18M3 16h18M9 4v16"/></svg>
                </div>
                <div class="kpi-label">Tiket Terbit (Aktif)</div>
              </div>
              <span class="kpi-pill flat"><svg viewBox="0 0 24 24"><path d="M5 12h14"/></svg> {{ $checkInCount }} scan</span>
            </div>
            <div class="kpi-value">{{ $activeTicketsCount }}</div>
            <div class="kpi-compare">
              <svg class="flat" viewBox="0 0 24 24"><path d="M5 12h14"/></svg>
              Check-in venue: <strong>{{ $checkInCount }} peserta</strong>
            </div>
          </article>

          <!-- Card 4: Antrean Verifikasi -->
          <article class="kpi-card c-danger">
            <div class="kpi-top">
              <div class="kpi-identity">
                <div class="kpi-icon danger">
                  <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div class="kpi-label">Menunggu Verifikasi</div>
              </div>
              <span class="kpi-pill down"><svg viewBox="0 0 24 24"><path d="M7 7l10 10M7 17h10V7"/></svg> Antrean</span>
            </div>
            <div class="kpi-value">{{ $pendingCount }}</div>
            <div class="kpi-compare">
              <svg class="down" viewBox="0 0 24 24"><path d="M7 7l10 10M7 17h10V7"/></svg>
              Status: <strong>{{ $pendingCount > 0 ? 'Perlu tindakan' : 'Tuntas' }}</strong>
            </div>
          </article>
        </section>

        <!-- Grid 2 Bagian Asli Adminator (col-6 & col-6) -->
        <div class="grid">
          <!-- Bagian Kiri: Daftar Pesanan Tiket Terbaru (Tabel Asli Adminator) -->
          <section class="col-6 card">
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

            <div class="table-scroll">
              <table class="table">
                <thead>
                  <tr>
                    <th>No. Pesanan</th>
                    <th>Pembeli</th>
                    <th>Kategori Tiket</th>
                    <th style="text-align:center">Qty</th>
                    <th style="text-align:right">Total Bayar</th>
                    <th style="text-align:right">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($recentOrders as $index => $order)
                    @php
                      $avatarGradients = ['ma-1', 'ma-2', 'ma-3', 'ma-4', 'ma-5', 'ma-6'];
                      $grad = $avatarGradients[$index % count($avatarGradients)];
                    @endphp
                    <tr>
                      <td class="cell-name">
                        <span class="data-cell-mono" style="font-weight:600; color:var(--primary);">{{ $order->order_number }}</span>
                      </td>
                      <td>
                        <div class="data-cell-user">
                          <div class="av {{ $grad }}">{{ strtoupper(substr($order->buyer_name ?? 'U', 0, 1)) }}</div>
                          <div class="data-cell-user-meta">
                            <div class="data-cell-user-name">{{ $order->buyer_name }}</div>
                            <div class="data-cell-user-email">{{ $order->buyer_email }}</div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <span class="tag t-new">{{ $order->ticket_name }}</span>
                      </td>
                      <td style="text-align:center; font-weight:600;">{{ $order->quantity }}</td>
                      <td class="cell-price pos">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                      </td>
                      <td style="text-align:right">
                        @if($order->status === 'Pembayaran disetujui')
                          <span class="badge success dot">Disetujui</span>
                        @elseif($order->status === 'Menunggu verifikasi')
                          <span class="badge warning dot">Menunggu</span>
                        @else
                          <span class="badge danger dot">Ditolak</span>
                        @endif
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" style="text-align:center; padding:24px; color:var(--t-muted)">
                        Belum ada data pesanan yang masuk.
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            <div style="display:flex; justify-content:space-between; align-items:center; padding-top:18px; margin-top:auto; border-top:1px solid var(--border-soft); font-size:12px; color:var(--t-muted)">
              <span>Menampilkan <strong style="color:var(--t-base)">{{ count($recentOrders) }} dari {{ $totalOrdersCount }}</strong> pesanan</span>
              <a class="card-action" href="{{ route('admin.pesanan') }}">
                Kelola Pesanan <svg viewBox="0 0 24 24"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
              </a>
            </div>
          </section>

          <!-- Bagian Kanan: Alokasi Kuota Tiket & Gate Venue (Komponen Asli Adminator) -->
          <section class="col-6 card">
            <div class="card-head">
              <div class="card-title-wrap">
                <span class="eyebrow">Alokasi & Gate</span>
                <h2 class="card-title">Ketersediaan Kuota Tiket</h2>
              </div>
              <a class="card-action" href="{{ route('admin.tiket') }}">
                Kelola Tiket <svg viewBox="0 0 24 24"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
              </a>
            </div>

            <!-- List Alokasi Tiket dengan Struktur Asli Adminator sv-region -->
            <div style="display:flex; flex-direction:column; gap:20px;">
              @php
                $colorThemes = [
                  ['color' => 'var(--purple)', 'tag' => 't-new'],
                  ['color' => 'var(--primary)', 'tag' => 't-info'],
                  ['color' => 'var(--success)', 'tag' => 't-active'],
                  ['color' => 'var(--orange)', 'tag' => 't-used'],
                  ['color' => 'var(--danger)', 'tag' => 't-unavail']
                ];
              @endphp

              @foreach($ticketTypes as $index => $ticket)
                @php
                  $totalQ = $ticket->quota ?? $ticket->total_quota ?? 0;
                  $sold = max(0, $totalQ - $ticket->remaining_quota);
                  $percentage = $totalQ > 0 ? round(($sold / $totalQ) * 100) : 0;
                  $theme = $colorThemes[$index % count($colorThemes)];
                @endphp
                <div class="sv-region">
                  <div class="sv-region-head" style="justify-content:space-between;">
                    <div style="display:flex; align-items:center; gap:8px;">
                      <span class="marker" style="background:{{ $theme['color'] }}"></span>
                      <strong style="color:var(--t-base)">{{ $ticket->name }}</strong>
                      <span class="tag {{ $theme['tag'] }}">{{ $ticket->category }}</span>
                    </div>
                    <span style="font-weight:600; color:var(--t-base)">Rp {{ number_format($ticket->price, 0, ',', '.') }}</span>
                  </div>
                  <div class="sv-region-value">
                    {{ $sold }} <span style="font-size:14px; font-weight:500; color:var(--t-muted)">/ {{ $totalQ }} terjual</span>
                    <span class="pct">{{ $percentage }}%</span>
                  </div>
                  <div class="sv-region-bar" style="height:6px;">
                    <div class="sv-region-bar-fill" style="width:{{ min(100, $percentage) }}%; background:{{ $theme['color'] }}"></div>
                  </div>
                  <div style="display:flex; justify-content:space-between; font-size:11.5px; color:var(--t-muted)">
                    <span>Sisa kuota: <strong style="color:var(--t-base)">{{ $ticket->remaining_quota }} tiket</strong></span>
                    <span>Status: <strong style="color:{{ $ticket->remaining_quota > 0 ? 'var(--success)' : 'var(--danger)' }}">{{ $ticket->remaining_quota > 0 ? 'Tersedia' : 'Habis' }}</strong></span>
                  </div>
                </div>
              @endforeach
            </div>

            <!-- Footer Ringkasan Gate Sesuai Class Asli monthly-footer Adminator -->
            <div class="monthly-footer" style="margin-top:auto; padding-top:20px;">
              <div class="stat-cell">
                <div class="stat-cell-label">Check-in Venue</div>
                <div class="stat-cell-value" style="color:var(--success)">
                  {{ $checkInCount }} <svg class="trend-ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 17l10-10M7 7h10v10"/></svg>
                </div>
              </div>
              <div class="stat-cell">
                <div class="stat-cell-label">Pesanan Ditolak</div>
                <div class="stat-cell-value" style="color:var(--danger)">
                  {{ $rejectedCount }}
                </div>
              </div>
              <div class="stat-cell">
                <div class="stat-cell-label">Total Tiket Aktif</div>
                <div class="stat-cell-value" style="color:var(--purple)">
                  {{ $activeTicketsCount }}
                </div>
              </div>
              <div class="stat-cell">
                <div class="stat-cell-label">Status Scanner</div>
                <div class="stat-cell-value" style="color:var(--info); font-size:15px;">
                  ONLINE
                </div>
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