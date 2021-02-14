<?php

namespace App\Http\Controllers\api\imageCourse;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Image_course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class imageCourseController extends Controller
{
    public function index(){
        $data = Image_course::get();

        return response()->json([
            'status' => 'success',
            'message' => 'list data image course',
            'data' => $data
        ], 200);
    }
    public function create(Request $request){
        $rules = [
            'image' => 'required|url',
            'course_id' => 'required|integer'
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
        $courseId = $request->input('course_id');
        $course = Course::find($courseId);
        if(!$course){
             return response()->json([
                'status' => 'error',
                'message' => 'Course id tidak di temukan'
            ], 404);
        }
        $imageCourse = Image_course::create($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Image corse berhasil di daftarkan',
            'data' => $imageCourse
        ], 200);
    }

    public function show($id){
        $data = Image_course::whereId($id)->first();
        if(!$data){
            return response()->json([
                'status' => 'error',
                'message' => 'image course Tidak di Temukan'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Detail Image Course',
            'data' => $data
        ],200);
    }

    public function destroy($id){
        $data = Image_course::find($id);
        if($data){
            $data->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'data berhasil di hapus'
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'id image course tidak di temukan'
        ], 404);
    }

}
