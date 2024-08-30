<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ["title", "description", "image", "creator_id"];
    function user()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    // function creator()
    // {
    //     return $this->belongsTo(Creator::class);
    // }

}
