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
        Schema::table('messages', function (Blueprint $table) {
            $table->string('media_type')->nullable();  // Lưu loại media (image/video)
            $table->string('media_path')->nullable();  // Lưu đường dẫn của media
        });
    }
    
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('media_type');
            $table->dropColumn('media_path');
        });
    }
    
};
