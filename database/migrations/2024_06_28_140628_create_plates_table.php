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
        Schema::create('plates', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->text('description')->nullable();
            $table->tinyInteger('visibility')->default(1);
            $table->decimal('price', 6, 2)->unsigned();
            $table->string('image')->nullable();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plates');
    }
};
