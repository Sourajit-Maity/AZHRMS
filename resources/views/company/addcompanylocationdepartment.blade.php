@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Company Master' => route('view-company'),
    'Company Location' => route('view-company-location'),
    'View Subunit' => route('view-company-location-subunit'),
    'Add Subunit' => route('add-company-location-subunit'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Subunit') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit_company_location_subunit') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="d_name" class="col-md-4 col-form-label text-md-right">{{ __('Subunit') }}</label>

                            <div class="col-md-6">
                                <input id="d_name" type="text" class="form-control @error('d_name') is-invalid @enderror" name="d_name" value="{{ old('d_name') }}" required autocomplete="d_name" autofocus>

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
                             
                                <select  name="operational_company_location_id" id="operational_company_location_id" class="form-control @error('operational_company_location_id') is-invalid @enderror" name="operational_company_location_id" value="{{ old('operational_company_location_id') }}" required autocomplete="operational_company_location_id">
                                 <option value="" disabled selected>Select Location</option>
                                    @foreach($subunit as $companys)
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
                            <select  name="type" id="type" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required autocomplete="type">
                                                       <option value="" disabled selected>Select Type</option>
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
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone No') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone " autofocus>

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
                                <input id="fax" type="text" class="form-control" name="fax" value="{{ old('fax') }}" autocomplete="fax " autofocus>

                            </div>
                        </div>
                       
                       
     
  
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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
