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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade'); // UNIQUE foreign key for one-to-one relationship, CONSTRAINED for integrity check
            $table->string('address', 255);
            $table->string('vat_number', 255);
            $table->string('name',255);
            $table->string('image',255)->nullable();
            $table->text('description')->nullable();
            $table->string('logo',255)->nullable();
            $table->string('slug',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
