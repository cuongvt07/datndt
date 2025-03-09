<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    // Định nghĩa bảng mà model này liên kết
    protected $table = 'message_media';

    // Các cột có thể gán
    protected $fillable = [
        'message_id',
        'media_path',
        'media_type',
    ];

    // Quan hệ với model Message (1 tin nhắn có nhiều media)
    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
