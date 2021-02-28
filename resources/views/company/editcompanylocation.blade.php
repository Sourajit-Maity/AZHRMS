@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Company Master' => route('view-company'),
    'Company Location' => route('view-company-location'),
    'Edit Company Location' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Location') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('update-company-location', $location->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="l_name" class="col-md-4 col-form-label text-md-right">{{ __('Location Name') }}</label>

                            <div class="col-md-6">
                                <input id="l_name" type="text" class="form-control @error('l_name') is-invalid @enderror" name="l_name" value="{{ $location->l_name }}" required autocomplete="l_name" autofocus>

                                @error('l_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="operational_company_id" class="col-md-4 col-form-label text-md-right">{{ __('Operational Company') }}</label>

                            <div class="col-md-6">
                             
                                <select  name="operational_company_id" id="operational_company_id" class="form-control @error('operational_company_id') is-invalid @enderror" name="operational_company_id" value="{{ old('operational_company_id') }}" required autocomplete="operational_company_id">
                                @if($location->operational_company_id != null) 
                                @foreach($editlocation as $editlocations)
                                        <option value="{{$editlocations->company_id}}">{{$editlocations->company_name}}</option>
                                    @endforeach
                                    @else  
                                    <option value="" disabled selected>Select Company</option>
                                        
                                @endif
                                
                                
                                    @foreach($company as $companys)
                                        <option value="{{$companys->id}}">{{$companys->c_name}}</option>
                                    @endforeach                                            
                                                      
                             </select>
                                @error('operational_company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="district" class="col-md-4 col-form-label text-md-right">{{ __('District') }}</label>

                            <div class="col-md-6">
                             
                                <select  name="district" id="district" class="form-control @error('district') is-invalid @enderror" name="district" value="{{ $location->district }}" required autocomplete="district">
                                @if($location->district != null) 
                                @foreach($editdistrict as $editdistricts)
                                        <option value="{{$editdistricts->district_id}}">{{$editdistricts->district_id}}</option>
                                    @endforeach
                                    @else  
                                    <option value="" disabled selected>Select District</option>
                                        
                                @endif
                                    @foreach($district as $districts)
                                        <option value="{{$districts->district_name}}">{{$districts->district_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $location->city }}" required autocomplete="city " autofocus>

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $location->address }}" required autocomplete="address " autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="zip_code" class="col-md-4 col-form-label text-md-right">{{ __('Zip Code') }}</label>

                            <div class="col-md-6">
                                <input id="zip_code" type="text" class="form-control @error('zip_code') is-invalid @enderror" name="zip_code" value="{{ $location->zip_code }}" required autocomplete="zip_code " autofocus>

                                @error('zip_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $location->phone }}" required autocomplete="phone " autofocus>

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
                                <input id="fax" type="text" class="form-control" name="fax" value="{{ $location->fax }}"  autocomplete="fax " autofocus>

                                
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
                        <div class="form-group row">
                            <label for="operational_company_location_id" class="col-md-4 col-form-label text-md-right"><a href="{{route('add-company-location-subunit')}}"> {{ __('Add Subunit') }}  </a></label>
                            <label for="operational_company_location_id" class="col-md-4 col-form-label text-md-right"><a href="{{ route('view-location-subunit',[$location->id]) }}"> {{ __('View Subunit') }}  </a></label>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('footerimport')
@endsection
