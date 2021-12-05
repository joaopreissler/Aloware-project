<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public function commentable()
    {
        return $this->morphTo();
    }
    use HasFactory;
    protected $table = 'Comments';

    protected $fillable = [
        'name',
        'content',
        
    ];

    public function Replies()
    {
        
        return $this->belongsToMany(Comments_Replies::class, 'comments_replies_conn','comment_id', 'id');
    }

    
}
