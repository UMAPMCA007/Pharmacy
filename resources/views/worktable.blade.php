@extends('layouts.app')
@section('content')
<div class="col-md-7 mt-5">
    <!-- model for table edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="post" id="editForm">
                        @csrf
                        
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <!-- show image -->
                        <div class="form-group">
                            <label for="image">Previous Image</label>
                            <img src="" alt="" id="p_image" width="100px" height="100px">
                        </div>    
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editBtn">Save changes</button>
                </div>
            </div>
        </div>
     </div>
    <!-- Table for uploded details-->
    <div class="card">
        <div class="card-header">
            <h5>
                <i class="fa fa-align-justify"></i>
                <span>Uploaded Work</span>
            </h5>
        </div>
        <!-- model for create -->
        <!-- button for create -->
        @if(Auth::user()->is_admin == 1)
            <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    <i class="fa fa-plus"></i>
                    Create
                </button>
            </div>
            <div class="form-group">
            <label for="search ">Search:</label>
                <input id="myInput" class="form-control col-md-4 " type="text" placeholder="Search..">
            </div> 
        @endif    
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form  method="post" id="createForm">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="createBtn">Save changes</button>
                    </div>
                </div>
            </div>
        </div>    

        <div class="card-body">
            <table class="table table-bordered" >
                <thead>
                    <tr>
                        <th>worker name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    @foreach($works as $work)
                    <tr>
                        <td>{{$work->name}}</td>
                        <td>{{$work->title}}</td>
                        <td>{{$work->description}}</td>
                        <td><img src="{{asset('images/'.$work->image)}}" alt="" width="100px" height="100px"></td>
                        <td>
                            <button id="{{$work->id}}" class="btn btn-primary edit">Edit</a>
                            @if(Auth::user()->is_admin==1)
                            <button  class="btn btn-danger delete" id="{{$work->id}}">Delete</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.edit').click(function(){
            var id = $(this).attr('id');
            $.ajax({
                url: "/work_edit/"+id,
                method: "get",
                data: {id:id},
                success: function(data){
                    $('#editModal').modal('show');
                    $('#id').val(data.id);
                    $('#title').val(data.title);
                    $('#description').val(data.description);
                    $('#p_image').attr('src', "{{asset('images/')}}"+"/"+data.image);
                
                }
            });
        });

        $('#editBtn').click(function(){
        var id = $('#id').val();
        console.log(id);
        var formData = new FormData($('#editForm')[0]);
        $.ajax({
            url: "/work_update/"+id,
            method: "post",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                $('#editModal').modal('hide');
                location.reload();
            }
        });
    });

    $('.delete').click(function(){
        var id = $(this).attr('id');
        $.ajax({
            url: "/work_delete/"+id,
            method: "get",
            success: function(data){
                location.reload();
            }
        });
    });

    $('#createBtn').click(function(){
        var formData = new FormData($('#createForm')[0]);
        $.ajax({
            url: "/work_create",
            method: "post",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                $('#createModal').modal('hide');
                location.reload();
            }
        });

    });

    $('#myInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#myTable tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

 });

    
    
</script>
@endSection