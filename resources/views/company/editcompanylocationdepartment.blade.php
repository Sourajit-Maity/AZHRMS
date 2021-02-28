@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Company Master' => route('view-company'),
    'Company Location' => route('view-company-location'),
    'View Subunit' => route('view-company-location-subunit'),
    'Edit Subunit' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('EDIT Subunit') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('update-company-location-subunit', $subunit->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="d_name" class="col-md-4 col-form-label text-md-right">{{ __('Subunit') }}</label>

                            <div class="col-md-6">
                                <input id="d_name" type="text" class="form-control @error('d_name') is-invalid @enderror" name="d_name" value="{{ $subunit->d_name }}" required autocomplete="d_name" autofocus>

                                @error('d_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="operational_company_location_id" class="col-md-4 col-form-label text-md-right">{{ __('Operational Subunit') }}</label>

                            <div class="col-md-6">
                             
                                <select  name="operational_company_location_id" id="operational_company_location_id" class="form-control @error('operational_company_location_id') is-invalid @enderror" name="operational_company_location_id" value="{{ $subunit->operational_company_location_id }}" required autocomplete="operational_company_location_id">
                                @if($subunit->operational_company_location_id != null) 
                                @foreach($editlocation as $editlocations)
                                        <option value="{{$editlocations->company_id}}">{{$editlocations->company_name}}</option>
                                    @endforeach
                                    @else  
                                    <option value="" disabled selected>Select Location</option>
                                        
                                @endif
                                
                                 
                                    @foreach($location as $companys)
                                        <option value="{{$companys->id}}">{{$companys->l_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('operational_company_location_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                            <select  name="type" id="type" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ $subunit->type }}" required autocomplete="type">
                            @if($subunit->type != null) 
                                @foreach($edittype as $edittypes)
                                        <option value="{{$edittypes->type_id}}">{{$edittypes->type_id}}</option>
                                    @endforeach
                                    @else  
                                    <option value="" disabled selected>Select Location</option>
                                        
                                @endif
                                                       
                                                       <option value='Department'>Department</option>
                                                        <option value='Projects'>Projects</option> 
                                                        <option value='Others'>Others</option>                                             
                                                     
                                                    </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $subunit->phone }}" required autocomplete="phone " autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fax" class="col-md-4 col-form-label text-md-right">{{ __('Fax') }}</label>

                            <div class="col-md-6">
                                <input id="fax" type="text" class="form-control" name="fax" value="{{ $subunit->fax }}" autocomplete="fax " autofocus>

                            </div>
                        </div>
                     
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                                <input type="button" onclick="history.go(-1);" value="Back" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('footerimport')
@endsection
