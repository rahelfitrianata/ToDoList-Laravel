<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;

class TodoController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get()->groupBy(function($task) {
            return Carbon::parse($task->created_at)->translatedFormat('d/m/Y'); // Format: "12 Februari 2025"
        });
    
        return view('dashboard', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
        ]);

        Task::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Task added successfully!');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate(['status' => 'required']);
        $task->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Task deleted successfully!');
    }

    public function confirmDelete($id)
    {
    $task = Task::findOrFail($id);
    return view('tasks.delete', compact('task'));
    }  

    public function history()
    {
        $tasks = Task::where('status', 'Completed')->get();
        return view('assignment-history', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function storeTask(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
        ]);

        Task::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Task added successfully!');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function updateTask(Request $request, Task $task)
    {
        $request->validate(['title' => 'required', 'status' => 'required']);
        $task->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Task updated successfully!');
    }
    
    public function indexAssignment()
    {
        // Ambil tugas yang statusnya "Completed"
        $assignments = Task::whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($task) {
                return $task->created_at->format('Y-m-d'); // Grup berdasarkan tanggal pembuatan
            });

        return view('assignment-history', compact('assignments'));
    }
}
