@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome {{\Auth::user()->load(['employee'])->employee->person->fullname}}</div>
                <div class="card-body">
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
