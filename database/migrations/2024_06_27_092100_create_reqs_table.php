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
        Schema::create('reqs', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->string('remark_1')->nullable();
            $table->string('remark_2')->nullable();
            $table->string('remark_3')->nullable();
            $table->unsignedBigInteger('requester_id')->nullable();
            $table->unsignedBigInteger('approver_id')->nullable();
            $table->unsignedBigInteger('authorizer_id')->nullable();
            $table->boolean('approved')->default(false);
            $table->boolean('authorized')->default(false);
            $table->string('location')->nullable();
            $table->timestamps();

            $table->index('item');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reqs');
    }
};
