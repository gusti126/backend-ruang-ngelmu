<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class lessonController extends Controller
{
    public function index(){
        $data = Lesson::get();

        return response()->json([
            'status' => 'success',
            'message' => 'list data lessons',
            'data' => $data
        ], 200);
    }

    public function create(Request $request){
        $rules = [
            // 'nama', 'video', 'chapter_id'
            "nama" => "required|string",
            "video" => "required|string",
            "chapter_id" => "required|integer"
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
        // cek chapter
        $chapterId = $request->input('chapter_id');
        $chapter = Chapter::find($chapterId);
        if(!$chapter){
             return response()->json([
                'status' => 'error',
                'message' => 'Chapter id tidak di temukan'
            ], 404);
        }
        $videoId = $request->input('video');
        // mengambil link id youtube
        parse_str( parse_url( $videoId, PHP_URL_QUERY ), $my_array_of_vars );
        $data['video'] = $my_array_of_vars['v'];
        // $lesson = Lesson::create([
        //     'nama' => $request->input('nama'),
        //     'video' => $my_array_of_vars['v'],
        //     'chapter_id' => $request->chapter_id
        // ]);
        $lesson = Lesson::create($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Lesson berhasil di daftarkan',
            'data' => $lesson
        ], 200);

    }

    public function update(Request $request, $id){
        $rules = [
            // 'nama', 'video', 'chapter_id'
            "nama" => "string",
            "video" => "string",
            "chapter_id" => "integer"
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
        // cek chapter
        $chapterId = $request->input('chapter_id');
        if($chapterId){
            $chapter = Chapter::find($chapterId);
            if(!$chapter){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Chapter id tidak di temukan'
                ], 404);
            }
        }
        // cek lesson id
        $lesson = Lesson::find($id);
        if(!$lesson){
            return  response()->json([
                'status' => 'error',
                'message' => 'lesson Tidak di Temukan'
            ], 404);
        }
        $videoId = $request->input('video');
        if($videoId){
            // mengambil link id youtube
            parse_str( parse_url( $videoId, PHP_URL_QUERY ), $my_array_of_vars );
            $data['video'] = $my_array_of_vars['v'];
        }
        // update lesson
        $lesson->fill($data);
        $lesson->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Lesson berhasil di update',
            'data' => $lesson
        ], 200);

    }
    public function show($id){
        $data = Lesson::whereId($id)->first();
        if(!$data){
            return response()->json([
                'status' => 'error',
                'message' => 'Lesson Tidak di Temukan'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Detail Lesson',
            'data' => $data
        ],200);
    }
    public function destroy($id){
        $data = Lesson::find($id);
        if($data){
            $data->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'data berhasil di hapus'
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'id lesson tidak di temukan'
        ], 404);
    }
}
