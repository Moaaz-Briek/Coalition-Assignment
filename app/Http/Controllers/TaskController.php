<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $tasks = Task::orderBy('priority', 'asc')->get();
        return view('task.index', compact('tasks', 'projects'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('task.create', compact('projects'));
    }

    public function store(TaskRequest $request)
    {
        if ($request->post()) {
            $data = $request->all();
            Task::create([
                'name' => $data['name'],
                'priority' => $data['priority'],
                'project_id' => $data['project_id'],
            ]);
            return redirect()->route('tasks');
        }
    }

    public function edit(Request $request, $id = null)
    {
        if ($request->post()) {
            $data = $request->all();
            Task::where('id', $data['id'])
                ->update([
                    'name' => $data['name'],
                    'priority' => $data['priority'],
                    'project_id' => $data['project_id'],
                ]);
            return redirect()->route('tasks');
        }

        $task = Task::where('id', $id)->first();
        if ($task) {
            $task->toArray();
            $projects = Project::all();
            return view('task.edit', compact('task', 'projects'));
        }
        return view('errors');

    }

    public function destroy($id)
    {
        $check = Task::where('id', $id)->delete();
        if ($check) {
            return redirect()->route('tasks');
        }
        return redirect()->route('tasks')->withErrors($check);
    }

    public function reorder(Request $request)
    {
        foreach ($request->tasks as $index => $taskId) {
            Task::where('id', $taskId)->update(['priority' => $index + 1,]);
        }
        return response()->noContent();
    }
}
