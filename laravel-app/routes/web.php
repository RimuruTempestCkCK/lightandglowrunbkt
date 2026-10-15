<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
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
    $buyer = session('buyer');
    return view('welcome', compact('event', 'tickets', 'buyer'));
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
        ->select('orders.*', 'buyers.name as buyer_name', 'buyers.email as buyer_email', 'buyers.phone as buyer_phone', 'ticket_types.name as ticket_name', 'ticket_types.category as ticket_category', 'ticket_types.image as ticket_image')
        ->where('orders.buyer_id', $buyer['id'])
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

// 2. Autentikasi Admin (Adminator 4.4.0)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// 3. Dashboard Admin Utama (Adminator 4.4.0)
$adminDashboardHandler = function () {
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

// 3b. Dashboard Petugas Scanner (Check-in & Gate)
$petugasDashboardHandler = function () {
    $event = DB::table('events')->first();
    $todayCheckIns = DB::table('check_in_logs')->where('validation_status', 'success')->count();
    $recentLogs = DB::table('check_in_logs')
        ->join('digital_tickets', 'check_in_logs.digital_ticket_id', '=', 'digital_tickets.id')
        ->select('check_in_logs.*', 'digital_tickets.holder_name', 'digital_tickets.ticket_code')
        ->orderBy('check_in_logs.id', 'desc')
        ->limit(5)
        ->get();
    return view('petugas.dashboard', compact('event', 'todayCheckIns', 'recentLogs'));
};

Route::get('/petugas/dashboard', $petugasDashboardHandler)->name('petugas.dashboard');

// 4. CMS & Master Data
Route::get('/admin/cms', function () {
    return view('admin.cms');
})->name('admin.cms');
Route::get('/dashboard/cms', fn() => redirect()->route('admin.cms'));

Route::get('/admin/tiket', function () {
    $tickets = DB::table('ticket_types')->get();
    return view('admin.tiket', compact('tickets'));
})->name('admin.tiket');
Route::get('/dashboard/tiket', fn() => redirect()->route('admin.tiket'));

Route::get('/admin/banner', function () {
    $banners = DB::table('banners')->get();
    return view('admin.banner', compact('banners'));
})->name('admin.banner');
Route::get('/dashboard/banner', fn() => redirect()->route('admin.banner'));

Route::get('/admin/acara', function () {
    $event = DB::table('events')->first();
    return view('admin.acara', compact('event'));
})->name('admin.acara');
Route::get('/dashboard/acara', fn() => redirect()->route('admin.acara'));

// 5. Verifikasi Pembayaran (Berdasarkan rancangan web.txt)
Route::get('/admin/verifikasi', function () {
    $pendingOrders = DB::table('orders')
        ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
        ->join('ticket_types', 'orders.ticket_type_id', '=', 'ticket_types.id')
        ->select('orders.*', 'buyers.name as buyer_name', 'buyers.email as buyer_email', 'buyers.phone as buyer_phone', 'ticket_types.name as ticket_name')
        ->where('orders.status', 'Menunggu verifikasi')
        ->orderBy('orders.id', 'desc')
        ->get();

    return view('admin.verifikasi', compact('pendingOrders'));
})->name('admin.verifikasi');
Route::get('/dashboard/verifikasi', fn() => redirect()->route('admin.verifikasi'));

// 6. Scanner QR Code Petugas Check-in (Berdasarkan rancangan web.txt)
Route::get('/admin/scanner', function () {
    return redirect()->route('petugas.dashboard');
})->name('admin.scanner');
Route::get('/dashboard/scanner', fn() => redirect()->route('petugas.dashboard'));

// 7. Data Pesanan, Kehadiran, & Petugas
Route::get('/admin/pesanan', function () {
    $orders = DB::table('orders')
        ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
        ->join('ticket_types', 'orders.ticket_type_id', '=', 'ticket_types.id')
        ->select('orders.*', 'buyers.name as buyer_name', 'buyers.email as buyer_email', 'buyers.phone as buyer_phone', 'buyers.nik as buyer_nik', 'ticket_types.name as ticket_name')
        ->orderBy('orders.id', 'desc')
        ->get();

    return view('admin.pesanan', compact('orders'));
})->name('admin.pesanan');
Route::get('/dashboard/pesanan', fn() => redirect()->route('admin.pesanan'));

Route::get('/admin/kehadiran', function () {
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

Route::get('/admin/petugas', function () {
    $staff = DB::table('users')->get();
    return view('admin.petugas', compact('staff'));
})->name('admin.petugas');
Route::get('/dashboard/petugas', fn() => redirect()->route('admin.petugas'));

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
Route::post('/api/orders/{id}/verify', [OrderController::class, 'verifyPayment'])->name('api.order.verify');
Route::post('/api/orders/{id}/reject', [OrderController::class, 'rejectPayment'])->name('api.order.reject');
Route::post('/api/scanner/validate', [OrderController::class, 'validateTicket'])->name('api.scanner.validate');

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


