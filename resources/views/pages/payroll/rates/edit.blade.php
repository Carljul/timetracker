@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update employee rate') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{route('payroll.rate.update', $rate->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="employeeId" class="col-md-4 col-form-label text-md-end">{{ __('Employee ID') }}</label>

                            <div class="col-md-6 d-flex align-items-center">
                                <span>{{$rate->employee_id}}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="employeeName" class="col-md-4 col-form-label text-md-end">{{ __('Employee Name') }}</label>

                            <div class="col-md-6 d-flex align-items-center">
                                <span>{{$rate->employee->person->fullname}}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jobTitle" class="col-md-4 col-form-label text-md-end">{{ __('Job title') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="jobTitle" value="{{ old('jobTitle', $rate->employee_title) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="rate" class="col-md-4 col-form-label text-md-end">{{ __('Employee Salary Rate') }}</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" name="rate" step=".01" value="{{ number_format(old('rate', $rate->rate), 2) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="rate" class="col-md-4 col-form-label text-md-end">{{ __('Employee OT Rate') }}</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" name="ot_rate" step=".01" value="{{ number_format(old('ot_rate', $rate->ot_rate), 2) }}">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{route('payroll.rate.index')}}" class="btn btn-warning">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
