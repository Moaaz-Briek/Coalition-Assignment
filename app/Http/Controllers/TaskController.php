<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use http\Env\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Retrieves all projects and tasks from the database and passes them to the view.
     * The view then displays all tasks sorted by priority with a dropdown list of all available projects.
     * @return View
     */
    public function index()
    {
        $projects = Project::all();
        $tasks = Task::orderBy('priority', 'asc')->get();
        return view('task.index', compact('tasks', 'projects'));
    }

    /**
     * Retrieves all projects from the database and passes them to the view.
     * The view then displays a form for creating a new task with a dropdown list of all available projects
     * @return View
     */
    public function show()
    {
        $projects = Project::all();
        return view('task.create', compact('projects'));
    }

    /**
     *  Creates a new task. Retrieves all data from the form and creates a new task with the submitted data.
     *  Validate the data based on specif rules in the TaskRequest.
     *  The new task is then saved to the database and the user is redirected back to the task list page
     * @param TaskRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function create(TaskRequest $request)
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

    /**
     * @param $id
     * @return View
     * Updates an existing task.
     * If the request is a POST request, it retrieves all data from the form and updates the task with the submitted data.
     * The updated task is then saved to the database and the user is redirected back to the task list page.
     * If the request is not a POST request, it retrieves the task with the given ID and displays it in an edit form along with all available projects.
     */
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

    /**
     * @param $id
     * @return View|\Illuminate\Http\RedirectResponse
     * Deletes an existing task with the given ID. If the task is deleted successfully, the user is redirected back to the task list page.
     * If not, the user is redirected back to the error page.
     */
    public function destroy($id)
    {
        $check = Task::where('id', $id)->delete();
        if ($check) {
            return redirect()->route('tasks');
        }
        return view('errors');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     * Updates the priority of tasks. It loops through each task in the request and updates the priority of each task with the new index.
     * The updated priority is then saved to the database. If all tasks are updated successfully, it returns a 204 No Content HTTP response
     */
    public function reorder(Request $request)
    {
        foreach ($request->tasks as $index => $taskId) {
            Task::where('id', $taskId)->update(['priority' => $index + 1]);
        }
        return response()->noContent();
    }
}
