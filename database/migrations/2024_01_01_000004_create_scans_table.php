<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('scans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('clients')->onDelete('cascade');
            $table->string('produit_id');
            $table->foreign('produit_id')->references('codeBarres')->on('produits');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('scans'); }
};
