<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('participations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('defi_id')->constrained('defis')->onDelete('cascade');
            $table->boolean('complete')->default(false);
            $table->timestamps();
            $table->unique(['utilisateur_id','defi_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('participations'); }
};
