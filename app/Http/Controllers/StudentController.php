<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    public function getAll()
    {
        $students = Student::all();

        if ($students->isEmpty()) {
            return response()->json([
                "data" => "data not found, is empty",
            ], 400);
        }

        return response()->json([
            "data" => $students,
        ], 200);
    }

    public function getByName(Request $request, $names)
    {
        $data = Student::where('names', 'like', '%' . $names . '%')->get();

        if ($data->isEmpty()) {
            return response()->json(["message" => "sin datos"], 404);
        }

        return response()->json(["data" => $data], 200);
    }

    public function getByLastName(Request $request, $lastNames)
    {
        $data = Student::where('lastNames', 'like', '%' . $lastNames . '%')->get();

        if ($data->isEmpty()) {
            return response()->json(["message" => "sin datos"], 404);
        }

        return response()->json(["data" => $data], 200);
    }

    public function getByStudentCode(Request $request, $StudentCode)
    {
        $data = Student::where('StudentCode', 'like', '%' . $StudentCode . '%')->get();

        if ($data->isEmpty()) {
            return response()->json(["message" => "sin datos"], 404);
        }

        return response()->json(["data" => $data], 200);
    }

    public function createStudent(Request $request)
    {

        $names = trim($request->input('names'));
        $lastNames = trim(string: $request->input('lastNames'));
        $bornDate = trim($request->input('bornDate'));


        // Validando los campos
        $validator = Validator::make($request->all(), [
            'names' => 'required|max:35',
            'lastNames' => 'required|max:35',
            'bornDate' => 'required|date|before:' . \Carbon\Carbon::now()->subYears(10)->toDateString() // toco averiguar que era Carbon
        ]);

        // Si falla la validación
        if ($validator->fails()) {
            return response()->json([
                "error" => "Error en validación",
                "errores" => $validator->errors()
            ], 400);
        }

        // Generando el código del estudiante
        $studentCode = date('d') .
            date('h') .
            date('s') .
            date('y') .
            substr($request->input('names'), 0, 1) .
            substr($request->input('lastNames'), 0, 1);

        // Verificar si el StudentCode ya existe
        if (
            Student::where('StudentCode', $studentCode)
            ->where('names', $request->input('names'))
            ->where('lastNames', $request->input('lastNames'))
            ->where('bornDate', $request->input('bornDate'))->exists()
        ) {
            return response()->json(['error' => 'Ya estas registrado!'], 400);
        }

        // Creando el estudiante
        $Student = Student::create(
            [
                'names' => $names,
                'lastNames' => $lastNames,
                'bornDate' => $bornDate,
                'StudentCode' => $studentCode
            ]
        );

        // Si ocurre un error al crear el estudiante
        if (!$Student) {
            return response()->json(['error' => 'Error al crearlo'], 500);
        }

        // Respuesta exitosa
        return response()->json([
            'message' => 'Estudiante creado',
            'student' => $Student
        ], 201);
    }

    public function getByAny(Request $request, $any){
        $any= trim($any);

        $data = Student::where('names', 'like', "%{$any}%")
        ->orWhere('lastNames', 'like', "%{$any}%")
        ->orWhere('StudentCode', 'like', "%{$any}%")
        ->get();

        if($data->isEmpty()){
            return response()->json(["message"=>"no data found"], 404);
        }

        return response()->json(["data"=>$data], 200);
    }

    public function editStudent(Request $request){

    }
}
