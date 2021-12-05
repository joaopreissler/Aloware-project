<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nested_replies extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'content',
        
    ];
    public function Reply()
    {
        return $this->belongsTo(Comments_Replies::class );
    }
}
