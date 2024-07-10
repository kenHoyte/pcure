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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->string('asset_id');
            $table->unsignedBigInteger('initiated_by');
            $table->string('from_location')->nullable();
            $table->string('from_branch')->nullable();
            $table->string('to_location')->nullable();
            $table->string('to_branch')->nullable();
            $table->boolean('within_branch')->default(false);
            $table->boolean('between_branches')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
