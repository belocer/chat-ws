<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';
    protected $guarded = false;

    public function getTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getIsOwnerAttribute()
    {
        return (int) $this->user_id === (int) Auth::id();
    }

        public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
