<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
            'user_id',
            'q_c_m_id',
            'grade',
            'isDone'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function quiz(){
        return $this->belongsTo(QCM::class, 'q_c_m_id');
    }
}
