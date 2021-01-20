@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Leave' => '#',
    'Configure' => '#',
    'View Work Week' => route('view-work-week'),
'This page',
]])
@section('plugins.Datatables', true)
 

		<div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Leave Type List</h2>
                
            </div>
           
            
        </div>
            <div class="table-responsive">
			<div class="table-responsive">

            <table id="myTable"  class="table table-bordered  table-striped {{ count($workweek) > 0 ? 'datatable' : '' }} pointer">
					<thead>
					<tr>
                       <th>Monday</th>
                       <th>Tuesday</th>
                       <th>Wednesday</th>
                       <th>Thursday</th>
                       <th>Friday</th>
                       <th>Saturday</th>
                       <th>Sunday</th>
                        
                        <th>Actions</th>

					</tr>
					</thead>

					<tbody>
					@if (count($workweek) > 0)
						@foreach ($workweek as $key => $value)
							<tr data-entry-id="{{ $value->id }}" data-order="{{$value->id}}">

							@if($value->mon =='0') 
								<td>Full Day</td>
                            @elseif($value->mon =='1')
                                <td>Half Day</td>
                            @else  
                               <td>Non Working Day</td>  
                            @endif
                            @if($value->tue =='0') 
								<td>Full Day</td>
                            @elseif($value->tue =='1')
                                <td>Half Day</td>
                            @else  
                               <td>Non Working Day</td>  
                            @endif
                            @if($value->wed =='0') 
								<td>Full Day</td>
                            @elseif($value->wed =='1')
                                <td>Half Day</td>
                            @else  
                               <td>Non Working Day</td>  
                            @endif
                            @if($value->thu =='0') 
								<td>Full Day</td>
                            @elseif($value->thu =='1')
                                <td>Half Day</td>
                            @else  
                               <td>Non Working Day</td>  
                            @endif
                            @if($value->fri =='0') 
								<td>Full Day</td>
                            @elseif($value->fri =='1')
                                <td>Half Day</td>
                            @else  
                               <td>Non Working Day</td>  
                            @endif
                            @if($value->sat =='0') 
								<td>Full Day</td>
                            @elseif($value->sat =='1')
                                <td>Half Day</td>
                            @else  
                               <td>Non Working Day</td>  
                            @endif
                            @if($value->sun =='0') 
								<td>Full Day</td>
                            @elseif($value->sun =='1')
                                <td>Half Day</td>
                            @else  
                               <td>Non Working Day</td>  
                            @endif
                               

                              
                                <td> <a href="{{ route('edit-work-week',[$value->id]) }}" class="btn btn-xs btn-info">
                                       <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i><i class="fas fa-edit"></i></a>
                             
                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
  

