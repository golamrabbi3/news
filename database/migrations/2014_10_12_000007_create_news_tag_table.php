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
        Schema::create('news_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('news_id');
            $table->timestamps();

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('news_id')
                ->references('id')
                ->on('news')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_tag');
    }
};
