<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BuyerAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes - Light And Glow Bukittinggi
|--------------------------------------------------------------------------
*/

// 1. Landing Page (Folder template)
Route::get('/', function () {
    $event = DB::table('events')->first();
    $tickets = DB::table('ticket_types')->where('is_active', true)->get();
    $spots = DB::table('event_spots')->where('is_active', true)->orderBy('order_index', 'asc')->get();
    $banners = DB::table('banners')->where('is_active', true)->orderBy('order_index', 'asc')->get();
    $buyer = session('buyer');
    return view('welcome', compact('event', 'tickets', 'spots', 'banners', 'buyer'));
})->name('home');

// ─── BUYER AUTH ROUTES ─────────────────────────────────────────────────────
Route::get('/masuk', [BuyerAuthController::class, 'showLogin'])->name('buyer.login');
Route::post('/masuk', [BuyerAuthController::class, 'login'])->name('buyer.login.post');
Route::get('/daftar', [BuyerAuthController::class, 'showRegister'])->name('buyer.register');
Route::post('/daftar', [BuyerAuthController::class, 'register'])->name('buyer.register.post');
Route::post('/keluar', [BuyerAuthController::class, 'logout'])->name('buyer.logout');

// ─── BUYER DASHBOARD (Protected by session) ────────────────────────────────
Route::get('/tiket-saya', function () {
    $buyer = session('buyer');
    if (!$buyer) {
        session(['url.intended' => url('/tiket-saya')]);
        return redirect()->route('buyer.login')->with('info', 'Silakan login untuk melihat tiket Anda.');
    }

    $orders = DB::table('orders')
        ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
        ->join('ticket_types', 'orders.ticket_type_id', '=', 'ticket_types.id')
        ->leftJoin('users', 'orders.verified_by', '=', 'users.id')
        ->select(
            'orders.*',
            'buyers.name as buyer_name',
            'buyers.email as buyer_email',
            'buyers.phone as buyer_phone',
            'buyers.nik as buyer_nik',
            'buyers.address as buyer_address',
            'ticket_types.name as ticket_name',
            'ticket_types.category as ticket_category',
            'ticket_types.price as ticket_price',
            'ticket_types.image as ticket_image',
            'users.name as verified_by_name'
        )
        ->where('orders.buyer_id', $buyer['id'])
        ->whereIn('orders.status', ['Pembayaran disetujui', 'Menunggu verifikasi'])
        ->orderBy('orders.id', 'desc')
        ->get();

    $digitalTickets = DB::table('digital_tickets')
        ->join('orders', 'digital_tickets.order_id', '=', 'orders.id')
        ->join('ticket_types', 'digital_tickets.ticket_type_id', '=', 'ticket_types.id')
        ->select('digital_tickets.*', 'ticket_types.name as ticket_name', 'ticket_types.category as ticket_category', 'ticket_types.price as ticket_price', 'orders.order_number')
        ->where('orders.buyer_id', $buyer['id'])
        ->get();

    return view('buyer.dashboard', compact('orders', 'digitalTickets', 'buyer'));
})->name('buyer.dashboard');

// 2. Autentikasi Admin & Petugas (Adminator 4.4.0)
Route::get('/login', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return $user->id == 1 ? redirect()->route('admin.dashboard') : redirect()->route('petugas.dashboard');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        $user = Auth::user();

        // Role mapping: ID 1 adalah Admin Utama, ID > 1 adalah Petugas Gate Scanner
        if ($user->id == 1) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('petugas.dashboard'));
    }

    return back()->withInput($request->only('email'))->with('error', 'Email atau password yang Anda masukkan salah.');
})->name('login.post');

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login')->with('success', 'Anda telah berhasil keluar dari sistem.');
})->name('logout');

Route::get('/register', function () {
    return redirect()->route('login');
})->name('register');

// Helper callback untuk verifikasi role admin
$ensureAdmin = function () {
    if (!Auth::check()) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }
    if (Auth::user()->id != 1) {
        return redirect()->route('petugas.dashboard')->with('error', 'Akses ditolak: Akun Anda adalah Petugas Gate, bukan Administrator.');
    }
    return null;
};

