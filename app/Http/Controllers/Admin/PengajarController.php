<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\mentor;
use Illuminate\Http\Request;

class PengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jMentor = mentor::count();
        $mentor = mentor::get()->all();

        return view('pages.admin.mentor.index', [
            'jMentor' => $jMentor,
            'mentor' => $mentor
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.mentor.create');
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
            'profile' => 'required|image',
            'email' => 'email|required|unique:mentors',
            'profession' => 'required|string',
        ]);

        $data = $request->all();
        $data['profile'] = $request->file('profile')->store(
            'assets/image/mentor', 'public'
        );

        mentor::create($data);
        return redirect()->route('pengajar.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = mentor::with('course')->findOrFail($id);
        // dd($item);
        return view('pages.admin.mentor.detail', [
            'item' => $item
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
        $item = mentor::findOrFail($id);
        // dd($item->profile);
        return view('pages.admin.mentor.edite',[
            'item' => $item
        ]);
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
        $request->validate([
            'nama' => 'required|string',
            'profile' => 'image|image',
            'email' => 'email|required',
            'profession' => 'required|string',
        ]);
        $data = $request->all();
        $data['profile'] = $request->file('profile')->store(
            'assets/image/mentor', 'public'
        );
        $mentor = mentor::findOrFail($id);

        $mentor->update($data);
        return redirect()->route('pengajar.index');
        
        // dd($mentor['profile']->public);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = mentor::findOrFail($id);
        $item->delete();

        return redirect()->route('pengajar.index');

    }
}
