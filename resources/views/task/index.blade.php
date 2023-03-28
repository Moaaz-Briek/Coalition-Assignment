@extends('layout.layout')
@section('content')
    <main class="mt-5">
        <div class="container">
            <div class="d-flex justify-content-between col align-self-start align-items-center pt-3 pb-2 mb-5 border-bottom">
                <h2 class="text-black-50">Task Management</h2>
                <div>
                    <a href="{{url('tasks/create')}}" class="btn btn-primary">Create A Task</a>
                    <a href="{{url('projects/')}}" class="btn btn-secondary">Manage Projects</a>
                </div>
            </div>
            <div class="row mb-3 justify-content-center">
                <h2 class="col-lg-3 col-sm-4 form-label fw-light">Select A Project:-</h2>
                <div class="col-lg-9 col-sm-8">
                    <select class="form-control border-1 border-dark" id="projects" autocomplete="off">
                        <option selected disabled value="">select</option>
                        <option value="all">All</option>
                        @foreach($projects as $project)
                            <option value="{{$project->id}}">{{$project->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="text-center table datatable" id="myTable">
                    <thead>
                    <tr>
                        <th class="col-lg-2 col-sm-1">ID</th>
                        <th>Task Name</th>
                        <th>Project Name</th>
                        <th>Task Priority</th>
                        <th>Creation Time</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tbody id="sortable">
                    <?php $i = 1; ?>
                    @foreach($tasks as $task)
                    <tr id="{{$task->id}}" >
                        <td class="col-lg-2 col-sm-1">{{$i++}}</td>
                        <td>{{$task->name}}</td>
                        <td>{{$task->project->name}}</td>
                        <td>{{$task->priority}}</td>
                        <td>
                            @php
                                $dt = new DateTime($task->created_at);
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
                            <a class="btn btn-primary" href="{{url('tasks/edit', $task->id)}}">Edit</a>
                            <a class="btn btn-danger" methods="post" href="{{'tasks/destroy/' . $task->id}}" >Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </main>
@endsection
