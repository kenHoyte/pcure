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
            $table->string('location')->nullable();
            $table->string('branch')->nullable();
            $table->unsignedBigInteger('requester_id')->nullable();
            $table->string('req_remark')->nullable();
            $table->boolean('approved')->default(false);
            $table->unsignedBigInteger('approver_id')->nullable();
            $table->string('appr_remark')->nullable();
            $table->boolean('authorized')->default(false);
            $table->unsignedBigInteger('authorizer_id')->nullable();
            $table->string('auth_remark')->nullable();
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
