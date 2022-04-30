<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'synopsis', 'release_year', 'image', 'genre_id'];


    public function Genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function Comment()
    {
        return $this->hasMany(Comment::class);
    }
}
