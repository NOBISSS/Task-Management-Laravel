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
        Schema::create('taskms', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->string('priority',15)->default('medium');
            $table->text('description',255);
            $table->string('status',15)->default('pending');
            $table->foreign('user_id')->references('id')->on('userms');
            $table->boolean('isactive')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taskms');
    }
};
