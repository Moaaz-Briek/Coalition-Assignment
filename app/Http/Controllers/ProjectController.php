<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('project.index', compact('projects'));
    }

    public function getProjectTasksUsingAjax(Request $request)
    {
        $data = $request->all();
        if ($data['project_id'] === 'all') {
            $tasks = Task::with('project')
                ->orderBy('priority', 'asc')
                ->get()->toArray();
        } else {
            $tasks = Task::with('project')
                ->orderBy('priority', 'asc')
                ->where('project_id', $data['project_id'])
                ->get()->toArray();
        }
        return $tasks;
    }

    public function create()
    {
        return view('project.create');
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->all();
        Project::create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
        return redirect()->route('projects');
    }

    public function edit(Request $request, $id = null)
    {
        if($request->method() === 'POST') {
            $project = Project::where('id', $request->input('id'));
            if($project) {
                $project->update([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                ]);
                return redirect()->route('projects');
            }
            return view('errors');
        }
        $project = Project::where('id', $id)->first();
        if ($project) {
            $project->toArray();
            return view('project.edit', compact('project'));
        }
        return view('errors');
    }

    public function delete($id)
    {
        $project = Project::where('id', $id)->get()->first();
        if($project) {
            $project->delete();
        }
        return redirect()->route('projects');
    }
}
