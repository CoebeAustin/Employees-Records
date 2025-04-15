<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('admin.employee.home');
    }

    public function create()
    {
        return view('admin.employee.create');
    }

    public function save(Request $request){
        $validation = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'birthday' => 'required|date',
            'monthly_salary' => 'required|numeric|min:0',
        ]);
        $data = Employee::create($validation);
        if($data){
            session()->flash('success', 'Employee created successfully');
            return redirect()->route('admin/employees');
        }else{
            session()->flash('error', 'Failed to create employee');
            return redirect()->route('admin.employees/create');
        }
    }
}