// Helper callback untuk verifikasi role petugas
$ensurePetugas = function () {
    if (!Auth::check()) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }
    return null;
};

// 3. Dashboard Admin Utama (Adminator 4.4.0)
$adminDashboardHandler = function () use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;

    $totalOrdersCount = DB::table('orders')->count();
    $totalRevenue = DB::table('orders')->where('status', 'Pembayaran disetujui')->sum('total_amount');
    $activeTicketsCount = DB::table('digital_tickets')->count();
    $pendingCount = DB::table('orders')->where('status', 'Menunggu verifikasi')->count();
    $approvedCount = DB::table('orders')->where('status', 'Pembayaran disetujui')->count();
    $rejectedCount = DB::table('orders')->where('status', 'Pembayaran ditolak')->count();
    $checkInCount = DB::table('check_in_logs')->where('validation_status', 'success')->count();

    $recentOrders = DB::table('orders')
        ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
        ->join('ticket_types', 'orders.ticket_type_id', '=', 'ticket_types.id')
        ->select('orders.*', 'buyers.name as buyer_name', 'buyers.email as buyer_email', 'ticket_types.name as ticket_name')
        ->orderBy('orders.id', 'desc')
        ->limit(10)
        ->get();

    $ticketTypes = DB::table('ticket_types')->get();

    return view('admin.dashboard', compact(
        'totalOrdersCount',
        'totalRevenue',
        'activeTicketsCount',
        'pendingCount',
        'approvedCount',
        'rejectedCount',
        'checkInCount',
        'recentOrders',
        'ticketTypes'
    ));
};

Route::get('/admin/dashboard', $adminDashboardHandler)->name('admin.dashboard');
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');

// 3b. Dashboard Petugas Gate (Ringkasan Statistik & Aktivitas Gate)
$petugasDashboardHandler = function () use ($ensurePetugas) {
    if ($redirect = $ensurePetugas()) return $redirect;

    $event = DB::table('events')->first();
    $todayCheckIns = DB::table('check_in_logs')->where('validation_status', 'success')->count();
    $totalRejected = DB::table('check_in_logs')->where('validation_status', '!=', 'success')->count();
    $totalTicketsIssued = DB::table('digital_tickets')->count();
    $recentLogs = DB::table('check_in_logs')
        ->join('digital_tickets', 'check_in_logs.digital_ticket_id', '=', 'digital_tickets.id')
        ->select('check_in_logs.*', 'digital_tickets.holder_name', 'digital_tickets.ticket_code')
        ->orderBy('check_in_logs.id', 'desc')
        ->limit(10)
        ->get();
    return view('petugas.dashboard', compact('event', 'todayCheckIns', 'totalRejected', 'totalTicketsIssued', 'recentLogs'));
};

// 3c. Scanner QR Code Petugas Check-in
$petugasScannerHandler = function () use ($ensurePetugas) {
    if ($redirect = $ensurePetugas()) return $redirect;

    $event = DB::table('events')->first();
    $todayCheckIns = DB::table('check_in_logs')->where('validation_status', 'success')->count();
    $recentLogs = DB::table('check_in_logs')
        ->join('digital_tickets', 'check_in_logs.digital_ticket_id', '=', 'digital_tickets.id')
        ->select('check_in_logs.*', 'digital_tickets.holder_name', 'digital_tickets.ticket_code')
        ->orderBy('check_in_logs.id', 'desc')
        ->limit(5)
        ->get();
    return view('petugas.scanner', compact('event', 'todayCheckIns', 'recentLogs'));
};

Route::get('/petugas/dashboard', $petugasDashboardHandler)->name('petugas.dashboard');
Route::get('/petugas/scanner', $petugasScannerHandler)->name('petugas.scanner');
Route::get('/petugas', fn() => redirect()->route('petugas.dashboard'));

// Redirect legacy CMS to Master Acara & QRIS
Route::get('/admin/cms', fn() => redirect()->route('admin.acara'));
Route::get('/dashboard/cms', fn() => redirect()->route('admin.acara'));

