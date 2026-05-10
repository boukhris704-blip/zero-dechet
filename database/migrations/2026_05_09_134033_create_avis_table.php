<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('avis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('clients')->onDelete('cascade');
            $table->integer('note');
            $table->text('commentaire');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('avis');
    }
};
