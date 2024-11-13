<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Add this line to cast due_date to datetime
    protected $casts = [
        'due_date' => 'datetime'
    ];

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'project_id',
        'assigned_to',
        'created_by'

    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
