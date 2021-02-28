@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Job' => '#',
    'Language' => route('view-language'),
    'Add Language' => route('add-language'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD Language') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit_language') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="lng_name" class="col-md-4 col-form-label text-md-right">{{ __('Language Name') }}</label>

                            <div class="col-md-6">
                                <input id="lng_name" type="text" class="form-control @error('lng_name') is-invalid @enderror" name="lng_name" value="{{ old('lng_name') }}" required autocomplete="lng_name">

                                @error('lng_name')
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
