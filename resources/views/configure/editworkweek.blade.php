@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Leave' => '#',
    'Configure' => '#',
    'Edit Work Week' => '#',
'This page',
]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('EDIT Work week') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('update-work-week', $workweek->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="mon" class="col-md-4 col-form-label text-md-right">{{ __('Monday') }}</label>

                            <div class="col-md-6">
                            <select  name="mon" id="mon" class="form-control @error('leave_period_start_month') is-invalid @enderror" name="mon" value="{{ old('mon') }}" required autocomplete="mon">
                                                        <option value='0'>Full Day</option>
                                                        <option value='1'>Half Day</option>
                                                        <option value='2'>Non Working day</option>
                                                     
                                                    </select>
                                @error('mon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tue" class="col-md-4 col-form-label text-md-right">{{ __('Tuesday') }}</label>

                            <div class="col-md-6">
                            <select  name="tue" id="tue" class="form-control @error('tue') is-invalid @enderror" name="tue" value="{{ old('tue') }}" required autocomplete="tue">
                            <option value='0'>Full Day</option>
                                                        <option value='1'>Half Day</option>
                                                        <option value='2'>Non Working day</option>
                                                     
                                                    </select>
                                @error('tue')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="wed" class="col-md-4 col-form-label text-md-right">{{ __('Tuesday') }}</label>

                            <div class="col-md-6">
                            <select  name="wed" id="wed" class="form-control @error('wed') is-invalid @enderror" name="wed" value="{{ old('wed') }}" required autocomplete="wed">
                                                        <option value='0'>Full Day</option>
                                                        <option value='1'>Half Day</option>
                                                        <option value='2'>Non Working day</option>
                                                     
                                                    </select>
                                @error('wed')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="thu" class="col-md-4 col-form-label text-md-right">{{ __('Thursday') }}</label>

                            <div class="col-md-6">
                            <select  name="thu" id="thu" class="form-control @error('thu') is-invalid @enderror" name="thu" value="{{ old('thu') }}" required autocomplete="thu">
                            <option value='0'>Full Day</option>
                                                        <option value='1'>Half Day</option>
                                                        <option value='2'>Non Working day</option>
                                                     
                                                    </select>
                                @error('thu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fri" class="col-md-4 col-form-label text-md-right">{{ __('Friday') }}</label>

                            <div class="col-md-6">
                            <select  name="fri" id="fri" class="form-control @error('fri') is-invalid @enderror" name="fri" value="{{ old('fri') }}" required autocomplete="fri">
                            <option value='0'>Full Day</option>
                                                        <option value='1'>Half Day</option>
                                                        <option value='2'>Non Working day</option>
                                                     
                                                    </select>
                                @error('fri')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sat" class="col-md-4 col-form-label text-md-right">{{ __('Saturday') }}</label>

                            <div class="col-md-6">
                            <select  name="sat" id="sat" class="form-control @error('tue') is-invalid @enderror" name="sat" value="{{ old('sat') }}" required autocomplete="sat">
                            <option value='0'>Full Day</option>
                                                        <option value='1'>Half Day</option>
                                                        <option value='2'>Non Working day</option>
                                                     
                                                    </select>
                                @error('sat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sun" class="col-md-4 col-form-label text-md-right">{{ __('Sunday') }}</label>

                            <div class="col-md-6">
                            <select  name="sun" id="sun" class="form-control @error('sun') is-invalid @enderror" name="sun" value="{{ old('sun') }}" required autocomplete="sun">
                                                       <option value='0'>Full Day</option>
                                                        <option value='1'>Half Day</option>
                                                        <option value='2'>Non Working day</option>
                                                     
                                                    </select>
                                @error('sun')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

             
                        
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
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
