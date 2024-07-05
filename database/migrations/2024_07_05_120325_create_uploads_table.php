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
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('file_type');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('asset_id')->constrained()->nullable();            
            $table->foreignId('req_id')->constrained()->nullable();            
            $table->string('remark')->nullable();            
            $table->timestamps();
            
            $table->index('file_name');
            $table->index('file_type');
            $table->index('remark');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};