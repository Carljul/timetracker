@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Employee Rates') }}</div>

                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Rate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rates as $rate)
                                <tr>
                                    <td>{{$rate->employee_id}}</td>
                                    <td>{{$rate->employee->person->fullname}}</td>
                                    <td>{{$rate->employee_title}}</td>
                                    <td>Php {{number_format($rate->rate, 2)}}</td>
                                    <td class="d-flex">
                                        <a href="{{route('payroll.rate.edit', $rate->id)}}" class="btn btn-warning mx-2">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"><p class="text-center m-0">No Record Found</p></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{$rates->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection