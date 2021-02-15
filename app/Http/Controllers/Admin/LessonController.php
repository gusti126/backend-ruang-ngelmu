<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function store(Request $request, $id){
        $data = $request->all();
        // 'nama', 'video', 'chapter_id'
        // dd($id);
        parse_str( parse_url( $data['video'], PHP_URL_QUERY ), $my_array_of_vars );
        $data['video'] = $my_array_of_vars['v'];
        // dd($data);

        Lesson::create($data);

        return redirect()->route('course.show', $id);

    }
    public function edit($course_id, $id)
    {
        $item = Lesson::findOrFail($id);
        // dd($item);

        return view('pages.admin.lesson.edit', [
            'item' => $item,
            'course_id' =>$course_id
        ]);
    }
    public function update(Request $request, $course_id, $id){
        $item  = Lesson::findOrFail($id);
        $data = $request->all();
        // dd($data, $course_id);
        $item->update($data);
        return redirect()->route('course.show', $course_id);
    }
    public function destroy($course_id, $id){
        // dd($course_id);
       $data = Lesson::FindOrFail($id);
       $data->delete();
        return redirect()->route('course.show', $course_id);

    }
}
