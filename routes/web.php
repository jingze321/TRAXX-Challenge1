<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $userData = session('userData');
    return view('inputUserPage',[ "userData" => json_encode($userData )]);
    
});

Route::get('/view', function () {
    $userData = session('userData');
    if(!empty($userData)){
        return view('viewInput',[ "userData" => json_encode($userData )]);
    }else{
        return redirect('/');

        // return view('inputUserPage',[ "userData" => json_encode($userData )]);
    }
});

Route::get('/sessions', function () {
    // $data = ['name'=>"John Wick"];
    $value = session('userData');
    return response()->json($value);
});
Route::get('/users', function () {
    return view('users',
        [
            'title' => "Page 2 - A little about the Author",
            'author' => json_encode([
                    "name" => "Fisayo Afolayan",
                    "role" => "Software Enginner",
                    "code" => "Always keeping it clean"
            ])
        ]
    );
});
