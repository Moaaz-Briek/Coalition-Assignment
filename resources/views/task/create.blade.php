@extends('layout.layout')
@section('content')
<main>
        <div class="container">
            <div class="d-flex justify-content-between col align-self-start align-items-center pt-3 pb-2 mb-3 mt-5 border-bottom">
                <h2 class="text-black-50">Create Task</h2>
                <div>
                    <a class="btn btn-secondary ms-4" href = "{{url('tasks/')}}">Back</a>
                </div>
            </div>
            <form action="{{url('tasks/create')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Task Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Task Name" name="name" value="{{ old('name') }}">
                </div>
                @error('name')
                <div class="alert alert-danger">
                    <span>{{$message}}</span>
                </div>
                @enderror
                <div class="mb-3">
                    <label for="priority" class="form-label">Task Priority</label>
                    <input type="text" class="form-control" id="priority" placeholder="Enter Task Priority" name="priority" value="{{ old('priority') }}">
                </div>
                @error('priority')
                <div class="alert alert-danger">
                    <span>{{$message}}</span>
                </div>
                @enderror
                <div class="mb-3">
                    <label for="project" class="form-label">Project Name</label>
                    <select id="project_select" name="project_id" class="form-control">
                        @foreach($projects as $project)
                            <option value="{{$project->id}}">{{$project->name}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" class="btn btn-primary btn-md d-grid col-2" value="Save">
            </form>
        </div>
    </main>
@endsection
