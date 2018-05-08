<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Tag;

use Carbon\Carbon;

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
        'datetime'
    ];

    /**
     * The tags that belong to the post.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
        
    /**
     * Set the post’s datetime.
     *
     * @param null|string $value The datetime value.
     * 
     * @return void
     */    
    public function setDatetimeAttribute(string $value = null): void
    {
        $now = Carbon::now()->toDateTimeString();
        
        $this->attributes['datetime'] = $value ?: $now;
    }
}
