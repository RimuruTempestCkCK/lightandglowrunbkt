<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes - Light And Glow Bukittinggi
|--------------------------------------------------------------------------
*/

// 1. Landing Page (Folder template)
Route::get('/', function () {
    $event = DB::table('events')->first();
    $tickets = DB::table('ticket_types')->where('is_active', true)->get();
    return view('welcome', compact('event', 'tickets'));
})->name('home');

// 1.1 Dashboard Pembeli (Template Goers: Riwayat Pembelian & Tiket Transaksi)
Route::get('/tiket-saya', function () {
    $orders = DB::table('orders')
        ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
        ->join('ticket_types', 'orders.ticket_type_id', '=', 'ticket_types.id')
        ->select('orders.*', 'buyers.name as buyer_name', 'buyers.email as buyer_email', 'buyers.phone as buyer_phone', 'ticket_types.name as ticket_name', 'ticket_types.category as ticket_category', 'ticket_types.image as ticket_image')
        ->orderBy('orders.id', 'desc')
        ->get();

    $digitalTickets = DB::table('digital_tickets')
        ->join('orders', 'digital_tickets.order_id', '=', 'orders.id')
        ->join('ticket_types', 'digital_tickets.ticket_type_id', '=', 'ticket_types.id')
        ->select('digital_tickets.*', 'ticket_types.name as ticket_name', 'orders.order_number')
        ->get();

    return view('buyer.dashboard', compact('orders', 'digitalTickets'));
})->name('buyer.dashboard');

// 2. Autentikasi (Adminator 4.4.0)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// 3. Dashboard Admin Utama (Adminator 4.4.0)
Route::get('/dashboard', function () {
    $pendingCount = DB::table('orders')->where('status', 'Menunggu verifikasi')->count();
    $approvedCount = DB::table('orders')->where('status', 'Pembayaran disetujui')->count();
    $rejectedCount = DB::table('orders')->where('status', 'Pembayaran ditolak')->count();
    $checkInCount = DB::table('check_in_logs')->where('validation_status', 'success')->count();
    $recentOrders = DB::table('orders')
        ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
        ->join('ticket_types', 'orders.ticket_type_id', '=', 'ticket_types.id')
        ->select('orders.*', 'buyers.name as buyer_name', 'ticket_types.name as ticket_name')
        ->orderBy('orders.id', 'desc')
        ->limit(7)
        ->get();

    return view('dashboard', compact('pendingCount', 'approvedCount', 'rejectedCount', 'checkInCount', 'recentOrders'));
})->name('dashboard');

// 4. CMS & Master Data
Route::get('/dashboard/cms', function () {
    return view('admin.cms');
})->name('admin.cms');

Route::get('/dashboard/tiket', function () {
    $tickets = DB::table('ticket_types')->get();
    return view('admin.tiket', compact('tickets'));
})->name('admin.tiket');

Route::get('/dashboard/banner', function () {
    $banners = DB::table('banners')->get();
    return view('admin.banner', compact('banners'));
})->name('admin.banner');

Route::get('/dashboard/acara', function () {
    $event = DB::table('events')->first();
    return view('admin.acara', compact('event'));
})->name('admin.acara');

// 5. Verifikasi Pembayaran (Berdasarkan rancangan web.txt)
Route::get('/dashboard/verifikasi', function () {
    $pendingOrders = DB::table('orders')
        ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
        ->join('ticket_types', 'orders.ticket_type_id', '=', 'ticket_types.id')
        ->select('orders.*', 'buyers.name as buyer_name', 'buyers.email as buyer_email', 'buyers.phone as buyer_phone', 'ticket_types.name as ticket_name')
        ->where('orders.status', 'Menunggu verifikasi')
        ->orderBy('orders.id', 'desc')
        ->get();

    return view('admin.verifikasi', compact('pendingOrders'));
})->name('admin.verifikasi');

// 6. Scanner QR Code Petugas Check-in (Berdasarkan rancangan web.txt)
Route::get('/dashboard/scanner', function () {
    $event = DB::table('events')->first();
    return view('admin.scanner', compact('event'));
})->name('admin.scanner');

// 7. Data Pesanan, Kehadiran, & Petugas
Route::get('/dashboard/pesanan', function () {
    $orders = DB::table('orders')
        ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
        ->join('ticket_types', 'orders.ticket_type_id', '=', 'ticket_types.id')
        ->select('orders.*', 'buyers.name as buyer_name', 'buyers.email as buyer_email', 'buyers.phone as buyer_phone', 'buyers.nik as buyer_nik', 'ticket_types.name as ticket_name')
        ->orderBy('orders.id', 'desc')
        ->get();

    return view('admin.pesanan', compact('orders'));
})->name('admin.pesanan');

Route::get('/dashboard/kehadiran', function () {
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

Route::get('/dashboard/petugas', function () {
    $staff = DB::table('users')->get();
    return view('admin.petugas', compact('staff'));
})->name('admin.petugas');

// 8. API Endpoints untuk Alur Rancangan Web Tiket & Scanner
Route::post('/api/checkout', [OrderController::class, 'checkout'])->name('api.checkout');
Route::post('/api/orders/{id}/upload-proof', [OrderController::class, 'uploadProof'])->name('api.order.uploadProof');
Route::post('/api/orders/{id}/verify', [OrderController::class, 'verifyPayment'])->name('api.order.verify');
Route::post('/api/orders/{id}/reject', [OrderController::class, 'rejectPayment'])->name('api.order.reject');
Route::post('/api/scanner/validate', [OrderController::class, 'validateTicket'])->name('api.scanner.validate');

// 9. Error Pages (Adminator 4.4.0)
Route::get('/404', function () {
    return response()->view('errors.404', [], 404);
});

Route::get('/500', function () {
    return response()->view('errors.500', [], 500);
});
