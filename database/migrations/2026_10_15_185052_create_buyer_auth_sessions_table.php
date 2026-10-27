<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom password ke tabel buyers agar bisa login.
     */
    public function up(): void
    {
        Schema::table('buyers', function (Blueprint $table) {
            if (!Schema::hasColumn('buyers', 'password')) {
                $table->string('password')->nullable()->after('email');
            }
            if (!Schema::hasColumn('buyers', 'remember_token')) {
                $table->rememberToken()->after('password');
            }
        });
    }

    public function down(): void
    {
        Schema::table('buyers', function (Blueprint $table) {
            $table->dropColumn(['password', 'remember_token']);
        });
    }
};
