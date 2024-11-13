<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;



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
            ->orderByRaw("status = 'neu' DESC") // Сортировка: сначала активные проекты
            ->latest()
            ->get();


        return view('tasks.index', compact('tasks'));
    }

    // Create-Funktion
    public function create()
    {
        $projects = Project::all();
        return view('tasks.create', compact('projects'));
    }

    public function store(Request $request)
    {
        // 1. Validierung der eingehenden Daten
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:neu,in_bearbeitung',
            'priority' => 'required|in:niedrig,mittel,hoch',
            'due_date' => 'required|date',
            'project_id' => 'required|exists:projects,id',
        ]);

        // 2. Erstellen des neuen Tasks mit den validierten Daten
        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => $validated['status'],
            'priority' => $validated['priority'],
            'due_date' => $validated['due_date'],
            'project_id' => $validated['project_id'],



            // Automatisch den eingeloggten Benutzer als Ersteller setzen
            'created_by' => Auth::user() ? Auth::user()->id : null,
            // Vorläufig den eingeloggten Benutzer auch als Bearbeiter setzen
            'assigned_to' => Auth::check() ? Auth::id() : null,

        ]);

        // 3. Weiterleitung mit Erfolgsmeldung
        return redirect()
            ->route('tasks.index')
            ->with('success', 'Aufgabe wurde erfolgreich erstellt!');
    }

    public function edit($id)
    {   $task = Task::findOrFail($id);
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(Request $request, $id)
{    // Получаем задачу по ID
    $task = Task::find($id);
    // Проверка данных (валидация)
    $validated = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'project_id' => 'required|exists:projects,id',
        'status' => 'required|in:neu,in_bearbeitung'

    ]);
    // Обновляем задачу с новыми данными
    $task->update($validated);
    // Перенаправляем на страницу с успешным сообщением
    return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
}

public function destroy(Task $task)
{    // Удаляем задачу
    $task->delete();
    // Перенаправляем обратно на страницу списка задач с сообщением об успешном удалении
    return redirect()->route('tasks.index')->with('success', 'Aufgabe wurde erfolgreich gelöscht!');
}

}
