<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;


//INSERTAR DATOS
//CREATE
Route::post('/students', [StudentController::class, 'createStudent']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/login',function (){
    return response()->json(["error"=>"datos invalidos"]);
})->name('loginReturn');



Route::group(['middleware'=>["auth:sanctum"]], function(){
    Route::post('logout', [StudentController::class, 'logout']);
    Route::get('/students', [UserController::class, 'getAllStudents']);

});
//consulta de datos 
//READ
Route::get('/students/names/{names}', [StudentController::class, 'getByName']);
Route::get('/students/studentCode/{studentCode}', [StudentController::class, 'getByStudentCode']);
Route::get('/students/lastNames/{lastNames}', [StudentController::class, 'getByLastName']);
Route::get('/students/search/{any}', [StudentController::class, 'getByAny']);

//UPDATE
//ACTUALIZAR DATOS 
Route::post('/students/edit',[StudentController::class, 'editStudent']);

?>

