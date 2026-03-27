<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('money_records', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('amount');
            $table->date('record_date');
            $table->text('note')->nullable();
            $table->boolean('is_received')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('money_records');
    }
};
