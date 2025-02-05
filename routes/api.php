<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\userController;


//INSERTAR DATOS
//CREATE
Route::post('/students', [StudentController::class, 'createStudent']);
Route::post('/register', [userController::class, 'register']);
Route::post('/login', [userController::class, 'login']);


Route::group(['middleware'=>["auth:sanctum"]], function(){
    Route::post('logout', [StudentController::class, 'logout']);
    Route::get('/students', [userController::class, 'getAllStudents']);

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

