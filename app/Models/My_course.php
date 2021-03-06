<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class My_course extends Model
{
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];
    protected $fillable = [
        'course_id', 'user_id'
    ];

    public function courses(){
        return $this->belongsTo('App\Models\Course');
    }
}
