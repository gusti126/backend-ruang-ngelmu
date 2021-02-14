<?php

namespace App\Models;

use App\Kategori;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];

    protected $fillable = [
        'nama', 'sertifikat', 'thumbnail', 'type', 'price', 'level', 'deskripsi', 'mentor_id', 'kategori_id'
    ];
    // protected $primaryKey = 'kategori_id';

    public function mentor(){
        return $this->belongsTo('App\Models\mentor');
    }
    public function kategori(){
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
    public function chapters(){
        return $this->hasMany('App\Models\Chapter')->orderBy('id', 'ASC');
    }

    public function images(){
        return $this->hasMany('App\Models\Image_course')->orderBy('id', 'DESC');
    }
}

