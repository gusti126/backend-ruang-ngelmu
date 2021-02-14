<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class chapterController extends Controller
{
    public function index(){
        $data = Chapter::get();

        return response()->json([
            'status' => 'success',
            'message' => 'List data chapter',
            'data' => $data
        ], 200);
    }
    public function create(Request $request){
        $rules = [
            "nama" => "required|string",
            "course_id" => "required|integer"
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
        $chapter = Chapter::create($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Chapter berhasil di daftarkan',
            'data' => $chapter
        ], 200);
    }

    public function update(Request $request, $id){
        $rules = [
            "nama" => "string",
            "course_id" => "integer"
        ];
         $data = $request->all();
         $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        // cari course id
        $courseId = $request->input('course_id');
        if($courseId){
            $course = Course::find($courseId);
            if(!$course){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Course id tidak di temukan'
                ], 404);
            }
        }

        $chapter = Chapter::find($id);
        if(!$chapter){
            return response()->json([
                'status' => 'error',
                'message' => 'chapter not found'
            ], 404);
        }

        $chapter->fill($data);
        $chapter->save();
        return response()->json([
            'status' => 'success',
            'message' => 'data berhasil di ubah',
            'data' => $chapter,
        ], 200);

    }
    public function show($id){
        $data = Chapter::whereId($id)->first();
        if(!$data){
            return response()->json([
                'status' => 'error',
                'message' => 'Chapter Tidak di Temukan'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Detail Chapter',
            'data' => $data
        ],200);
    }
    public function delete($id){
        $data = Chapter::find($id);
        if($data){
            $data->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'data berhasil di hapus'
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'id chapter tidak di temukan'
        ], 404);
    }
}
 