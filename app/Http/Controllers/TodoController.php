<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;
use App\Models\AssignmentHistory;

class TodoController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $tasksToday = Task::whereDate('created_at', $today)->get();

        $oldTasks = Task::whereDate('created_at', '<', $today)->get();

        foreach ($oldTasks as $task) {
            AssignmentHistory::create([
                'title' => $task->title,
                'status' => $task->status,
                'created_at' => $task->created_at,
            ]);

            $task->delete();
        }

        return view('dashboard', [
            'tasks' => $tasksToday,
            'date' => $today->format('d/m/Y'), 
        ]);
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
        $tasks = Task::whereDate('created_at', Carbon::today())->get();

        $assignmentHistories = AssignmentHistory::whereDate('created_at', '<', Carbon::today())
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->groupBy(function ($assignment) {
                            return Carbon::parse($assignment->created_at)->toDateString();
                        });

        return view('assignment-history', compact('tasks', 'assignmentHistories'));
    }
}
