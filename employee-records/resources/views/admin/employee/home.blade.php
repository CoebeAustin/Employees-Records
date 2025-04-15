<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0">List Employee</h1>
                        <a href="{{ route('admin/employees/create') }}" class="btn btn-primary">Add Employee</a>
                    </div>
                    <hr />
                    @if (session()->has('success'))
                    <div class="alert alert-success">
                    {{ session('success') }}
                    </div>
                    @endif
                    <table class = "table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Gender</th>
                                <th>Birthday</th>
                                <th>Monthly Salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $employee)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $employee->id }}</td>
                                <td class="align-middle">{{ $employee->first_name }}</td>
                                <td class="align-middle">{{ $employee->last_name }}</td>
                                <td class="align-middle">{{ $employee->gender }}</td>
                                <td class="align-middle">{{ $employee->birthday }}</td>
                                <td class="align-middle">{{ $employee->monthly_salary }}</td>
                                <td class="align-middle">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('admin/employees/edit', ['id'=>$employee->id]) }}" type="button" class="btn btn-secondary">Edit</a>
                                        <a href="{{ route('admin/employees/delete', ['id'=>$employee->id]) }}" type="button" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="5">Product not found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- <p><a href="employees" class="btn btn-primary">Employees</a></p> -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