Route::get('/admin/tiket', function () use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    $tickets = DB::table('ticket_types')->get();
    return view('admin.tiket', compact('tickets'));
})->name('admin.tiket');
Route::get('/dashboard/tiket', fn() => redirect()->route('admin.tiket'));

// Admin Ticket CRUD (Integrasi Database MySQL)
Route::post('/admin/tiket/store', function (\Illuminate\Http\Request $request) use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    $request->validate([
        'name' => 'required|string|max:150',
        'price' => 'required|numeric|min:0',
        'category' => 'nullable|string|max:50',
        'quota' => 'nullable|integer|min:0',
        'benefits' => 'nullable|string',
        'image' => 'nullable|string'
    ]);

    $quota = (int) ($request->input('quota', 100) ?: 100);
    $price = (float) str_replace(['Rp', '.', ' '], '', $request->input('price'));

    DB::table('ticket_types')->insert([
        'event_id' => 1,
        'name' => $request->input('name'),
        'category' => $request->input('category', 'Reguler'),
        'price' => $price,
        'quota' => $quota,
        'remaining_quota' => $quota,
        'benefits' => $request->input('benefits'),
        'image' => $request->input('image') ?: 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=500&auto=format&fit=crop&q=60',
        'is_active' => true,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return redirect()->route('admin.tiket')->with('success', 'Tiket baru berhasil ditambahkan ke database MySQL!');
})->name('admin.tiket.store');

Route::post('/admin/tiket/{id}/update', function (\Illuminate\Http\Request $request, $id) use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    $request->validate([
        'name' => 'required|string|max:150',
        'price' => 'required',
        'category' => 'nullable|string|max:50',
        'quota' => 'nullable|integer|min:0',
        'benefits' => 'nullable|string',
        'image' => 'nullable|string'
    ]);

    $ticket = DB::table('ticket_types')->where('id', $id)->first();
    if (!$ticket) {
        return redirect()->route('admin.tiket')->with('error', 'Tiket tidak ditemukan.');
    }

    $rawPrice = $request->input('price');
    $cleanPrice = (float) preg_replace('/[^0-9]/', '', $rawPrice);
    if ($cleanPrice == 0 && is_numeric($rawPrice)) {
        $cleanPrice = (float) $rawPrice;
    }

    $newQuota = (int) ($request->input('quota', $ticket->quota) ?: $ticket->quota);
    $sold = max(0, $ticket->quota - $ticket->remaining_quota);
    $newRemaining = max(0, $newQuota - $sold);

    DB::table('ticket_types')->where('id', $id)->update([
        'name' => $request->input('name'),
        'category' => $request->input('category', $ticket->category),
        'price' => $cleanPrice,
        'quota' => $newQuota,
        'remaining_quota' => $newRemaining,
        'benefits' => $request->input('benefits'),
        'image' => $request->input('image') ?: $ticket->image,
        'updated_at' => now()
    ]);

    return redirect()->route('admin.tiket')->with('success', 'Data tiket dan daftar benefit berhasil diperbarui di database MySQL!');
})->name('admin.tiket.update');

Route::delete('/admin/tiket/{id}', function ($id) use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    DB::table('ticket_types')->where('id', $id)->delete();
    return redirect()->route('admin.tiket')->with('success', 'Tiket berhasil dihapus dari database.');
})->name('admin.tiket.delete');

// Halaman Preview Tiket & Benefit Khusus Pembeli (1 Halaman Penuh, Bukan Modal)
Route::get('/tiket/{id}', function ($id) {
    $ticket = DB::table('ticket_types')->where('id', $id)->first();
    if (!$ticket) {
        return redirect()->route('home')->with('error', 'Kategori tiket tidak ditemukan.');
    }
    $event = DB::table('events')->first();
    $buyer = session('buyer');
    return view('buyer.ticket-detail', compact('ticket', 'event', 'buyer'));
})->name('buyer.ticket.detail');

Route::get('/admin/banner', function () use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    $banners = DB::table('banners')->orderBy('order_index', 'asc')->get();
    return view('admin.banner', compact('banners'));
})->name('admin.banner');
Route::get('/dashboard/banner', fn() => redirect()->route('admin.banner'));

