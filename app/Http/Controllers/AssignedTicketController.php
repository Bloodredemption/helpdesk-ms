<?php

namespace App\Http\Controllers;

use App\Models\AssignedTicket;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class AssignedTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignedTickets = AssignedTicket::with(['assignedBy', 'assignedTo', 'ticket'])->paginate(5);
        $departments = Department::all()->keyBy('id');
        $users = User::where('usertype', 'User')->get();
        $totalUsers = $users->count();
        $totalDepartments = $departments->count();
        return view('admin.dashboard', ['assignedTickets' => $assignedTickets, 'departments' => $departments, 'totalDepartments' => $totalDepartments, 'totalUsers' => $totalUsers]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignedTicket $assignedTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssignedTicket $assignedTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssignedTicket $assignedTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssignedTicket $assignedTicket)
    {
        //
    }
}
