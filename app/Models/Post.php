<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'location',
        'category',
        'author',
        'parent_id',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    public function comments()
    {
        return $this->hasMany(Post::class, 'parent_id')->with(['user'])->select('description', 'created_at', 'id', 'parent_id', 'author');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author')->select('name', 'id');
    }

}