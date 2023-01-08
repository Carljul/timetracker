@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-8">
            <a href="{{route('employee.create')}}" class="btn btn-primary" style="float: right;">{{__('Add Employee')}}</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Employees') }}</div>

                <div class="card-body">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>Name</th>
                                <th>Employeed</th>
                                <th>Resigned</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $employee)
                                <tr>
                                    <td>{{$employee->employee_gen_id}}</td>
                                    <td>{{$employee->person->fullname}}</td>
                                    <td>{{$employee->date_employed}}</td>
                                    <td>{{$employee->date_resigned}}</td>
                                    <td class="d-flex">
                                        <a href="{{route('employee.edit', $employee->id)}}" class="btn btn-warning mx-2">Edit</a>
                                        <form action="{{route('employee.destroy', $employee->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"><span class="text-center">No Record Found</span></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{$employees->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
