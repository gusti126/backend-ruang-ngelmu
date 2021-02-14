<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class courseController extends Controller
{
    public function index(){
        $data = Course::get();

         return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }
    public function create(Request $request){
        $rules = [
            // 'nama', 'sertifikat', 'thumbnail', 'type', 'price', 'level', 'deskripsi', 'mentor_id'
            'nama' => 'required|string',
            'sertifikat' => 'required|boolean',
            'thumbnail' => 'string|url',
            'type' => 'required|in:free,premium',
            'price' => 'integer',
            'level' => 'required|in:all-level,beginer,intermedaite,advance',
            'mentor_id' => 'required|integer',
            'deskripsi' => 'string'
        ];
        $data = $request->all();

        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
        $mentorId = $request->input('mentor_id');
        $mentor = mentor::find($mentorId);
        if(!$mentor){
            return response()->json([
                'status' => 'error',
                'message' => 'id mentor tidak di temukan'
            ], 404);
        }
        $course = Course::create($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Course berhasil di buat',
            'data' => $course,
        ], 200);
    }

    public function update(Request $request, $id){
        $rules = [
            'nama' => 'string',
            'sertifikat' => 'boolean',
            'thumbnail' => 'string|url',
            'type' => 'in:free,premium',
            'price' => 'integer',
            'level' => 'in:all-level,beginer,intermedaite,advance',
            'mentor_id' => 'integer',
            'deskripsi' => 'string'
        ];
        $data = $request->all();
         $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
        $course = Course::find($id);
        if(!$course){
            return response()->json([
                'status' => 'error',
                'message' => 'course not found'
            ], 404);
        }
        // cari mentor berdasarkan id
        $mentorId = $request->input('mentor_id');
        if($mentorId){
            $mentor = mentor::find($mentorId);
            if(!$mentor){
                return response()->json([
                    'status' => 'error',
                    'message' => 'id mentor tidak di temukan'
                ], 404);
            }
        }
        $course->fill($data);

        $course->save();
        return response()->json([
            'status' => 'success',
            'message' => 'data berhasil di ubah',
            'data' => $course,
        ], 200);
    }

    public function show($id){
        $data = Course::whereId($id)->first();
        if(!$data){
            return response()->json([
                'status' => 'error',
                'message' => 'id Course tidak di temukan',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Course Detail',
            'data' => $data
        ]);
    }
     public function destroy($id){
        $data = Course::find($id);

        if($data){
            $data->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'data berhasil di hapus'
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'id course tidak di temukan'
        ], 404);
    }
}
