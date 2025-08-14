<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('section');
            $table->integer('parent')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
