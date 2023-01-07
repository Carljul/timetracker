@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register Employee') }}</div>

                <div class="card-body">
                    @include('pages.employees.parts', [
                        'isEdit' => false,
                        'firstname' => '',
                        'middlename' => '',
                        'lastname' => '',
                        'suffix' => '',
                        'birthdate' => '',
                        'employeed' => '',
                        'resigned' => '',
                        'buttonText' => 'Register'
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
