<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        $departments = Department::all();

        return view('admin.users.index', ['users' => $users, 'departments' => $departments]);
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
            'name' => 'required|string|max:255',
            'sex' => 'required|in:male,female,other',
            'userType' => 'required|in:user,admin',
            'userDept' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create a new department
        $user = new User();
        $user->name = $request->name;
        $user->sex = $request->sex;
        $user->usertype = $request->userType;
        $user->dept_id = $request->userDept;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'User added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'userName' => 'required|string|max:255',
            'userSex' => 'required|in:male,female,other',
            'usertype' => 'required|in:user,admin',
            'userEmail' => 'required|email|unique:users,email',
            'userPassword' => 'required|min:6',
        ]);

        $user = User::where('id', $request->user_id)->first();

        if ($user) {
            $user->name = $request->userName;
            $user->sex = $request->userSex;
            $user->usertype = $request->usertype;
            $user->email = $request->userEmail;
            $user->password = bcrypt($request->userPassword);
            $user->save();
            return response()->json(['message' => 'User updated successfully'], 200);
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
    public function destroy(string $id)
    {
        //
    }
}
