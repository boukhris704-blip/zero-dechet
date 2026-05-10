<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('scanner_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('clients')->onDelete('cascade');
            $table->string('token', 64)->unique();
            $table->string('code_barre')->nullable();
            $table->boolean('consomme')->default(false);
            $table->timestamp('expires_at');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('scanner_sessions'); }
};
