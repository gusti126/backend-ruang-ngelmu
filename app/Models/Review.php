<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];
    protected $fillable = [
        'user_id', 'course_id', 'rating', 'note'
    ];

    public function courses(){
        return $this->belongsTo('App\Models\Course');
    }
}
