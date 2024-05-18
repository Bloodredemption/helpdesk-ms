<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Logs;
use App\Models\AssignedTicket;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $tickets = Ticket::where('status', '!=', '0')
                    ->where('user_id', $user->id)
                    ->paginate(10);
        return view('user.tickets.index', ['tickets' => $tickets]);
    }

    public function assignedTickets()
    {
        $user = Auth::user();
        $tickets = Ticket::where('temp_user', $user->id)
                    ->where('status', '!=', '0')
                    ->paginate(10);
        return view('user.assignedtickets.index', ['tickets' => $tickets]);
    }

    public function assignedTickets_show(Ticket $ticket): View
    {
        return view('user.assignedtickets.view', compact('ticket'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $departments = Department::where('status', 1)
                             ->with(['users' => function ($query) {
                                 $query->where('status', 1);
                             }])
                             ->get();
        return view('user.tickets.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'prioritylevel' => 'required|in:Low,Normal,Medium,High',
            'dept_id' => 'required|exists:departments,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $latestTicket = Ticket::latest()->first();
        $ticketNo = 'T' . str_pad(($latestTicket ? intval(substr($latestTicket->ticket_no, 1)) + 1 : 1), 3, '0', STR_PAD_LEFT);

        // Create a new ticket with the validated data
        $ticket = new Ticket();
        $ticket->ticket_no = $ticketNo;
        $ticket->title = $request->input('title');
        $ticket->description = $request->input('desc');
        $ticket->prioritylevel = $request->input('prioritylevel');
        $ticket->dept_id = $request->input('dept_id');
        $ticket->user_id = Auth::id();
        $ticket->temp_user = $request->input('user_id');
        $ticket->status = 'New';
        $ticket->date_issued = now();

        $ticket->save();

        $assignedticket = new AssignedTicket();
        $assignedticket->assigned_by = Auth::id();
        $assignedticket->assigned_to = $request->input('user_id');
        $assignedticket->ticket_id = $ticket->id;
        $assignedticket->date_assigned = now();
        $assignedticket->save();

        Logs::create([
            'activity_desc' => 'Created ticket: ' . $ticket->title,
            'user_id' => Auth::id(),
        ]);

        // Redirect back with success message
        return redirect()->to('/tickets')->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket): View
    {
        return view('user.tickets.view', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket): View
    {
        // $departments = Department::where('status', 1)->get();
        // $users = User::all();

        $departments = Department::where('status', 1)
                             ->with(['users' => function ($query) {
                                 $query->where('status', 1);
                             }])
                             ->get();
        return view('user.tickets.edit', compact('ticket', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'prioritylevel' => 'required|in:Low,Normal,Medium,High',
            'dept_id' => 'required|exists:departments,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:New,In-Progress,On-Hold,Resolved,Closed,Cancelled',
        ]);

        // Update the ticket with the validated data
        $ticket->title = $request->input('title');
        $ticket->description = $request->input('desc');
        $ticket->prioritylevel = $request->input('prioritylevel');
        $ticket->dept_id = $request->input('dept_id');
        $ticket->status = $request->input('status');
        $ticket->temp_user = $request->input('user_id');

        $ticket->save();

        Logs::create([
            'activity_desc' => 'Updated ticket information: ' . $ticket->title,
            'user_id' => Auth::id(),
        ]);

        // Redirect back with success message
        return redirect()->to('/tickets')->with('success', 'Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        
        $ticket->status = 0;
        $ticket->save();

        Logs::create([
            'activity_desc' => 'Removed ticket: ' . $ticket->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->to('/tickets')
                        ->with('success','Ticket removed successfully.');
    }

    public function start(Ticket $ticket)
    {
        $ticket->status = 'In-Progress';
        $ticket->save();

        Logs::create([
            'activity_desc' => 'Ticket In-progress: ' . $ticket->ticket_no,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Ticket Started.');
    }

    public function cancel(Ticket $ticket)
    {
        $ticket->status = 'Cancelled';
        $ticket->save();

        Logs::create([
            'activity_desc' => 'Ticket Cancelled: ' . $ticket->ticket_no,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Ticket has been Cancelled.');
    }

    public function pause(Ticket $ticket)
    {
        $ticket->status = 'On-Hold';
        $ticket->save();

        Logs::create([
            'activity_desc' => 'Ticket On-Hold: ' . $ticket->ticket_no,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Ticket is On-Hold.');
    }

    public function resolve(Ticket $ticket)
    {
        $ticket->status = 'Resolved';
        $ticket->date_solved = now();
        $ticket->save();

        Logs::create([
            'activity_desc' => 'Ticket Resolved: ' . $ticket->ticket_no,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Ticket has been Resolved.');
    }
}
