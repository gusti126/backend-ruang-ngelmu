<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\My_course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class myCourseController extends Controller
{

    public function index(){
        $myCourse = My_course::all();

        return response()->json([
            'status' => 'success',
            'message' => 'List data my course',
            'data' => $myCourse
        ], 200);
    }

   public function create(Request $request){
       $rules = [
        //    'course_id', 'user_id'
           'course_id' => 'required|integer',
           'user_id' => 'required|integer'
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

        $userId = $request->input('user_id');
        $user = User::find($userId);
        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'User id tidak di temukan'
            ], 404);
        }

        // return 'ok';
        // cek duplikasi data
        $isExistMyCourse =  My_course::where('course_id', '=', $courseId)
        ->where('user_id', '=', $userId)->exists();
        if($isExistMyCourse){
            return response()->json([
                'status' => 'error',
                'message' => 'User sudah mengambil course'
            ], 409);
        }

        $myCourse = My_course::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'My Course berhasil di tambahkan',
            'data' => $myCourse
        ], 200);


   }
}
