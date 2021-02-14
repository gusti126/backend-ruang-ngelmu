<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\mentor;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $user = User::count();
        $mentor = mentor::count();
        $course = Course::count();
        return view('pages.admin.dashboard', [
            "user" => $user,
            "mentor" => $mentor,
            "course" => $course

        ]);
    }
}
