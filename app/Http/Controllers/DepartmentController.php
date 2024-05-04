<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::paginate(10);
        return view('admin.departments.index', ['departments' => $departments]);
    }

    public function getDepartmentName($id)
    {
        $department = Department::find($id);
        if ($department) {
            return response()->json(['name' => $department->name]);
        } else {
            return response()->json(['error' => 'Department not found'], 404);
        }
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

        // Create a new department
        Department::create([
            'name' => $request->departmentName,
            // Add more fields as needed
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Department added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        $desiredId = $department->id;
        return view('admin.departments.index')->with('desiredId', $desiredId);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'departmentNameInput' => 'required|string|max:255',
            // Add validation rules for other fields if needed
        ]);

        $department = Department::where('id', $request->dept_id)->first();

        if ($department) {
            $department->name = $request->departmentNameInput;
            $department->save();
            return response()->json(['message' => 'Department updated successfully'], 200);
        }else{
            return response()->json(['message' => 'Data not found'], 404);
        }

        // $department->update([
        //     'name' => $request->departmentName,
        //     // Update other fields here
        // ]);

        // return redirect()->back()->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
    }
}
