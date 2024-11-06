<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        // Filter basierend auf Status-Parameter
        if ($request->status === 'open') {
            $query->whereIn('status', ['neu', 'in_bearbeitung']);
        } elseif ($request->status === 'overdue') {
            $query->where('due_date', '<', now())
                ->whereIn('status', ['neu', 'in_bearbeitung']);
        }

        $tasks = $query->with(['project', 'assignedUser'])
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks'));
    }
}