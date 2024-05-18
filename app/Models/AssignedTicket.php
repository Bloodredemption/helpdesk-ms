<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedTicket extends Model
{
    use HasFactory;

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function dept()
    {
        return $this->belongsTo(Department::class, 'assigned_by');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
