<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class studentController extends Controller
{

    public function index()
    {


        $students = Student::all();

        if ($students->isEmpty()) {

            $data = [
                'message' => 'no hay estudiantes registrados',
                'status' => 200
            ];
            return response()->json($data, 404);
        }
        $data = [
            'message' => $students,
            'status' => 200
        ];
        return response()->json($data, 200);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|max:50',
            'email' => 'required|email|unique:student',
            'phone' => 'required|digits:10',
            'lenguge' => 'required|in:English,Spanish',
        ]);

        if ($validator->fails()) {

            $data = [
                'message' => 'error en la validacion de los datos  huasca ',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $student = Student::create(

            [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'lenguge' => $request->lenguge,

            ]

        );
        if (!$student) {
            $data = [
                'message' => 'error al crear el studiante',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'name' => $student,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    public function show($id)
    {

        $student = Student::find($id);

        if (!$student) {
            $data = [
                'message' => ' studiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => $student,
            'status' => 200
        ];
        return response()->json($data, 200);
    }


    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                'message' => ' studiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $student->delete();
        $data = [
            'message' => ' studiante eliminado',
            'status' => 404
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {

        $student = Student::find($id);

        if (!$student) {
            $data = [
                'message' => ' studiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }


        $validator = Validator::make($request->all(), [

            'name' => 'required|max:50',
            'email' => 'required|email|unique:student',
            'phone' => 'required|digits:10',
            'lenguge' => 'required|in:English,Spanish',
        ]);

        if ($validator->fails()) {

            $data = [
                'message' => 'error en la validacion de los datos ',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->lenguge = $request->lenguge;

        $student->save();

        $data = [
            'message' => "estudiante actualizado",
            'student' => $student,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function updatepartial(Request $request, $id)
    {


        $student = Student::find($id);

        if (!$student) {
            $data = [
                'message' => ' estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [

            'name' => 'max:50',
            'email' => 'email|unique:student',
            'phone' => 'digits:10',
            'lenguge' => 'in:English,Spanish',

        ]);
        if ($validator->fails()) {
            $data = [
                'message' => 'error en la validacion de los datos ',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        if ($request->has('name')) {
            $student->name = $request->name;
        }
        if ($request->has('email')) {
            $student->email = $request->email;
        }
        if ($request->has('phone')) {
            $student->phone = $request->phone;
        }
        if ($request->has('lenguge')) {
            $student->lenguge = $request->lenguge;
        }
        $student->save();

        $data = [
            'message' => "estudiante actualizado",
            'student' => $student,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
