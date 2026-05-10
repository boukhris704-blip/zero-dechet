<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('alternatives', function (Blueprint $table) {
            $table->id();
            $table->string('produit_id');
            $table->foreign('produit_id')->references('codeBarres')->on('produits')->onDelete('cascade');
            $table->string('nom');
            $table->string('marque')->nullable();
            $table->integer('score_eco');
            $table->string('lien')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('alternatives'); }
};
