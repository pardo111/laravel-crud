<?php
namespace App\Http\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\User;

class StudentsTools{
 public static function dataClean(Request $request)
 {
     return [
         'names' => trim($request->input('names')),
         'lastNames' => trim($request->input('lastNames')),
         'bornDate' => trim($request->input('bornDate'))
     ];
 }

 public static function validateStudentData(array $data)
    {
        return Validator::make($data, [
            'names' => 'required|max:35',
            'lastNames' => 'required|max:35',
            'bornDate' => 'required|date|before:' . Carbon::now()->subYears(10)->toDateString()
        ]);
    }
}

 