<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'description',
        'status',
        'createdOn'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
