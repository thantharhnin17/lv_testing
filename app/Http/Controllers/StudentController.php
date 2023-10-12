<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function save_student(Request $request){
        // Create a new student instance and assign attributes
        $student = new Student;
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->phone = $request->input('phone');
        
        // Save the student to the database
        $student->save();
    
        return 'ok';
    }

    public function all_students(){
        $students = Student::orderBy('created_at', 'desc')->paginate(5); // Fetch all student records

        return response()->json($students);
    }

    public function edit_student($id){
        $student = Student::find($id);
         
        return response()->json($student);
    }

    public function update_student(){
        $student = Student::find(request()->id);

        $student->name = request()->name;
        $student->email = request()->email;
        $student->phone = request()->phone;

        $student->update();

        return 'ok';
    }

    public function delete_student($id){
        $student = Student::find($id)->delete();

        return 'ok';
    }
}
