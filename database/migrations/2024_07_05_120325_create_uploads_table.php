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
            $table->string('file_path');
            $table->string('file_type')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('asset_id')->nullable()->constrained();            
            $table->foreignId('req_id')->nullable()->constrained();            
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