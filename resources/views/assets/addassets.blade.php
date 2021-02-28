@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'View Assets ' => route('view-assets'),
    'Add Assets ' => route('add-assets'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Assets') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit_assets') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="assets_name" class="col-md-4 col-form-label text-md-right">{{ __('Assets Name') }}</label>

                            <div class="col-md-6">
                                <input id="assets_name" type="text" class="form-control @error('assets_name') is-invalid @enderror" name="assets_name" value="{{ old('assets_name') }}" required autocomplete="assets_name">

                                @error('assets_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="assets_details" class="col-md-4 col-form-label text-md-right">{{ __('Assets Details') }}</label>

                            <div class="col-md-6">
                                <input id="assets_details" type="text" class="form-control @error('assets_details') is-invalid @enderror" name="assets_details" value="{{ old('assets_details') }}" required autocomplete="assets_details">

                                @error('assets_details')
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