Route::post('/admin/banner/store', function (\Illuminate\Http\Request $request) use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    $request->validate([
        'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        'image' => 'nullable|string',
        'order_index' => 'nullable|integer'
    ]);

    $imagePath = $request->input('image', '');
    if ($request->hasFile('image_file')) {
        $file = $request->file('image_file');
        $fileName = 'banner_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/banners'), $fileName);
        $imagePath = '/uploads/banners/' . $fileName;
    }

    if (empty($imagePath)) {
        return redirect()->route('admin.banner')->with('error', 'File gambar banner wajib diunggah!');
    }

    $orderIndex = (int) ($request->input('order_index', 0) ?: 0);

    DB::table('banners')->insert([
        'tag' => 'PROMO',
        'title' => 'Banner ' . (DB::table('banners')->count() + 1),
        'description' => 'Light and Glow Run Bukittinggi 2026',
        'image' => $imagePath,
        'order_index' => $orderIndex,
        'is_active' => true,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return redirect()->route('admin.banner')->with('success', 'Gambar banner baru berhasil ditambahkan!');
})->name('admin.banner.store');

Route::post('/admin/banner/{id}/update', function (\Illuminate\Http\Request $request, $id) use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    $request->validate([
        'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        'image' => 'nullable|string',
        'order_index' => 'nullable|integer'
    ]);

    $banner = DB::table('banners')->where('id', $id)->first();
    if (!$banner) {
        return redirect()->route('admin.banner')->with('error', 'Banner tidak ditemukan.');
    }

    $imagePath = $request->input('image', $banner->image);
    if ($request->hasFile('image_file')) {
        $file = $request->file('image_file');
        $fileName = 'banner_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/banners'), $fileName);
        $imagePath = '/uploads/banners/' . $fileName;
    }

    $orderIndex = (int) ($request->input('order_index', $banner->order_index) ?: 0);

    DB::table('banners')->where('id', $id)->update([
        'image' => $imagePath,
        'order_index' => $orderIndex,
        'updated_at' => now()
    ]);

    return redirect()->route('admin.banner')->with('success', 'Gambar banner berhasil diperbarui!');
})->name('admin.banner.update');

Route::delete('/admin/banner/{id}', function ($id) use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    DB::table('banners')->where('id', $id)->delete();
    return redirect()->route('admin.banner')->with('success', 'Banner berhasil dihapus dari database.');
})->name('admin.banner.delete');

// Admin Rute & Spot Ikonik Bukittinggi (Terintegrasi Database MySQL)
Route::get('/admin/rute', function () use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    $spots = DB::table('event_spots')->orderBy('order_index', 'asc')->get();
    return view('admin.rute', compact('spots'));
})->name('admin.rute');
Route::get('/dashboard/rute', fn() => redirect()->route('admin.rute'));

Route::post('/admin/rute/store', function (\Illuminate\Http\Request $request) use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    $request->validate([
        'name' => 'required|string|max:100',
        'description' => 'required|string|max:255',
        'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        'image' => 'nullable|string',
        'order_index' => 'nullable|integer'
    ]);

    $imagePath = $request->input('image', '');
    if ($request->hasFile('image_file')) {
        $file = $request->file('image_file');
        $fileName = 'spot_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/spots'), $fileName);
        $imagePath = '/uploads/spots/' . $fileName;
    }

    if (empty($imagePath)) {
        return redirect()->route('admin.rute')->with('error', 'File foto spot rute wajib diunggah (format PNG atau JPG)!');
    }

    $orderIndex = (int) ($request->input('order_index', 0) ?: 0);

    DB::table('event_spots')->insert([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'image' => $imagePath,
        'order_index' => $orderIndex,
        'is_active' => true,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return redirect()->route('admin.rute')->with('success', 'Spot ikonik rute baru berhasil disimpan ke database!');
})->name('admin.rute.store');

Route::post('/admin/rute/{id}/update', function (\Illuminate\Http\Request $request, $id) use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    $request->validate([
        'name' => 'required|string|max:100',
        'description' => 'required|string|max:255',
        'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        'image' => 'nullable|string',
        'order_index' => 'nullable|integer'
    ]);

    $spot = DB::table('event_spots')->where('id', $id)->first();
    if (!$spot) {
        return redirect()->route('admin.rute')->with('error', 'Spot rute tidak ditemukan.');
    }

    $imagePath = $request->input('image', $spot->image);
    if ($request->hasFile('image_file')) {
        $file = $request->file('image_file');
        $fileName = 'spot_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/spots'), $fileName);
        $imagePath = '/uploads/spots/' . $fileName;
    }

    $orderIndex = (int) ($request->input('order_index', $spot->order_index) ?: 0);

    DB::table('event_spots')->where('id', $id)->update([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'image' => $imagePath,
        'order_index' => $orderIndex,
        'updated_at' => now()
    ]);

    return redirect()->route('admin.rute')->with('success', 'Data foto dan informasi spot rute berhasil diperbarui di database!');
})->name('admin.rute.update');

Route::delete('/admin/rute/{id}', function ($id) use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    DB::table('event_spots')->where('id', $id)->delete();
    return redirect()->route('admin.rute')->with('success', 'Spot rute berhasil dihapus dari database.');
})->name('admin.rute.delete');

Route::get('/admin/acara', function () use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    $event = DB::table('events')->first();
    return view('admin.acara', compact('event'));
})->name('admin.acara');
Route::get('/dashboard/acara', fn() => redirect()->route('admin.acara'));

Route::post('/admin/acara/update', function (\Illuminate\Http\Request $request) use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    $request->validate([
        'qris_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
        'qris_image' => 'nullable|string',
        'qris_merchant_name' => 'nullable|string|max:100'
    ]);

    $event = DB::table('events')->first();
    $qrisImagePath = $event->qris_image ?? null;

    if ($request->hasFile('qris_file')) {
        $file = $request->file('qris_file');
        $fileName = 'qris_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/qris'), $fileName);
        $qrisImagePath = '/uploads/qris/' . $fileName;
    } elseif ($request->filled('qris_image')) {
        $qrisImagePath = $request->input('qris_image');
    }

    $updateData = [
        'qris_image' => $qrisImagePath,
        'qris_merchant_name' => $request->input('qris_merchant_name', 'LIGHT AND GLOW BUKITTINGGI'),
        'updated_at' => now()
    ];

    if ($event) {
        DB::table('events')->where('id', $event->id)->update($updateData);
    } else {
        $updateData['title'] = 'Light And Glow Bukittinggi 2026';
        $updateData['slug'] = 'light-and-glow-bukittinggi-2026';
        $updateData['location'] = 'Jam Gadang, Bukittinggi';
        $updateData['event_date'] = '2026-04-25';
        $updateData['status'] = 'active';
        $updateData['created_at'] = now();
        DB::table('events')->insert($updateData);
    }

    return redirect()->route('admin.acara')->with('success', 'Gambar Barcode QRIS Pembayaran berhasil diperbarui di database!');
})->name('admin.acara.update');

// 5. Verifikasi Pembayaran (Berdasarkan rancangan web.txt)
Route::get('/admin/verifikasi', function () use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    $orders = DB::table('orders')
        ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
        ->join('ticket_types', 'orders.ticket_type_id', '=', 'ticket_types.id')
        ->select('orders.*', 'buyers.name as buyer_name', 'buyers.email as buyer_email', 'buyers.phone as buyer_phone', 'ticket_types.name as ticket_name')
        ->orderByRaw("CASE WHEN orders.status = 'Menunggu verifikasi' THEN 0 ELSE 1 END")
        ->orderBy('orders.id', 'desc')
        ->get();

    return view('admin.verifikasi', compact('orders'));
})->name('admin.verifikasi');
Route::get('/dashboard/verifikasi', fn() => redirect()->route('admin.verifikasi'));

// 6. Scanner QR Code Petugas Check-in (Berdasarkan rancangan web.txt)
Route::get('/admin/scanner', function () {
    return redirect()->route('petugas.scanner');
})->name('admin.scanner');
Route::get('/dashboard/scanner', fn() => redirect()->route('petugas.scanner'));

