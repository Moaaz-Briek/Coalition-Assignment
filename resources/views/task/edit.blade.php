@extends('layout.layout')
@section('content')
<main>
        <div class="container">
            <div class="d-flex justify-content-between col align-self-start align-items-center pt-3 pb-2 mb-3 mt-5 border-bottom">
                <h2 class="text-black-50">Edit Task</h2>
                <div>
                    <a class="btn btn-secondary ms-4" href = "{{url('/')}}">Back</a>
                </div>
            </div>
            <form action="{{url('tasks/edit')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Task Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Task Name" value="{{$task['name']}}" name="name">
                </div>
                <div class="mb-3">
                    <label for="priority" class="form-label">Task Priority</label>
                    <input type="text" class="form-control" id="priority" placeholder="Enter Task Priority" value="{{$task['priority']}}" name="priority">
                </div>
                <div class="mb-3">
                    <label for="project" class="form-label">Project Name</label>
                    <select id="project_select" name="project_id" class="form-control">
                        @foreach($projects as $project)
                            <option value="{{$project->id}}">{{$project->name}}</option>
                        @endforeach
                    </select>
                </div>
                <input name="id" value="{{$task['id']}}" hidden>
                <input type="submit" class="col-2 btn btn-primary" value="Save">
            </form>
        </div>
    </main>
@endsection
