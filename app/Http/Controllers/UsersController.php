<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logs;
use App\Models\Department;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('status', 1)->paginate(10);
        $departments = Department::all()->keyBy('id');

        return view('admin.users.index', ['users' => $users, 'departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $departments = Department::where('status', 1)->get();
        // $departments = Department::all();
        return view('admin.users.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'sex' => 'required|in:Male,Female',
            'userType' => 'required|in:User,Admin',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            // Conditionally validate 'dept' and 'position' only if userType is 'User'
            'dept' => 'required_if:userType,User|exists:departments,id',
            'position' => 'required_if:userType,User',
        ]);

        // Create a new user with the validated data
        $user = new User();
        $user->name = $request->input('name');
        $user->sex = $request->input('sex');
        $user->userType = $request->input('userType');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password')); // Hash the password

        // Conditionally assign 'dept' and 'position' if userType is 'User'
        if ($request->input('userType') === 'User') {
            $user->dept_id = $request->input('dept');
            $user->position = $request->input('position');
        }

        $user->save();

        Logs::create([
            'activity_desc' => 'Created user: ' . $user->name,
            'user_id' => Auth::id(),
        ]);

        // Redirect back with success message
        return redirect()->route('users.index')->with('success', 'User added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        $department = Department::find($user->dept_id);
        return view('admin.users.view', compact('user', 'department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        $alldept = Department::all();
        $department = Department::find($user->dept_id);
        $otherDepartments = Department::where('id', '!=', $user->dept_id)->get();
        return view('admin.users.edit', compact('user', 'alldept', 'department', 'otherDepartments'));
    }

    public function myAccount(User $user): View
    {
        $alldept = Department::all();
        $department = Department::find($user->dept_id);
        $otherDepartments = Department::where('id', '!=', $user->dept_id)->get();
        return view('myaccount.index', compact('user', 'alldept', 'department', 'otherDepartments'));
    }

    public function myAccount_update(Request $request, User $user): RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'sex' => 'required|in:Male,Female',
            'userType' => 'required|in:User,Admin',
            'email' => 'required|email',
            // Conditionally validate 'dept' and 'position' only if userType is 'User'
            'dept' => 'required_if:userType,User|exists:departments,id',
            'position' => 'required_if:userType,User',
        ]);

        // Assign the validated values to the user model
        $user->name = $request->input('name');
        $user->sex = $request->input('sex');
        $user->usertype = $request->input('userType'); // Use the correct column name
        $user->email = $request->input('email');

        // Conditionally assign 'dept' and 'position' if userType is 'User'
        if ($request->input('userType') === 'User') {
            $user->dept_id = $request->input('dept'); // Use the correct column name
            $user->position = $request->input('position');
        } else {
            // If userType is not 'User', clear these fields
            $user->dept_id = null;
            $user->position = null;
        }

        // Save the updated user model
        $user->save();

        Logs::create([
            'activity_desc' => 'Updated user: ' . $user->name,
            'user_id' => Auth::id(),
        ]);

        // Redirect to the users index route with a success message
        return redirect()->route('myaccount')
                        ->with('success', 'Your Account has been updated successfully.');
    }

    public function myAccount_updatePass(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user->update(['password' => bcrypt($request->input('password'))]);

        return redirect()->route('myaccount')
                        ->with('success','Account Password has been updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'sex' => 'required|in:Male,Female',
            'userType' => 'required|in:User,Admin',
            'email' => 'required|email',
            // Conditionally validate 'dept' and 'position' only if userType is 'User'
            'dept' => 'required_if:userType,User|exists:departments,id',
            'position' => 'required_if:userType,User',
        ]);

        // Assign the validated values to the user model
        $user->name = $request->input('name');
        $user->sex = $request->input('sex');
        $user->usertype = $request->input('userType'); // Use the correct column name
        $user->email = $request->input('email');

        // Conditionally assign 'dept' and 'position' if userType is 'User'
        if ($request->input('userType') === 'User') {
            $user->dept_id = $request->input('dept'); // Use the correct column name
            $user->position = $request->input('position');
        } else {
            // If userType is not 'User', clear these fields
            $user->dept_id = null;
            $user->position = null;
        }

        // Save the updated user model
        $user->save();

        Logs::create([
            'activity_desc' => 'Updated user: ' . $user->name,
            'user_id' => Auth::id(),
        ]);

        // Redirect to the users index route with a success message
        return redirect()->route('users.index')
                        ->with('success', 'User updated successfully.');
    }

    public function updatePass(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user->update(['password' => bcrypt($request->input('password'))]);

        return redirect()->route('users.index')
                        ->with('success','Password updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->status = 0;
        $user->save();

        Logs::create([
            'activity_desc' => 'Removed user: ' . $user->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('users.index')
                        ->with('success','User removed successfully.');
    }
}
