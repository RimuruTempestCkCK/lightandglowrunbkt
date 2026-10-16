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
        Schema::table('events', function (Blueprint $table) {
            $table->string('qris_image')->nullable()->after('banner_image');
            $table->string('qris_merchant_name')->default('LIGHT AND GLOW BUKITTINGGI')->after('qris_image');
            $table->string('qris_nmid')->nullable()->after('qris_merchant_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['qris_image', 'qris_merchant_name', 'qris_nmid']);
        });
    }
};
