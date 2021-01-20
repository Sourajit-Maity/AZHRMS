@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'User Role Categories' => '#',
    'Add Sub Role' => route('add-sub-role'),
'This page',
]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD Sub Role') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit_role') }}">
                        @csrf
                        <div class="form-group row">
                           <label for="role_id " class="col-md-4 col-form-label text-md-right">{{ __('ROLE') }}</label>

                            <div class="col-md-6">
                            
                                <select id="role_id " name="role_id" class="form-control">
                                    <option value="" disabled selected>Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                        <div class="form-group row">
                            <label for="respname" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="respname" type="text" class="form-control @error('respname') is-invalid @enderror" name="respname" value="{{ old('respname') }}" required autocomplete="respname" autofocus>

                                @error('respname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="form-group row">
                            <label for="resp_display_name" class="col-md-4 col-form-label text-md-right">{{ __('Display Name') }}</label>

                            <div class="col-md-6">
                                <input id="resp_display_name" type="text" class="form-control @error('resp_display_name') is-invalid @enderror" name="resp_display_name" value="{{ old('resp_display_name') }}" required autocomplete="resp_display_name">

                                @error('resp_display_name')
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
