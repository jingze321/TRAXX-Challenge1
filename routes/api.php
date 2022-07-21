<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users',[UserController::class,'store']);
Route::prefix('/users')->group(function(){
    Route::post('/store',[UserController::class,'store']);
    Route::get('/{id}',[UserController::class,'check']);
});

Route::post('/store', function (Request $request) {

    session()->put('userData',  $request->all());
    return session('userData');
    
});

Route::get('/get-user-data', function (Request $request) {

    $value = session('userData');
    return response()->json($value);
});

Route::post('/save', function (Request $request) {
    // $data = json_decode($request->all());
    $data = $request->all();
    $add = DB::table('users_details')->insert([
        'first_name' =>$data['name']['firstName'],
        'last_name' =>$data['name']['lastName'],
        'dial_code' =>$data['phone']['dialCode'],
        'phone_number' =>$data['phone']['phoneNumber'],
        'email' =>$data['email'],
        'url' =>$data['urlLink'],

    ]);
    if ($add) {
        session()->forget('userData');
        return "Data Save Successfully" ;
    }
    else{
        return "Something went wrong";
    }
});