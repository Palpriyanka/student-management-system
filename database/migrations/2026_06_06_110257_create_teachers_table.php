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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 15)->nullable();

            $table->string('qualification')->nullable();
            $table->string('specialization')->nullable();

            $table->integer('experience')->nullable(); // years

            $table->date('joining_date')->nullable();

            $table->enum('gender', ['Male', 'Female', 'Other']);

            $table->string('photo')->nullable();

            $table->text('address')->nullable();

            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
