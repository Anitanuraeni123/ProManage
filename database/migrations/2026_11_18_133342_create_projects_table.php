<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('nama_proyek');
            $table->text('deskripsi')->nullable();
            $table->foreignId('team_id')->nullable()->constrained()->onDelete('set null');
            $table->string('github_repo')->nullable();
            $table->date('deadline')->nullable();
            $table->integer('progress')->default(0);
            $table->enum('status', ['berjalan', 'selesai', 'stagnant'])->default('berjalan');
            $table->text('catatan_evaluasi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
