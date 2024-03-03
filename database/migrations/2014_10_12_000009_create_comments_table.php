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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('detail');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('news_id');
            $table->unsignedBigInteger('comment_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('news_id')
                ->references('id')
                ->on('news')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('comment_id')
                ->references('id')
                ->on('comments')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
