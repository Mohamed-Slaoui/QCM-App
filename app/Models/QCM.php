<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QCM extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_name'
    ];
    public function questions(){
        return $this->belongsToMany(Question::class);
    }
}
