<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Retrieving all projects from the database and returns them to the view.
     * The view then displays all projects in a table
     * @return View
     */
    public function index()
    {
        $projects = Project::all();
        return view('project.index', compact('projects'));
    }

    /**
     * @param Request $request
     * @return mixed[]
     * Retrieving tasks from the database based on the project ID passed in the request.
     * If the project ID is ‘all’, it retrieves all tasks from the database and returns them as an array.
     * Otherwise, it retrieves all tasks associated with the project ID and returns them as an array
     */
    public function getProjectTasksUsingAjax(Request $request)
    {
        if ($request->project_id === 'all') {
            $tasks = Task::with('project')
                ->orderBy('priority', 'asc')
                ->get()->toArray();
        } else {
            $tasks = Task::with('project')
                ->orderBy('priority', 'asc')
                ->where('project_id', $request->project_id)
                ->get()->toArray();
        }
        return $tasks;
    }

    /**
     * Returns create view.
     * * @return View
     */
    public function show()
    {
        return view('project.create');
    }

    /**
     * @param ProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * Creates a new project.
     * The function takes an instance of the ProjectRequest class as an argument.
     * A new project is created with the name and description from the $request variable using the Project::create() method.
     * Finally, the function redirects to the projects route.
     */
    public function create(ProjectRequest $request)
    {
        Project::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('projects');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     * Edits an existing project.
     * The function takes an instance of the Request class and an optional $id parameter as arguments.
     * If the request method is POST, the function updates the project with the given ID with the new name and description from the request using the Project::update() method.
     * If there is no project with the given ID, it returns an error view.
     * If the request method is not POST, it retrieves the project with the given ID using the Project::where() method and returns a view to edit the project.
     */
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

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * Deletes an existing project.
     * The function is named delete and is defined as a public function.
     * It takes an $id parameter as an argument. It retrieves the project with the given ID using the Project::where() method and deletes it using the delete() method.
     * Finally, it redirects to the projects route.
     */
    public function delete($id)
    {
        $project = Project::where('id', $id)->get()->first();
        if($project) {
            $project->delete();
        }
        return redirect()->route('projects');
    }
}
