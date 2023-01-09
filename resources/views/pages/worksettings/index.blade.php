@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Work Settings') }}</div>
                <div class="card-body">
                    @php
                        $route = route('timesetting.store');
                        $workstarts = '';
                        $workends = '';
                        if (!empty($timesetting)) {
                            $route = route('timesetting.update', $timesetting->id);
                            $workstarts = $timesetting->workstarts;
                            $workends = $timesetting->workends;
                        }
                    @endphp
                    <form method="POST" action="{{ $route }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="workstarts" class="col-md-4 col-form-label text-md-end">{{ __('Work Starts') }}</label>

                            <div class="col-md-6">
                                <input type="time" class="form-control @error('workstarts') is-invalid @enderror" name="workstarts" value="{{ old('workstarts', $workstarts) }}">

                                @error('workstarts')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="workends" class="col-md-4 col-form-label text-md-end">{{ __('Work Ends') }}</label>

                            <div class="col-md-6">
                                <input type="time" class="form-control @error('workends') is-invalid @enderror" name="workends" value="{{ old('workends', $workends) }}">

                                @error('workends')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary form-control">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