// 7. Data Pesanan, Kehadiran, & Petugas
Route::get('/admin/pesanan', function () use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    $orders = DB::table('orders')
        ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
        ->join('ticket_types', 'orders.ticket_type_id', '=', 'ticket_types.id')
        ->select('orders.*', 'buyers.name as buyer_name', 'buyers.email as buyer_email', 'buyers.phone as buyer_phone', 'buyers.nik as buyer_nik', 'ticket_types.name as ticket_name')
        ->orderBy('orders.id', 'desc')
        ->get();

    return view('admin.pesanan', compact('orders'));
})->name('admin.pesanan');
Route::get('/dashboard/pesanan', fn() => redirect()->route('admin.pesanan'));

Route::get('/admin/kehadiran', function () use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    $logs = DB::table('check_in_logs')
        ->join('digital_tickets', 'check_in_logs.digital_ticket_id', '=', 'digital_tickets.id')
        ->leftJoin('users', 'check_in_logs.staff_id', '=', 'users.id')
        ->select('check_in_logs.*', 'digital_tickets.holder_name', 'digital_tickets.ticket_code', 'users.name as staff_name')
        ->orderBy('check_in_logs.id', 'desc')
        ->get();

    $totalCheckedIn = DB::table('check_in_logs')->where('validation_status', 'success')->count();
    $totalRejected = DB::table('check_in_logs')->where('validation_status', '!=', 'success')->count();

    return view('admin.kehadiran', compact('logs', 'totalCheckedIn', 'totalRejected'));
})->name('admin.kehadiran');
Route::get('/dashboard/kehadiran', fn() => redirect()->route('admin.kehadiran'));

Route::get('/admin/petugas', function () use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    $staff = DB::table('users')->get();
    return view('admin.petugas', compact('staff'));
})->name('admin.petugas');
Route::get('/dashboard/petugas', fn() => redirect()->route('admin.petugas'));

Route::post('/admin/petugas/store', function (\Illuminate\Http\Request $request) use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    $request->validate([
        'name' => 'required|string|max:150',
        'email' => 'required|email|max:150|unique:users,email',
        'password' => 'required|string|min:6'
    ]);

    DB::table('users')->insert([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return redirect()->route('admin.petugas')->with('success', 'Akun petugas baru berhasil ditambahkan!');
})->name('admin.petugas.store');

Route::post('/admin/petugas/{id}/update', function (\Illuminate\Http\Request $request, $id) use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    $request->validate([
        'name' => 'required|string|max:150',
        'email' => 'required|email|max:150|unique:users,email,' . $id,
        'password' => 'nullable|string|min:6'
    ]);

    $updateData = [
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'updated_at' => now()
    ];

    if ($request->filled('password')) {
        $updateData['password'] = Hash::make($request->input('password'));
    }

    DB::table('users')->where('id', $id)->update($updateData);

    return redirect()->route('admin.petugas')->with('success', 'Data petugas berhasil diperbarui!');
})->name('admin.petugas.update');

Route::delete('/admin/petugas/{id}', function ($id) use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;
    if ($id == 1) {
        return redirect()->route('admin.petugas')->with('error', 'Akun Admin Utama tidak boleh dihapus demi keamanan sistem.');
    }

    DB::table('users')->where('id', $id)->delete();
    return redirect()->route('admin.petugas')->with('success', 'Akun petugas berhasil dihapus dari sistem.');
})->name('admin.petugas.delete');

