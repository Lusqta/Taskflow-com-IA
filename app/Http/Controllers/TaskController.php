<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\AIService;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::orderByRaw("CASE 
                    WHEN priority = 'high' THEN 1 
                    WHEN priority = 'medium' THEN 2 
                    WHEN priority = 'low' THEN 3 
                    ELSE 4 END")
                 ->orderBy('created_at', 'desc')
                 ->get();
        return view('tasks.index', compact('tasks'));
    }

    // Criação agora é instantânea, sem chamar a IA aqui
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'priority' => 'required|in:low,medium,high',
        ]);

        Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? '',
            'priority' => $validated['priority'],
            'status' => 'todo'
        ]);

        return redirect()->route('tasks.index');
    }

    public function update(Request $request, Task $task) {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task->update(array_merge($validated, ['ai_reasoning' => null]));

        return redirect()->route('tasks.index');
    }

    public function move(Request $request, Task $task) {
        $data = $request->validate([
            'status' => 'required|in:todo,doing,done',
        ]);

        $task->update(['status' => $data['status']]);

        return response()->json(['success' => true]);
    }

    // Esta é a função acionada pelo botão "Deixar a IA organizar"
    public function reorganize() {
        $tasks = Task::where('status', '!=', 'done')->get();
        
        if ($tasks->isEmpty()) {
            return redirect()->route('tasks.index')->with('insight', 'Sem tarefas pendentes para organizar!');
        }

        $result = AIService::reorganizeTasks($tasks);

        if ($result && isset($result['tasks'])) {
            foreach ($result['tasks'] as $aiTask) {
                Task::where('id', $aiTask['id'])->update([
                    'priority' => $aiTask['priority'],
                    'ai_reasoning' => $aiTask['reasoning'] ?? null
                ]);
            }
            return redirect()->route('tasks.index')->with('insight', $result['insight'] ?? 'Quadro organizado!');
        }

        return redirect()->route('tasks.index')->with('error', 'IA não conseguiu organizar no momento.');
    }

    public function destroy(Task $task) {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}