<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('user_badges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('badge_id')->constrained('badges')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['utilisateur_id','badge_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('user_badges'); }
};
