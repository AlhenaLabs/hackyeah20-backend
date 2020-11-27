<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishnetsLogsTable extends Migration
{
    public function up(): void
    {
        Schema::create('fishnets_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fishnet_id')->constrained('fishnets');
            $table->foreignId('user_id')->constrained('users');
            $table->string('type');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fishnets_logs');
    }
}
