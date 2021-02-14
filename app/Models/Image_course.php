<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image_course extends Model
{
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];
    protected $fillable = [
        'course_id', 'image'
    ];
}
