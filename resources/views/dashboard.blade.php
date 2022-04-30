@extends('layouts.app')
@section('content')
 
  <div class="col-md-7 mt-5">
        <!-- show login crediential -->
        <div class="card">
            <div class="card-header">
                <h5>
                    <i class="fa fa-align-justify"></i>
                    <span>Login Crediential</span>
                </h5>
            </div>
            <div class="card-body">
             <div class="row ">
                 <div class="col-md-8 mt-5">
                      <h2 class="text-center">Welcome {{Auth::user()->name}}</h2>
                 </div>


        </div>
  </div>        


  </div>
            
  
@endsection
