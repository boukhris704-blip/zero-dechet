<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->string('codeBarres')->primary();
            $table->string('nom');
            $table->string('marque')->nullable();
            $table->string('categorie');
            $table->integer('score_eco');
            $table->decimal('co2_kg', 8, 3);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('produits'); }
};
