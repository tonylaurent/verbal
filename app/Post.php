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
        'content',
        'image_path'
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The tags that belong to the post.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get all of the post's comments.
     */
    public function activities()
    {
        return $this->morphMany('App\Activity', 'activity');
    }
}
