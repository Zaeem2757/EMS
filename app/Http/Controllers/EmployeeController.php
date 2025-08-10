<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        if($user->hasRole('Admin')){
            $employees = Employee::with(['department', 'user.roles'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }else if($user->hasRole('Manager')){
            $managerEmployee = Employee::where('user_id', $user->id)->first();
            $employees = Employee::with(['department', 'user.roles'])
                ->where('department_id', $managerEmployee->department_id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }
        else{
            $employees = Employee::with(['department', 'user.roles'])->where('user_id', $user->id)->first();
        }
        $search = $request->input('search');

        $employees = Employee::with('department')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhereHas('department', function ($q2) use ($search) {
                            $q2->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('employees.index', compact('employees', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $roles = Role::where('name', '!=', 'admin')->get();
        return view('employees.create', compact('departments', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'joining_date' => 'required|date',
            'role' => 'required|string|exists:roles,name',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create user first
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole($validated['role']);

        // Create employee linked to user
        $employee = Employee::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'department_id' => $validated['department_id'],
            'joining_date' => $validated['joining_date'],
            'user_id' => $user->id,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $employee->load('department', 'user.roles'); // eager load relations
        return view('employees.view', compact('employee'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $roles = Role::where('name', '!=', 'admin')->get();

        $employee->load('user.roles'); // eager load roles on user
//        echo "<pre>";print_r($employee->user->roles->pluck('name'));die();
        return view('employees.edit', compact('employee', 'departments', 'roles'));
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($employee->user->id ?? ''),
            'phone' => 'nullable|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'joining_date' => 'required|date',
            'role' => 'required|string|exists:roles,name',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update linked User
        $user = $employee->user;
        if ($user) {
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }
            $user->save();

            // Sync roles (replace all roles with this one)
            $user->syncRoles([$validated['role']]);
        }

        // Update Employee data
        $employee->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'department_id' => $validated['department_id'],
            'joining_date' => $validated['joining_date'],
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    public function restore($id)
    {
        $employee = Employee::withTrashed()->findOrFail($id);
        $employee->restore();

        return redirect()->route('employees.index')->with('success', 'Employee restored successfully.');
    }

    public function forceDelete($id)
    {
        $employee = Employee::withTrashed()->findOrFail($id);
        $employee->forceDelete();

        return redirect()->route('employees.index')->with('success', 'Employee permanently deleted.');
    }
}
