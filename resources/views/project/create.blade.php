@extends('layout.layout')
@section('content')
<main>
        <div class="container">
            <div class="d-flex justify-content-between col align-self-start align-items-center pt-3 pb-2 mb-3 mt-5 border-bottom">
                <h2 class="text-black-50">Create A Project</h2>
                <div>
                    <a class="btn btn-secondary ms-4" href = "{{url('projects/')}}">Back</a>
                </div>
            </div>
            <form action="{{url('projects/create')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Project Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Project Name" name="name">
                    @error('name')
                        <div class=" mt-1 alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Project Description</label>
                    <textarea style="resize: none" class="form-control" id="description" placeholder="Enter Project Description" name="description"></textarea>
                    @error('description')
                    <div class=" mt-1 alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <input type="submit" class="btn btn-primary btn-md d-grid col-2" value="Save">
            </form>
        </div>
    </main>
@endsection
