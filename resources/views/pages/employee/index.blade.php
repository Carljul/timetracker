@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Employees') }}</div>
                <div class="card-body">
                    <p>Welcome {{\Auth::user()->load(['employee'])->employee->person->fullname}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
