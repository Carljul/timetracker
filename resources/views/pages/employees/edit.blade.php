@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Employee') }}</div>

                <div class="card-body">
                    @include('pages.employees.parts', [
                        'isEdit' => true,
                        'firstname' => $employee->person->firstname,
                        'middlename' => $employee->person->middlename,
                        'lastname' => $employee->person->lastname,
                        'suffix' => $employee->person->suffix,
                        'birthdate' => $employee->person->birthdate,
                        'employeed' => $employee->date_employed,
                        'resigned' => $employee->date_resigned,
                        'buttonText' => 'Update'
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
