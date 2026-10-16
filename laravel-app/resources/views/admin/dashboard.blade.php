<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Inter+Tight:wght@500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap">
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
    .kpi-stat-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 1.25rem;
      margin-bottom: 24px;
    }
    @media (max-width: 1200px) {
      .kpi-stat-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
    }
    @media (max-width: 640px) {
      .kpi-stat-grid {
        grid-template-columns: 1fr;
      }
    }
    .kpi-card-clean {
      background: var(--bg-card, #ffffff);
      border: 1px solid var(--border-soft, #e2e8f0);
      border-radius: 12px;
      padding: 20px;
      position: relative;
      overflow: hidden;
      box-shadow: 0 1px 3px rgba(0,0,0,0.02);
      transition: all 0.2s ease;
    }
    .kpi-card-clean:hover {
      border-color: var(--border, #cbd5e1);
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      transform: translateY(-2px);
    }
    .kpi-card-clean .kpi-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 12px;
    }
    .kpi-card-clean .kpi-icon-wrap {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .kpi-card-clean .kpi-icon-wrap svg {
      width: 20px;
      height: 20px;
      stroke-width: 2;
    }
    .kpi-icon-blue { background: rgba(59, 130, 246, 0.12); color: #3b82f6; }
    .kpi-icon-green { background: rgba(16, 185, 129, 0.12); color: #10b981; }
    .kpi-icon-purple { background: rgba(139, 92, 246, 0.12); color: #8b5cf6; }
    .kpi-icon-amber { background: rgba(245, 158, 11, 0.12); color: #f59e0b; }
    .kpi-card-clean .kpi-title {
      font-size: 0.85rem;
      font-weight: 500;
      color: var(--t-muted, #64748b);
    }
    .kpi-card-clean .kpi-number {
      font-size: 1.65rem;
      font-weight: 700;
      color: var(--t-base, #0f172a);
      line-height: 1.2;
      margin-bottom: 6px;
      font-family: 'Inter Tight', sans-serif;
    }
    .kpi-card-clean .kpi-desc {
      font-size: 0.75rem;
      color: var(--t-muted, #94a3b8);
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .badge-status {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 4px 10px;
      border-radius: 9999px;
      font-size: 0.72rem;
      font-weight: 600;
    }
    .badge-status::before {
      content: '';
      display: inline-block;
      width: 6px;
      height: 6px;
      border-radius: 50%;
    }
    .badge-status.warning {
      background: rgba(245, 158, 11, 0.12);
      color: #d97706;
    }
    .badge-status.warning::before { background: #f59e0b; }
    .badge-status.success {
      background: rgba(16, 185, 129, 0.12);
      color: #059669;
    }
    .badge-status.success::before { background: #10b981; }
    .badge-status.danger {
      background: rgba(239, 68, 68, 0.12);
      color: #dc2626;
    }
    .badge-status.danger::before { background: #ef4444; }

    .progress-bar-container {
      width: 100%;
      height: 7px;
      background: var(--border-soft, #f1f5f9);
      border-radius: 999px;
      overflow: hidden;
      margin-top: 8px;
    }
    .progress-bar-fill {
      height: 100%;
      background: linear-gradient(90deg, #ec4899, #8b5cf6);
      border-radius: 999px;
      transition: width 0.3s ease;
    }
    .buyer-avatar-circle {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: linear-gradient(135deg, #ec4899, #8b5cf6);
      color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.75rem;
      font-weight: 700;
      flex-shrink: 0;
    }
  </style>
</head>
<body data-active="dashboard" data-crumbs="Workspace | Dashboard Admin">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        <!-- Hero Section -->
        <section class="hero">
          <div class="hero-text">
            <span class="eyebrow" id="heroDate">Light and Glow Run Bukittinggi 2026</span>
            <h1 class="hero-title">Dashboard <span class="accent">Administrator</span></h1>
            <p class="hero-sub">Ringkasan transaksi penjualan tiket, status antrean verifikasi pembayaran, dan log gate masuk real-time dari database.</p>
          </div>
          <div class="hero-actions">
            @if($pendingCount > 0)
              <a href="{{ route('admin.verifikasi') }}" class="btn btn--primary" style="box-shadow: 0 4px 14px rgba(236, 72, 153, 0.35);">
                <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                Verifikasi Pesanan ({{ $pendingCount }})
              </a>
            @else
              <a href="{{ route('admin.verifikasi') }}" class="btn btn--ghost">
                <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                Verifikasi Pembayaran
              </a>
            @endif
            <a href="{{ route('admin.tiket') }}" class="btn btn--ghost">
              <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 10h18M3 16h18M9 4v16"/></svg>
              Kelola Tiket
            </a>
          </div>
        </section>

        <!-- KPI Grid 4 Kolom Rapi & Terstruktur -->
        <section class="kpi-stat-grid" aria-label="Key metrics">
          <!-- Card 1: Total Pesanan -->
          <article class="kpi-card-clean">
            <div class="kpi-header">
              <span class="kpi-title">Total Transaksi</span>
              <div class="kpi-icon-wrap kpi-icon-blue">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
              </div>
            </div>
            <div class="kpi-number">{{ number_format($totalOrdersCount, 0, ',', '.') }}</div>
            <div class="kpi-desc">
              <span>{{ $approvedCount }} disetujui · {{ $rejectedCount }} ditolak</span>
            </div>
          </article>

          <!-- Card 2: Total Pendapatan Disetujui -->
          <article class="kpi-card-clean">
            <div class="kpi-header">
              <span class="kpi-title">Total Pendapatan</span>
              <div class="kpi-icon-wrap kpi-icon-green">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
              </div>
            </div>
            <div class="kpi-number">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            <div class="kpi-desc">
              <span style="color: #059669; font-weight: 600;">Dana berhasil diverifikasi</span>
            </div>
          </article>

          <!-- Card 3: Tiket Terbit & Aktif -->
          <article class="kpi-card-clean">
            <div class="kpi-header">
              <span class="kpi-title">Tiket Terbit (Aktif)</span>
              <div class="kpi-icon-wrap kpi-icon-purple">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 10h18M3 16h18M9 4v16"/></svg>
              </div>
            </div>
            <div class="kpi-number">{{ number_format($activeTicketsCount, 0, ',', '.') }}</div>
            <div class="kpi-desc">
              <span>{{ $checkInCount }} peserta telah scan di gate</span>
            </div>
          </article>

          <!-- Card 4: Menunggu Verifikasi -->
          <article class="kpi-card-clean" style="{{ $pendingCount > 0 ? 'border-color: rgba(245, 158, 11, 0.4);' : '' }}">
            <div class="kpi-header">
              <span class="kpi-title">Menunggu Verifikasi</span>
              <div class="kpi-icon-wrap kpi-icon-amber">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              </div>
            </div>
            <div class="kpi-number" style="{{ $pendingCount > 0 ? 'color: #d97706;' : '' }}">{{ $pendingCount }}</div>
            <div class="kpi-desc">
              @if($pendingCount > 0)
                <span style="color: #d97706; font-weight: 600;">Perlu approval admin</span>
              @else
                <span>Semua pembayaran tuntas</span>
              @endif
            </div>
          </article>
        </section>

        <!-- Konten Database Nyata: Data Transaksi Terkini & Kuota Tiket -->
        <div class="grid">
          <!-- Tabel Transaksi Terbaru (Database Nyata) -->
          <section class="col-8 card" style="padding: 24px;">
            <div class="card-head" style="margin-bottom: 16px;">
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
              <table class="table" style="width: 100%; border-collapse: collapse;">
                <thead>
                  <tr style="border-bottom: 1px solid var(--border-soft, #e2e8f0); text-align: left;">
                    <th style="padding: 10px 12px; font-size: 0.75rem; text-transform: uppercase; color: var(--t-muted, #64748b);">No. Pesanan</th>
                    <th style="padding: 10px 12px; font-size: 0.75rem; text-transform: uppercase; color: var(--t-muted, #64748b);">Pembeli</th>
                    <th style="padding: 10px 12px; font-size: 0.75rem; text-transform: uppercase; color: var(--t-muted, #64748b);">Kategori Tiket</th>
                    <th style="padding: 10px 12px; font-size: 0.75rem; text-transform: uppercase; color: var(--t-muted, #64748b); text-align: center;">Qty</th>
                    <th style="padding: 10px 12px; font-size: 0.75rem; text-transform: uppercase; color: var(--t-muted, #64748b); text-align: right;">Total Bayar</th>
                    <th style="padding: 10px 12px; font-size: 0.75rem; text-transform: uppercase; color: var(--t-muted, #64748b); text-align: center;">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($recentOrders as $order)
                    <tr style="border-bottom: 1px solid var(--border-soft, #f1f5f9);">
                      <td style="padding: 12px;">
                        <span style="font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; font-weight: 600; color: var(--accent, #ec4899);">
                          {{ $order->order_number }}
                        </span>
                      </td>
                      <td style="padding: 12px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                          <div class="buyer-avatar-circle">
                            {{ strtoupper(substr($order->buyer_name ?? 'U', 0, 1)) }}
                          </div>
                          <div>
                            <div style="font-weight: 600; font-size: 0.88rem; color: var(--t-base, #1e293b);">{{ $order->buyer_name }}</div>
                            <div style="font-size: 0.75rem; color: var(--t-muted, #94a3b8);">{{ $order->buyer_email }}</div>
                          </div>
                        </div>
                      </td>
                      <td style="padding: 12px;">
                        <span class="tag t-new" style="font-size: 0.75rem; padding: 3px 8px; border-radius: 6px; background: rgba(236,72,153,0.1); color: #ec4899; font-weight: 600;">
                          {{ $order->ticket_name }}
                        </span>
                      </td>
                      <td style="padding: 12px; text-align: center; font-weight: 600; font-size: 0.85rem;">{{ $order->quantity }}</td>
                      <td style="padding: 12px; text-align: right; font-family: 'JetBrains Mono', monospace; font-weight: 600; font-size: 0.85rem;">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                      </td>
                      <td style="padding: 12px; text-align: center;">
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
                      <td colspan="6" style="text-align: center; padding: 2.5rem; color: var(--t-muted, #94a3b8);">
                        Belum ada data pesanan yang masuk.
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </section>

          <!-- Status Kuota Tiket & Gateway Masuk (Database Nyata) -->
          <section class="col-4 card" style="padding: 24px; display: flex; flex-direction: column;">
            <div class="card-head" style="margin-bottom: 16px;">
              <div class="card-title-wrap">
                <span class="eyebrow">Alokasi & Gate</span>
                <h2 class="card-title">Ketersediaan Kuota Tiket</h2>
              </div>
              <a class="card-action" href="{{ route('admin.tiket') }}">Kelola</a>
            </div>

            <div style="padding: 0.5rem 0 1.25rem 0; flex: 1;">
              @foreach($ticketTypes as $ticket)
                @php
                  $totalQ = $ticket->quota ?? $ticket->total_quota ?? 0;
                  $sold = max(0, $totalQ - $ticket->remaining_quota);
                  $percentage = $totalQ > 0 ? round(($sold / $totalQ) * 100) : 0;
                @endphp
                <div style="margin-bottom: 1.25rem; background: var(--bg-card-sub, rgba(0,0,0,0.015)); padding: 10px 12px; border-radius: 8px; border: 1px solid var(--border-soft, #f1f5f9);">
                  <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 4px;">
                    <div>
                      <strong style="font-size: 0.88rem; color: var(--t-base, #1e293b);">{{ $ticket->name }}</strong>
                      <span style="font-size: 0.72rem; color: var(--t-muted, #94a3b8); margin-left: 6px;">{{ $ticket->category }}</span>
                    </div>
                    <div style="font-size: 0.8rem; font-weight: 600; font-family: 'JetBrains Mono', monospace;">
                      {{ $sold }} / {{ $totalQ }}
                    </div>
                  </div>
                  <div class="progress-bar-container">
                    <div class="progress-bar-fill" style="width: {{ min(100, $percentage) }}%;"></div>
                  </div>
                  <div style="display: flex; justify-content: space-between; font-size: 0.72rem; color: var(--t-muted, #94a3b8); margin-top: 6px;">
                    <span>Sisa kuota: <strong style="color: var(--t-base, #1e293b);">{{ $ticket->remaining_quota }}</strong></span>
                    <span style="font-weight: 600;">Rp {{ number_format($ticket->price, 0, ',', '.') }}</span>
                  </div>
                </div>
              @endforeach
            </div>

            <div style="border-top: 1px solid var(--border-soft, #e2e8f0); padding-top: 1.25rem; margin-top: auto;">
              <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.75rem;">
                <span style="font-size: 0.82rem; color: var(--t-muted, #64748b);">Total Check-in Venue:</span>
                <span style="font-weight: 700; color: #10b981; font-size: 1rem; font-family: 'JetBrains Mono', monospace;">{{ $checkInCount }} Peserta</span>
              </div>
              <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.75rem;">
                <span style="font-size: 0.82rem; color: var(--t-muted, #64748b);">Pesanan Ditolak:</span>
                <span style="font-weight: 600; color: #ef4444; font-size: 0.9rem; font-family: 'JetBrains Mono', monospace;">{{ $rejectedCount }} Transaksi</span>
              </div>
              <div style="display: flex; align-items: center; justify-content: space-between;">
                <span style="font-size: 0.82rem; color: var(--t-muted, #64748b);">Status Gate Scanner:</span>
                <span style="font-weight: 600; color: #3b82f6; font-size: 0.82rem;">Siap Digunakan</span>
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