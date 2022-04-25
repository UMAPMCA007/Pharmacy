@extends('layouts.app')
@section('content')
<div class="col-md-7 mt-5">
    <!-- picture upload form -->
    <div class="card">
        <div class="card-header">
            <h5>
                <i class="fa fa-align-justify"></i>
                <span>Upload Work</span>
            </h5>
            <!-- validation error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <!-- success msg -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif    
        </div>
        <div class="card-body">
            <form action="{{route('work.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter Title">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Enter Description"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
</div>
@endsection