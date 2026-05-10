<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('statistiques_eco', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('clients')->onDelete('cascade');
            $table->integer('annee');
            $table->integer('mois');
            $table->integer('nb_scans')->default(0);
            $table->decimal('co2_economise', 8, 2)->default(0);
            $table->integer('score_moyen')->default(0);
            $table->unique(['utilisateur_id','annee','mois']);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('statistiques_eco'); }
};
