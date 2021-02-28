@extends('adminlte::page')

@section('content')

@include('include.breadcrumbs', ['breadcrumbs' => [
    'Leave' => '#',
    'Configure' => '#',
    'View Leave period' => route('view-leave-period'),

]])

@section('plugins.Datatables', true)
 

		<div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Leave Period</h2>
                
            </div>
            
			<div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-leave-period') }}"><i class="fas fa-plus-square"></i></a>
            </div>
        </div>
            <div class="table-responsive">
			<div class="table-responsive">

            <table id="myTable"  class="table table-bordered  table-striped {{ count($leaveperiods) > 0 ? 'datatable' : '' }} pointer">
					<thead>
					<tr>
                      
                       <th>Start Date</th>
                       <th>End Date</th>
                        
                        <th>Actions</th>

					</tr>
					</thead>

					<tbody>
					@if (count($leaveperiods) > 0)
						@foreach ($leaveperiods as $key => $value)
							<tr data-entry-id="{{ $value->id }}" data-order="{{$value->id}}">

				
                                <td>{!! \Carbon\Carbon::parse($value->leave_period_start_date)->format('d M Y') !!}</td>
                                <td>{!! \Carbon\Carbon::parse($value->leave_period_start_date)->addDays(364)->format('d M Y') !!}</td>
                              
                                <td> <a href="{{ route('leave-period',[$value->id]) }}" class="btn btn-xs btn-info">
                                       <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i><i class="fas fa-edit"></i></a>                             
                                </td>
						@endforeach

							</tr>
							@else
								<tr>
									<td colspan="7">No entries in table</td>
								</tr>
							@endif



					</tbody>
				</table>
			</div>
		</div>
	</div>
    @include('footerimport')
    @include('datatable')

	@endsection
  

