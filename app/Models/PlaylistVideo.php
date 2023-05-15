<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistVideo extends Model
{
    use HasFactory;
    protected $fillable = [
        'playlist_id','video_id'
    ];
    public function video() {
        return $this->hasOne(Video::class, 'id', 'video_id');
    }
}
