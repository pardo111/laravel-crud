<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
 
Route::get('/students', [PersonController::class, 'getAll']);
Route::post('/students', [PersonController::class, 'createPerson']);


?>

