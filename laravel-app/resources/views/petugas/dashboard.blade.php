<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Inter+Tight:wght@500;600;700&amp;family=JetBrains+Mono:wght@400;500&amp;display=swap">
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
  <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
  <title>Dashboard Petugas · Light And Glow Bukittinggi</title>
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
<body data-active="dashboard" data-crumbs="Petugas | Dashboard Ringkasan Gate" data-user-name="{{ Auth::check() ? Auth::user()->name : '' }}" data-user-email="{{ Auth::check() ? Auth::user()->email : '' }}">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow" id="heroDate">Panel Petugas Gate</span>
            <h1 class="hero-title">Dashboard <span class="accent">{{ Auth::check() ? Auth::user()->name : 'Petugas Masuk' }}</span></h1>
            <p class="hero-sub">Ringkasan operasional check-in gerbang masuk venue Light And Glow Bukittinggi 2026. Pantau arus peserta dan mulai pemindaian e-tiket di menu Scanner.</p>
          </div>
          <div class="hero-actions">
            <a href="{{ route('petugas.scanner') }}" class="btn btn--primary">
              <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
              Buka Scanner QR
            </a>
          </div>
        </section>

        <!-- KPI Grid Operasional Petugas Sesuai Template Adminator -->
        <section class="kpi-grid" style="margin-bottom: 24px;">
          <!-- Card 1: Total Check-in Berhasil -->
          <article class="kpi-card c-success">
            <div class="kpi-top">
              <div class="kpi-identity">
                <div class="kpi-icon success">
                  <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div class="kpi-label">Peserta Check-in</div>
              </div>
              <span class="kpi-pill up">Gate Aktif</span>
            </div>
            <div class="kpi-value">{{ $todayCheckIns ?? 0 }}</div>
            <div class="kpi-compare">
              <svg class="up" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
              Peserta telah masuk venue utama
            </div>
          </article>

          <!-- Card 2: Total Tiket Resmi Terbit -->
          <article class="kpi-card c-primary">
            <div class="kpi-top">
              <div class="kpi-identity">
                <div class="kpi-icon primary">
                  <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 10h18M3 16h18M9 4v16"/></svg>
                </div>
                <div class="kpi-label">Total Tiket Terbit</div>
              </div>
              <span class="kpi-pill info">Terdaftar</span>
            </div>
            <div class="kpi-value">{{ $totalTicketsIssued ?? 0 }}</div>
            <div class="kpi-compare">
              <svg class="info" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
              Total e-tiket aktif di database
            </div>
          </article>

          <!-- Card 3: Percobaan Ditolak / Duplikat -->
          <article class="kpi-card c-danger">
            <div class="kpi-top">
              <div class="kpi-identity">
                <div class="kpi-icon danger">
                  <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                </div>
                <div class="kpi-label">Check-in Ditolak</div>
              </div>
              <span class="kpi-pill down">Duplikat / Invalid</span>
            </div>
            <div class="kpi-value">{{ $totalRejected ?? 0 }}</div>
            <div class="kpi-compare">
              <svg class="down" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
              Tiket ganda atau tidak terdaftar
            </div>
          </article>

          <!-- Card 4: Quick Action Scanner -->
          <article class="kpi-card c-purple">
            <div class="kpi-top">
              <div class="kpi-identity">
                <div class="kpi-icon purple">
                  <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                </div>
                <div class="kpi-label">Mode Scanner</div>
              </div>
              <span class="kpi-pill flat">SIAP</span>
            </div>
            <div class="kpi-value" style="font-size: 22px; margin-top: 6px;">
              <a href="{{ route('petugas.scanner') }}" style="color:inherit; text-decoration:underline;">Buka Scanner &rarr;</a>
            </div>
            <div class="kpi-compare">
              <svg class="flat" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
              Kamera & manual barcode check-in
            </div>
          </article>
        </section>

        <!-- Tabel Riwayat Pemindaian Terakhir -->
        <section class="card" style="padding: 24px;">
          <div class="card-head" style="margin-bottom: 16px; display:flex; justify-content:space-between; align-items:center;">
            <div class="card-title-wrap">
              <span class="eyebrow">Aktivitas Gerbang Masuk</span>
              <h2 class="card-title" style="font-size:18px;">Log Pemindaian Terbaru</h2>
            </div>
            <a href="{{ route('petugas.scanner') }}" class="btn btn--primary" style="font-size: 13px;">
              <svg viewBox="0 0 24 24" width="16" height="16"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
              Scan E-Tiket Sekarang
            </a>
          </div>

          @if(isset($recentLogs) && count($recentLogs) > 0)
            <div class="table-scroll">
              <table class="table" style="width: 100%; min-width: 650px;">
                <thead>
                  <tr>
                    <th style="white-space: nowrap;">Waktu</th>
                    <th style="white-space: nowrap;">Kode Tiket</th>
                    <th style="white-space: nowrap;">Nama Peserta</th>
                    <th style="white-space: nowrap;">Lokasi Gate</th>
                    <th style="white-space: nowrap;">Catatan Petugas</th>
                    <th style="text-align:right; white-space: nowrap;">Status Validasi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($recentLogs as $log)
                    <tr>
                      <td style="font-size:12px; color:var(--t-muted); white-space: nowrap;">
                        {{ \Carbon\Carbon::parse($log->scanned_at)->format('d M Y, H:i:s') }} WIB
                      </td>
                      <td><code>{{ $log->ticket_code }}</code></td>
                      <td><strong>{{ $log->holder_name }}</strong></td>
                      <td>{{ $log->gate_location }}</td>
                      <td style="font-size:12px; color:var(--t-muted);">{{ $log->notes ?? '-' }}</td>
                      <td style="text-align:right;">
                        @if($log->validation_status === 'success')
                          <span class="badge success dot">Berhasil Masuk</span>
                        @elseif($log->validation_status === 'rejected_used')
                          <span class="badge danger dot">Duplikat (Sudah Dipakai)</span>
                        @else
                          <span class="badge warning dot">Tidak Valid</span>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div style="text-align:center; padding: 40px 20px; color:var(--t-muted);">
              <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom:12px; opacity:0.6;">
                <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
              </svg>
              <p style="font-size:14px; margin:0;">Belum ada riwayat check-in yang tercatat di gate ini.</p>
              <div style="margin-top:16px;">
                <a href="{{ route('petugas.scanner') }}" class="btn btn--primary">Mulai Pindai Tiket</a>
              </div>
            </div>
          @endif
        </section>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>
</body>
</html>
