<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function create(Request $request, $course_id){
        $data = $request->all();
        // dd($course_id, $data);
        Chapter::create($data);
        return redirect()->route('course.show', $course_id);
    }
}
