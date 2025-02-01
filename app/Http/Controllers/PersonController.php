<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{

    public function getAll(){
        $persons = Person::all();
        return response()->json($persons,200);
    }

    public function createPerson(Request $request){
        
        $validator = Validator::make(request->all(),[
'names'=>'required',
'lastnames'=>'required',
'born'=>'required'
        ]);

        if ($validator->fails()){
            return response()->json("error en validacion",400);
        }

        $person = Person::create(
            [
                'names'=>$request->names,
                'lastnames'=>$request->lastnames,
                'born'=>$request->born
            ]
        );
        if (!$person){
            return response()->json("error al crearlo",500);
        }
        return response()->json("estudiante creado", 201);
    }
}
