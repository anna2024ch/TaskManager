<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request)
    {

        $query = Project::query();


        $projects = $query->withCount('tasks')
            ->orderByRaw("status = 'aktiv' DESC") // Сортировка: сначала активные проекты
            ->latest()
            ->get();


        // $query = Project::query();

        // if ($request->status === 'active') {
        //     $query->where('status', 'aktiv');
        // }

        // $projects = $query->withCount('tasks')
        //     ->latest()
        //     ->get();

        return view('projects.index', compact('projects'));
    }

    public function create(){
        return view('projects.create');

                }

//   Speichert ein neues Projekt in der Datenbank
    public function store(Request $request){
        $validated = $request->validate([
            'name'=> 'required|max:255',
            'description' => 'required',
            'status'=> 'required|in:aktiv,pausiert',
            ]);
            $project = Project::create($validated);

            return redirect()
            ->route('projects.index')
            ->with('success','Projekt wurde erfolgreich erstellt!');
    }

    public function edit($id){
        $project = Project::findOrFail($id);
        $tasks = Task::all();
        return view('projects.edit', compact('project', 'tasks'));
       }

    public function update(Request $request, $id){
           // Получаем задачу по ID
           $project = Project::findOrFail($id);
            // Проверка данных (валидация)
            $validated = $request->validate([
                'name' => 'required|max:255',
                'description' => 'required',
                'status'=> 'required|in:aktiv,pausiert',
            ]);

            // Обновляем задачу с новыми данными
            $project->update($validated);
             // Перенаправляем на страницу с успешным сообщением
            return redirect()->route('projects.index')->with('success', 'Projekt updated successfully!');

    }

    public function destroy(Project $project){
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Aufgabe wurde erfolgreich gelöscht!');

    }


}
