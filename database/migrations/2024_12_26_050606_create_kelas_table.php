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
    Schema::create('kelas', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kelas');
        
        // Ensure the foreign key references the correct table and column
        $table->foreignId('guru_id')
              ->nullable()
              ->constrained('guru')  // Reference the 'guru' table explicitly
              ->onDelete('set null');
        
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
