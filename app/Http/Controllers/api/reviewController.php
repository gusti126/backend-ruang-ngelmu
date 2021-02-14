<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class reviewController extends Controller
{
    public function create(Request $request){
         $rules = [
        //    'user_id', 'course_id', 'rating', 'note'
           'course_id' => 'required|integer',
           'user_id' => 'required|integer',
           'rating' => 'integer|min:1|max:5',
           'note' => 'string',
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

        $isExistMyReview =  Review::where('course_id', '=', $courseId)
        ->where('user_id', '=', $userId)->exists();
        if($isExistMyReview){
            return response()->json([
                'status' => 'error',
                'message' => 'Ulasan User sudah dilakukan'
            ], 409);
        }

        $myReview = Review::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'review berhasil di daftarkan',
            'data' => $myReview
        ], 200);
    }
}
