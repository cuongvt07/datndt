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
            $table->unsignedBigInteger('post_id'); // Bài viết liên quan
            $table->unsignedBigInteger('user_id')->nullable(); // Người bình luận (nếu là khách, có thể null)
            $table->string('name')->nullable(); // Tên người bình luận
            $table->string('email')->nullable(); // Email người bình luận
            $table->text('content'); // Nội dung bình luận
            $table->timestamps();
    
            // Khóa ngoại
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
