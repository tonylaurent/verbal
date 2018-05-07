<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Tag;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'summary',
        'content',
        'image',   
        'date'
    ];

    /**
     * The tags that belong to the post.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
