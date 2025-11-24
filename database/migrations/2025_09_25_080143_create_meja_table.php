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
        Schema::create('meja', function (Blueprint $table) {
            $table->id();

            $table->string('nama_meja');
            $table->string('username')->nullable();
            $table->string('password');
            $table->string('url')->nullable();
            $table->enum('status', ['kosong', 'terisi'])->default('kosong');

            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');

            $table->enum('request', ['nothing', 'request'])->default('nothing');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meja');
    }
};
