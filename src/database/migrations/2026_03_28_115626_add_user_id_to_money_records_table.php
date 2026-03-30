<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('money_records', function (Blueprint $table) {
            if (! Schema::hasColumn('money_records', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('money_records', function (Blueprint $table) {
            if (Schema::hasColumn('money_records', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
};
