@extends('master')

@section('content')
    <div class="container mt-5">

        @if ($message)
            <div class="alert alert-info" role="alert">
                {{$message}}
            </div>
        @endif

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID #</th>
                    <th scope="col">Todo`s</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data) > 0)
                    @foreach ($data as $todo)
                        <tr>
                            <th scope="row">{{$todo->id}}</th>
                            <td>{{$todo->todo}}</td>
                            <td>{{$todo->created_at->diffForHumans()}}</td>
                            <td>{{$todo->updated_at->diffForHumans()}}</td>
                            <td colspan="2">
                                <button type="button" class="btn btn-primary" onclick="handleUpdate({{$todo}})" data-toggle="modal"
                                    data-target="#updateModal">
                                    Update
                                </button>
                                <button type="button" class="btn btn-danger">
                                    <a href="/delete/{{$todo->id}}" class="text-decoration-none text-light">Delete</a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="5">Empty!</th>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Todo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="todo">Enter Todo</label>
                            <input required type="text" class="form-control" name="todo">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Todo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/update">
                    @csrf
                    <input name="id" id="updateId" hidden/>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="todo">Enter Todo</label>
                            <input required id="updateTodo" type="text" class="form-control" name="todo">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const handleUpdate = ({id,todo}) =>{
            let formId = document.getElementById("updateId")
            let formTodo = document.getElementById("updateTodo")
            formId.value = id;
            formTodo.value = todo;
        }
    </script>
@endsection
