<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'path','user_id','description','preview','views',
    ];
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
