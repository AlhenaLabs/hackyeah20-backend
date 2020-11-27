<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishnetsTable extends Migration
{
    public function up(): void
    {
        Schema::create('fishnets', function (Blueprint $table) {
            $table->id();
            $table->string('rfid');
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('customer_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('state')->default('new');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fishnets');
    }
}
