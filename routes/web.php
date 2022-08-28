<?php

use App\Http\Controllers\PrintFormController;
use App\Http\Controllers\RegisterCompany;
use App\Http\Controllers\UsersController;
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

    return redirect()->route("web.login");
});
Route::get('/home', function () {

    return redirect()->route("web.company.create");
});


Route::get("/login",[UsersController::class,"login"])->name("web.login");
Route::post("/login/post",[UsersController::class,"postLogin"])->name("web.login.post");
Route::get("/form/create",[RegisterCompany::class,"create"])->name("web.company.create")->middleware("auth");
//print form
Route::get("/form/{id}/print",[PrintFormController::class,"print"])->name("web.form.print")->middleware("auth");

Route::get("/camera",function (){
    return view("camera");
});

Route::get("/qrcode",function (){
    return QrCode::size(300)->generate('test body');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
