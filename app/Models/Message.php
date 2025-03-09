<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = ['user_id', 'session_id', 'message', 'from_admin'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
    public function media()
    {
        return $this->hasMany(Media::class);
    }
    
}
