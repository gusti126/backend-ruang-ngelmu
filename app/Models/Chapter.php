<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];
    protected $fillable = [
        'nama', 'course_id'
    ];

    public function lessons(){
        return $this->hasMany('App\Models\Lesson')->orderBy('id', 'ASC');
    }
}
