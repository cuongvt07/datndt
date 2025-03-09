<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('message_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained('messages')->onDelete('cascade'); // Liên kết với bảng messages
            $table->string('media_path');
            $table->string('media_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('message_media');
    }
};
