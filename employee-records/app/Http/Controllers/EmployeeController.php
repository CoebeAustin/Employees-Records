<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->get();
        $total = Employee::count();
        return view('admin.employee.home', compact(['employees', 'total']));
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

    public function edit($id){
        $employee = Employee::findOrFail($id);
        return view('admin.employee.update', compact('employee'));
    }

    public function update(Request $request, $id){
        $employees = Employee::findOrFail($id);
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $gender = $request->gender;
        $birthday = $request->birthday;
        $monthly_salary = $request->monthly_salary;

        $employees -> first_name = $first_name;
        $employees -> last_name = $last_name;
        $employees -> gender = $gender;
        $employees -> birthday = $birthday;
        $employees -> monthly_salary = $monthly_salary;
        $data = $employees->save();

        if ($data){
            session()->flash('success', 'Employee updated successfully');
            return redirect()->route('admin/employees');
        }
        else{
            session()->flash('error', 'Failed to update employee');
            return redirect()->route('admin/employees/update', $id);
        }
    }

    public function delete(Request $request, $id){
        $employee = Employee::findOrFail($id);
        $data = $employee->delete();
        if ($data){
            session()->flash('success', 'Employee deleted successfully');
            return redirect()->route('admin/employees');
        }
        else{
            session()->flash('error', 'Failed to delete employee');
            return redirect()->route('admin/employees');
        }
    }
}
