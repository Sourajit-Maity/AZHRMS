@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'State' => route('view-state'),
    'Edit State' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit State') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('update-state', $type->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="state_name" class="col-md-4 col-form-label text-md-right">{{ __('State Name') }}</label>

                            <div class="col-md-6">
                                <input id="state_name" type="text" class="form-control @error('state_name') is-invalid @enderror" name="state_name"  value="{{ $type->state_name }}" required autocomplete="state_name">

                                @error('state_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