// Data Pengguna / Buyer & Transaksi Pesertanya
Route::get('/admin/users', function () use ($ensureAdmin) {
    if ($redirect = $ensureAdmin()) return $redirect;

    $buyers = DB::table('buyers')
        ->leftJoin('orders', 'buyers.id', '=', 'orders.buyer_id')
        ->select(
            'buyers.id',
            'buyers.name',
            'buyers.email',
            'buyers.phone',
            'buyers.nik',
            'buyers.address',
            'buyers.created_at',
            DB::raw('COUNT(orders.id) as total_orders'),
            DB::raw("COALESCE(SUM(CASE WHEN orders.status = 'Pembayaran disetujui' THEN orders.total_amount ELSE 0 END), 0) as total_spent"),
            DB::raw("COUNT(CASE WHEN orders.status = 'Pembayaran disetujui' THEN 1 END) as approved_orders")
        )
        ->groupBy(
            'buyers.id',
            'buyers.name',
            'buyers.email',
            'buyers.phone',
            'buyers.nik',
            'buyers.address',
            'buyers.created_at'
        )
        ->orderBy('buyers.id', 'desc')
        ->get();

    // Ambil seluruh orders & tiket untuk relasi pop-up detail pengguna
    $buyerIds = $buyers->pluck('id')->toArray();

    $allOrders = DB::table('orders')
        ->join('ticket_types', 'orders.ticket_type_id', '=', 'ticket_types.id')
        ->whereIn('orders.buyer_id', $buyerIds)
        ->select('orders.*', 'ticket_types.name as ticket_name')
        ->orderBy('orders.id', 'desc')
        ->get()
        ->groupBy('buyer_id');

    $allTickets = DB::table('digital_tickets')
        ->join('orders', 'digital_tickets.order_id', '=', 'orders.id')
        ->join('ticket_types', 'digital_tickets.ticket_type_id', '=', 'ticket_types.id')
        ->whereIn('orders.buyer_id', $buyerIds)
        ->select('digital_tickets.*', 'orders.buyer_id', 'ticket_types.name as ticket_name')
        ->get()
        ->groupBy('buyer_id');

    return view('admin.users', compact('buyers', 'allOrders', 'allTickets'));
})->name('admin.users');
Route::get('/dashboard/users', fn() => redirect()->route('admin.users'));

// 8. API Endpoints — checkout wajib login sebagai pembeli
Route::post('/api/checkout', function (\Illuminate\Http\Request $request) {
    if (!session('buyer')) {
        return response()->json([
            'success' => false,
            'requires_login' => true,
            'message' => 'Anda harus login terlebih dahulu untuk memesan tiket.',
            'login_url' => route('buyer.login'),
        ], 401);
    }
    // Inject buyer data dari session ke request
    $buyer = session('buyer');
    $request->merge(['buyer_session_id' => $buyer['id']]);
    return app(OrderController::class)->checkout($request);
})->name('api.checkout');

Route::post('/api/orders/{id}/upload-proof', [OrderController::class, 'uploadProof'])->name('api.order.uploadProof');
Route::post('/api/orders/{id}/verify', function (\Illuminate\Http\Request $request, $id) {
    if (!Auth::check() || Auth::id() != 1) {
        return response()->json(['success' => false, 'message' => 'Akses ditolak. Anda harus login sebagai Administrator.'], 403);
    }
    return app(OrderController::class)->verifyPayment($request, $id);
})->name('api.order.verify');
Route::post('/api/orders/{id}/reject', function (\Illuminate\Http\Request $request, $id) {
    if (!Auth::check() || Auth::id() != 1) {
        return response()->json(['success' => false, 'message' => 'Akses ditolak. Anda harus login sebagai Administrator.'], 403);
    }
    return app(OrderController::class)->rejectPayment($request, $id);
})->name('api.order.reject');
Route::post('/api/scanner/validate', function (\Illuminate\Http\Request $request) {
    if (!Auth::check()) {
        return response()->json(['success' => false, 'message' => 'Akses ditolak. Sesi petugas tidak valid. Silakan login kembali.'], 401);
    }
    return app(OrderController::class)->validateTicket($request);
})->name('api.scanner.validate');

// API: cek status login pembeli (dipakai oleh JS sebelum buka modal)
Route::get('/api/buyer/status', function () {
    $buyer = session('buyer');
    return response()->json([
        'logged_in' => !is_null($buyer),
        'buyer' => $buyer,
        'login_url' => route('buyer.login'),
    ]);
})->name('api.buyer.status');

// 9. Error Pages (Adminator 4.4.0)
Route::get('/404', function () {
    return response()->view('errors.404', [], 404);
});

Route::get('/500', function () {
    return response()->view('errors.500', [], 500);
});


