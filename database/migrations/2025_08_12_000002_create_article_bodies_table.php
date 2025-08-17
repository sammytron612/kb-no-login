<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('article_bodies', function (Blueprint $table) {
            $table->unsignedBigInteger('article_id');
            $table->longText('body');
            $table->fullText('body');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_bodies');
    }
};
