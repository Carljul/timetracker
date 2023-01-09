@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Reports') }}</div>
                <div class="card-body">
                    <form action="" method="post" class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <label for="dateFrom" class="col-md-2">{{ __('From') }}</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control" name="dateFrom" value="{{ old('dateFrom') }}">
                                    </div>
                                    <label for="dateFrom" class="col-md-1">{{ __('To') }}</label>
                                    <div class="col-md-5">
                                        <input type="date" class="form-control" name="dateTo" value="{{ old('dateTo') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Time IN</th>
                                        <th>Time OUT</th>
                                        <th>Undertime</th>
                                        <th>Overtime</th>
                                        <th>Late</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($timelogs as $timelog)
                                        <tr>
                                            <td>{{$timelog->activity_date}}</td>
                                            <td>{{$timelog->employee->person->fullname}}</td>
                                            <td>{{$timelog->time_in}}</td>
                                            <td>{{$timelog->time_out}}</td>
                                            <td>{{$timelog->undertime}}</td>
                                            <td>{{$timelog->overtime}}</td>
                                            <td>{{$timelog->late}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">
                                                <p class="text-center m-0">No record found</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
