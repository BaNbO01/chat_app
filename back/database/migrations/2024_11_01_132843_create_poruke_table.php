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
        Schema::create('poruke', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posiljalac_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('primalac_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('grupa_id')->nullable()->constrained('grupe')->onDelete('cascade'); 
            $table->text('sadrzaj'); 
            $table->enum('tip', ['tekst', 'slika', 'audio'])->default('tekst'); 
            $table->timestamp('vreme_slanja')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poruke');
    }
};
