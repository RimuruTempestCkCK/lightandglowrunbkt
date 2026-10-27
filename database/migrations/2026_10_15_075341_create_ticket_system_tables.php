<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Events Table (Acara)
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('location');
            $table->date('event_date');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('status')->default('active'); // active, upcoming, completed
            $table->timestamps();
        });

        // 2. Ticket Types Table (Master Tiket, Harga, Kuota)
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->string('name');
            $table->string('category')->nullable(); // VIP, Reguler, Early Bird, Bundle
            $table->decimal('price', 12, 2);
            $table->integer('quota')->default(100);
            $table->integer('remaining_quota')->default(100);
            $table->text('benefits')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 3. Buyers Table (Master Data Pembeli)
        Schema::create('buyers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('nik')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });

        // 4. Orders Table (Data Pesanan & Pembayaran)
        // Status sesuai rancangan: Menunggu pembayaran, Menunggu verifikasi, Pembayaran disetujui, Pembayaran ditolak, Kedaluwarsa, Dibatalkan
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique(); // e.g., LG-88421
            $table->foreignId('buyer_id')->constrained('buyers')->onDelete('cascade');
            $table->foreignId('ticket_type_id')->constrained('ticket_types')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('total_amount', 12, 2);
            $table->string('payment_method')->default('QRIS'); // QRIS, Transfer BCA, Mandiri
            $table->string('qris_payload')->nullable();
            $table->string('payment_proof')->nullable(); // image url or path
            $table->timestamp('proof_uploaded_at')->nullable();
            $table->enum('status', [
                'Menunggu pembayaran',
                'Menunggu verifikasi',
                'Pembayaran disetujui',
                'Pembayaran ditolak',
                'Kedaluwarsa',
                'Dibatalkan'
            ])->default('Menunggu pembayaran');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // 5. Digital Tickets Table (Tiket Digital & QR Code Unik)
        // Status tiket: Aktif dan belum digunakan, Sudah digunakan, Tidak valid atau dinonaktifkan
        Schema::create('digital_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('ticket_type_id')->constrained('ticket_types')->onDelete('cascade');
            $table->string('ticket_code')->unique(); // e.g., LG-BKT-2026-99214
            $table->string('qr_token')->unique(); // Unique security token for hash
            $table->string('holder_name');
            $table->enum('status', [
                'Aktif dan belum digunakan',
                'Sudah digunakan',
                'Tidak valid atau dinonaktifkan'
            ])->default('Aktif dan belum digunakan');
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('used_at')->nullable();
            $table->timestamps();
        });

        // 6. Check-in Logs Table (Log Audit & Riwayat Check-in)
        Schema::create('check_in_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('digital_ticket_id')->constrained('digital_tickets')->onDelete('cascade');
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('staff_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('gate_location')->default('Gate 1 (Utama)');
            $table->enum('validation_status', ['success', 'rejected_used', 'rejected_invalid', 'rejected_wrong_event']);
            $table->string('notes')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamp('scanned_at');
            $table->timestamps();
        });

        // 7. Banners Table (Master Banner Hero Landing Page)
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('tag');
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->integer('order_index')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
        Schema::dropIfExists('check_in_logs');
        Schema::dropIfExists('digital_tickets');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('buyers');
        Schema::dropIfExists('ticket_types');
        Schema::dropIfExists('events');
    }
};
