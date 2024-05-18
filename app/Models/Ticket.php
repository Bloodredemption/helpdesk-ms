<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'prioritylevel',
        'user_id',
        'dept_id',
        'status',
        'temp_user',
    ];

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function temporaryUser()
    {
        return $this->belongsTo(User::class, 'temp_user');
    }
}
