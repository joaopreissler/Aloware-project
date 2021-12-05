<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments_replies extends Model
{
    use HasFactory;
    
    protected $table = 'Comments_replies';
    public function Comment()
    {
        return $this->belongsTo(Comments::class);
    }
    public function NestedReplies()
    {
        return $this->belongsToMany(nested_replies::class, 'nested_replies_conn','reply_id', 'id' );
    }
}
