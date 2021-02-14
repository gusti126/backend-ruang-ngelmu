<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        // 'nama', 'video', 'chapter_id'
        dd($data);


    }
}
