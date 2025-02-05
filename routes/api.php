<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;


//INSERTAR DATOS
//CREATE
Route::post('/students', [StudentController::class, 'createStudent']);


//consulta de datos 
//READ
Route::get('/students', [StudentController::class, 'getAll']);
Route::get('/students/names/{names}', [StudentController::class, 'getByName']);
Route::get('/students/studentCode/{studentCode}', [StudentController::class, 'getByStudentCode']);
Route::get('/students/lastNames/{lastNames}', [StudentController::class, 'getByLastName']);
Route::get('/students/search/{any}', [StudentController::class, 'getByAny']);

//UPDATE
//ACTUALIZAR DATOS 
Route::post('/students/edit',[StudentController::class, 'editStudent']);

?>

