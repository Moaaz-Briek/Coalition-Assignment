@extends('layout.layout')
@section('content')
<main>
        <div class="container">
            <div class="d-flex justify-content-between col align-self-start align-items-center pt-3 pb-2 mb-3 mt-5 border-bottom">
                <h2 class="text-black-50">Edit Project</h2>
                <div>
                    <a class="btn btn-secondary ms-4" href = "{{url('projects/')}}">Back</a>
                </div>
            </div>
            <form action="{{url('projects/edit')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Project Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Project Name" value="{{$project['name']}}" name="name">
                </div>
                <div class="mb-3">
                    <label for="priority" class="form-label">Project Description</label>
                    <input type="text" class="form-control" id="priority" placeholder="Enter Project Description" value="{{$project['description']}}" name="description">
                </div>
                <input name="id" value="{{$project['id']}}" hidden>
                <input type="submit" class="col-2 btn btn-primary" value="Save">
            </form>
        </div>
    </main>
@endsection
