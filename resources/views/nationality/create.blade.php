@extends('adminlte::page')

@section('content')
<div class="row">
<div class="form-group col-md-6">
            <h2>Create New Nationality</h2>
        </div>
        
    

    
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Warning!</strong> Please check your input code<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('nationality.store') }}" method="PUT">
    @csrf
     
        <!-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" class="form-control" placeholder="Title">
            </div>
        </div> -->
        <div class="form-group col-md-12">
                
                <input type="text" class="form-control" name="name"  >
                <!-- <textarea class="form-control" style="height:150px" name="description" placeholder="Description"></textarea> -->
            </div>
             </div>
       
             <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="form-group col-md-6">
            <a class="btn btn-primary" href="{{ route('nationality.index') }}"> Back</a>
        </div>
   
</form>
@endsection