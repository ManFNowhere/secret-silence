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
        Schema::create('text_objects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->tinyInteger('type')->default(0);
            $table->string('title');
            $table->text('description');
            $table->string('image');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('text_objects');
    }
};
