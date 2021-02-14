<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mentor extends Model
{
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];
    protected $fillable = [
        'nama', 'profile', 'email', 'profession'
    ];

    public function course(){
        return $this->hasMany( Course::class, 'mentor_id', 'id' );
    }
}
