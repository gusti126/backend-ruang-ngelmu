<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kategori;
use App\Models\Course;
use App\Models\mentor;
use App\Models\My_course;
use App\Models\Review;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::get();
        $course = Course::with([
            'kategori', 'mentor'
            ])->get();
        $jCourse = Course::count();
        // dd($course);
        return view('pages.admin.course.index',[
            'kategori' => $kategori,
            'course' => $course,
            'jCourse' => $jCourse
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mentor = mentor::get();
        $kategori = Kategori::get();
        return view('pages.admin.course.create', [
            'mentor' => $mentor,
            'kategori' => $kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'sertifikat' => 'required',
            'thumbnail' => 'required|image',
            'type' => 'required|in:free,premium',
            'level' => 'required|in:all-level,beginer,intermedaite,advance',
            'mentor_id' => 'required|integer',
            'deskripsi' => 'string'
        ]);
        $data = $request->all();
        $data['thumbnail'] = $request->file('thumbnail')->store(
            'assets/image/thumbnail course', 'public'
        );
        // dd($data);
        Course::create($data);
        return redirect()->route('course.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Course::with([
            'chapters.lessons', 'mentor'
            ])->findOrFail($id);
        $review = Review::where('course_id', $id)->get()->toArray();
        $totalStudent = My_course::where('course_id', '=', $id)->count();
        $data['reviews'] = $review;
        $data['total_student'] = $totalStudent;

        // dd($data);
        return view('pages.admin.course.detail', [
            'data' => $data,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}


// https://www.youtube.com/watch?v=n_szaZBDvQ4
// https://www.youtube.com/watch?v=RiNete2CSHc