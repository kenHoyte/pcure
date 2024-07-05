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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_number');
            $table->string('name');
            $table->string('location');
            $table->string('condition');
            $table->string('remark')->nullable();
            $table->unsignedBigInteger('requester_id');
            $table->unsignedBigInteger('request_id');
            $table->boolean('dispose')->default(false);
            $table->boolean('repair')->default(false);
            $table->string('status');
            $table->timestamps();

            $table->index('id_number');
            $table->index('name');
            $table->index('requester_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
