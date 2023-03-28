$(document).ready( function () {
    window._token = $('meta[name="csrf-token"]').attr('content')
} );

$( function() {
    $( "#sortable" ).sortable({
        stop:function(){
            let tasks = [];
            $("#sortable > tr").each(function (){
                tasks.push($(this).attr("id"));
            });
            updateOrder(tasks);
        },
    });
} );

function updateOrder(tasks)
{
    $.ajax({
        headers: {'x-csrf-token': _token},
        url: "tasks/reorder",
        method: 'post',
        data: {tasks},
        success: function (){
            window.location.reload();
        },
    });
}

function GetProjectTasks () {
   $("#projects").on('change', function (){
       const options = { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' };
       let project_id = $(this).val();
       $.ajax({
            headers: {'x-csrf-token': _token},
            url: 'projects/getProjectTasks',
            method: 'post',
            data: {project_id},
            success: function (tasks) {
              $('#sortable').empty();
              let id = 1;
              $.each(tasks, function(key, task) {
                  currentDate = new Date(task.created_at);
                  $('<tr id='+task.id+'>').append(
                      $('<td>').text(id++),
                      $('<td>').text(task.name),
                      $('<td>').text(task.project.name),
                      $('<td>').text(task.priority),
                      $('<td>').text(currentDate.toLocaleDateString('en-US')),
                      $('<td>').html(
                          '<a class="btn btn-primary" href=tasks/edit/'+task.id+'>Edit</a>\n' +
                          '<a class="btn btn-danger" methods="post" href="tasks/destroy/' + task.id + '" >Delete</a>')
                  ).appendTo('#sortable');
              });
          },
       });
   });
}

GetProjectTasks();
