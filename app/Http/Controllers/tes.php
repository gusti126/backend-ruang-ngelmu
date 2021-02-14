<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tes extends Controller
{
    public function index(){
        $url = 'https://www.youtube.com/watch?v=NgYhT6LzFn8';
        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
        // dd( $my_array_of_vars['v']);
        return view('tes',[
            'url' => $my_array_of_vars['v']
        ]);
    }
}
