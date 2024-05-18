<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::where('status', 1)->paginate(10);
        return view('admin.departments.index', ['departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'departmentName' => 'required|string|max:255',
            // Add more validation rules if needed
        ]);


        $department = new Department();
        $department->name = $request->input('departmentName');
        $department->save();

        Logs::create([
            'activity_desc' => 'Created department: ' . $department->name,
            'user_id' => Auth::id(),
        ]);

        // Redirect back with success message
        return redirect()->route('departments.index')->with('success', 'Department added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department): View
    {
        return view('admin.departments.view', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department): View
    {
        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'departmentName' => 'required|string|max:255',
            // Add validation rules for other fields if needed
        ]);

        $department->name =  $request->input('departmentName');
        $department->save();


        Logs::create([
            'activity_desc' => 'Updated department: ' . $department->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('departments.index')
                        ->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department): RedirectResponse
    {
        $department->status = '0';
        $department->save();

        Logs::create([
            'activity_desc' => 'Removed department: ' . $department->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('departments.index')->with('success','Department removed successfully.');
    }
}
