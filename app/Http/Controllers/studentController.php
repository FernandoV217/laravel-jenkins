<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class studentController extends Controller
{
    public function getStudents() {
        $students = Student::all();

        if ($students->isEmpty()) {
            $data = [
                'mensaje' => 'No se encontraron estudiantes',
                'status' => 200
            ];

            return response()->json($data, 200);
        }

        return response()->json($students, 200);
    }

    public function getStudent($id) {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                'mensaje' => 'El estudiante no se encuentra',
                'status' => 404
            ];

            return response()->json($data, 404);
        }
        
        $data = [
            'student' => $student,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function guardarStudent(Request $request) {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'edad' => 'required'
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'edad.required' => 'La edad es obligatoria'
        ]);

        if ($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $student = Student::create([
            'nombre' => $request->nombre,
            'edad' => $request->edad
        ]);

        if (!$student) {
            $data = [
                'mensaje' => 'Error al crear estudiante',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'student' => $student,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function updateStudent(Request $request, $id) {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                'mensaje' => 'El estudiante no se encuentra',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre'=>'required|min:5',
            'edad'=>'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $student->nombre = $request->nombre;
        $student->edad = $request->edad;

        $student->save();

        $data = [
            'mensaje' => 'Estudiante actualizado',
            'student' => $student,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function deleteStudent($id) {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                'mensaje' => 'El estudiante no se encuentra',
                'status' => 404
            ];

            return response()->json($data, 404);
        }
        
        $student->delete();

        $data = [
                'mensaje' => 'Estudiante eliminado',
                'status' => 200
        ];

        return response()->json($data, 200);
    }
}
