<?php

namespace App\Http\Controllers;

use App\Models\mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class mentorController extends Controller
{
    public function index(){
        $data = mentor::get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }
    public function creat(Request $request){
        $rules = [
            'nama' => 'required|string',
            'profile' => 'required|url',
            'profession' => 'required|string',
            'email' => 'required|email'
        ];
        $data = $request->all();

        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
        $mentor = mentor::create($data);
        return response()->json([
            'status' => 'success',
            'message' => 'data berhasil di simpan',
            'data' => $mentor,
        ], 200);
    }

    public function update(Request $request, $id){
        $rules = [
            'nama' => 'string',
            'profile' => 'url',
            'profession' => 'string',
            'email' => 'email'
        ];
        $data = $request->all();
         $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
        $mentor = mentor::find($id);
        if(!$mentor){
            return response()->json([
                'status' => 'error',
                'message' => 'mentor not found'
            ], 404);
        }

        $mentor->fill($data);

        $mentor->save();
        return response()->json([
            'status' => 'success',
            'message' => 'data berhasil di ubah',
            'data' => $mentor,
        ], 200);

    }

    public function show($id){
        $data = mentor::whereId($id)->first();
        if(!$data){
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Mentor Detail',
            'data' => $data
        ]);
    }
    public function destroy($id){
        $mentor = mentor::find($id);

        if($mentor){
            $mentor->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'data berhasil di hapus'
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'data mentor tidak di temukan'
        ], 404);
    }
    
}
