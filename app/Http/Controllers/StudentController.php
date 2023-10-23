<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;


class StudentController extends Controller
{
    # insert a student
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'study_course' => 'required|string',
        ]);

        $student = Student::create($data);

        return response()->json(['message' => 'Student created successfully', 'student' => $student], 201);
    }

    # retrieve all students
    public function index()
    {
        $students = Student::all();

        return response()->json($students);
    }

    # retrieve a student
    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json($student);
    }

    # update a student's details based on their ID
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $data = $request->validate([
            'name' => 'string',
            'email' => 'email',
            'address' => 'string',
            'study_course' => 'string',
        ]);

        $student->update($data);

        return response()->json(['message' => 'student updated successfully!', 'student' => $student]);
    }

    # delete a student based on their ID
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();

        return response()->json(['message' => 'Student deleted successfully']);
    }
}
