@extends('adminlte::page')

@section('content')
    <div class="row">
    <div class="form-group col-md-6">
                <h2>Check all Nationality</h2>
            </div>
            <div class="form-group col-md-6">
                <a class="btn btn-success" href="{{ route('nationality.create') }}"> Create new Nationality</a>
            </div>
        </div>
   
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered table-striped {{ count($nationality) > 0 ? 'datatable' : '' }} pointer">
 
        <tr>
            <th>Sl. No.</th>
            
            <th>Name</th>
            <th width="250px">Action</th>
        </tr>
        @foreach ($nationality as $nationalities)
        <tr>
            <td>{{ ++$i }}</td>
            <!-- <td>{{ $nationalities->title }}</td> -->
            <td>{{ $nationalities->name }}</td>
            <td>
                <form action="{{ route('nationality.destroy',$nationalities->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('nationality.show',$nationalities->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('nationality.edit',$nationalities->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $nationality->links() !!}
    @include('backend.datatable')
      
@endsection