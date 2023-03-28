@extends('layout.layout')
@section('content')
    <main class="mt-5">
        <div class="container">
            <div class="d-flex justify-content-between col align-self-start align-items-center pt-3 pb-2 mb-5 border-bottom">
                <h2 class="text-black-50">Project Management</h2>
                <div>
                    <a href="{{url('projects/show')}}" class="btn btn-primary">Create A Project</a>
                    <a href="{{url('tasks/')}}" class="btn btn-secondary">Back</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="text-center table datatable">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Operations</th>
                    </tr>
                    </thead>
                    <tbody>
                <?php $i = 1; ?>
                @foreach($projects as $project)
                <tr id="{{$project->id}}" >
                    <td>{{$i++}}</td>
                    <td>{{$project->name}}</td>
                    <td>{{$project->description}}</td>
                    <td>
                        @php
                            $dt = new DateTime($project->created_at);
                            $date = $dt->format("Y-m-d");
                            $time = $dt->format("H:i");
                            $newDateTime = date("A", strtotime($time));
                            $dateTimeType = ($newDateTime == "AM") ? 'AM' : 'PM';
                        @endphp
                        {{$date}}
                        {{$time}}
                        {{$dateTimeType}}
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{url('/projects/edit', $project->id)}}">Edit</a>
                        <a class="btn btn-danger" href="{{'/projects/delete/' . $project->id}}" >Delete</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
