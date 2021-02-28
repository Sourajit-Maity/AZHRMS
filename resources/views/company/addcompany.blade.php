@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Company Master' => route('view-company'),
    'Add Company' => route('add-company'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Company') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit_company') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="c_name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>

                            <div class="col-md-6">
                                <input id="c_name" type="text" class="form-control @error('c_name') is-invalid @enderror" name="c_name" value="{{ old('c_name') }}" required autocomplete="c_name" autofocus>

                                @error('c_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="res_company_name" class="col-md-4 col-form-label text-md-right">{{ __('Company Abbreviation') }}</label>

                            <div class="col-md-6">
                                <input id="res_company_name" type="text" class="form-control @error('res_company_name') is-invalid @enderror" name="res_company_name" value="{{ old('res_company_name') }}" placeholder="(1-4 Characters)" required autocomplete="res_company_name" autofocus>

                                @error('res_company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tax_id" class="col-md-4 col-form-label text-md-right">{{ __('Tax Id No') }}</label>

                            <div class="col-md-6">
                                <input id="tax_id" type="text" class="form-control @error('tax_id') is-invalid @enderror" name="tax_id" value="{{ old('tax_id') }}" required autocomplete="tax_id " autofocus>

                                @error('tax_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="registration_number" class="col-md-4 col-form-label text-md-right">{{ __('Registration No') }}</label>

                            <div class="col-md-6">
                                <input id="registration_number" type="text" class="form-control @error('registration_number') is-invalid @enderror" name="registration_number" value="{{ old('registration_number') }}" required autocomplete="registration_number " autofocus>

                                @error('registration_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
