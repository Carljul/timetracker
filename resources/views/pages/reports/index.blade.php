@extends('layouts.app')

@push('js')
    <script>
        $(document).ready(function () {
            $('#selectAll').on('click', function () {
                if ($(this).is(":checked")) {
                    $('#employeeGroup input').prop('checked', true);
                } else {
                    $('#employeeGroup input').prop('checked', false);
                }
            });
        })
    </script>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Reports') }}</div>
                <div class="card-body">
                    <form action="" method="post" class="mb-3">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <label for="dateFrom" class="col-md-2">{{ __('From') }}</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control @error('dateFrom') is-invalid @enderror" name="dateFrom" value="{{ old('dateFrom') }}">
                                        @error('dateFrom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <label for="dateFrom" class="col-md-1">{{ __('To') }}</label>
                                    <div class="col-md-5">
                                        <input type="date" class="form-control @error('dateTo') is-invalid @enderror" name="dateTo" value="{{ old('dateTo') }}">
                                        @error('dateTo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Export</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>ID Number</th>
                                        <th>Name</th>
                                        <th>Time IN</th>
                                        <th>Time OUT</th>
                                        <th>Undertime</th>
                                        <th>Overtime</th>
                                        <th>Late</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($timelogs as $timelog)
                                        <tr>
                                            <td>{{$timelog->activity_date}}</td>
                                            <td>{{$timelog->employee->employee_gen_id}}</td>
                                            <td>{{$timelog->employee->person->fullname}}</td>
                                            <td>{{$timelog->time_in}}</td>
                                            <td>{{$timelog->time_out}}</td>
                                            <td>{{$timelog->undertime}}</td>
                                            <td>{{$timelog->overtime}}</td>
                                            <td>{{$timelog->late}}</td>
                                            <td>
                                                <script>
                                                    $(document).ready(function () {
                                                        $('#deleteBtn{{$timelog->id}}').on('click', function () {
                                                            $('#deleteModal{{$timelog->id}}').modal('show');
                                                        });
                                                    })
                                                </script>
                                                <button type="button" class="btn btn-danger" id="deleteBtn{{$timelog->id}}">
                                                    Delete
                                                </button>
                                                <div class="modal fade" id="deleteModal{{$timelog->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$timelog->id}}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete timelog for <br>{{$timelog->activity_date}} <br> {{$timelog->time_in}} - {{$timelog->time_out}}?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <form action="{{route('timelog.destroy', $timelog->id)}}" method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-primary">Confirm</button>
                                                            </form>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modify data to export</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('report.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="dateFrom" class="form-label">Date From</label>
                        <input type="date" class="form-control @error('dateFrom') is-invalid @enderror" name="dateFrom" value="{{old('dateFrom')}}">
                        @error('dateFrom')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                      <label for="dateTo" class="form-label">Date To</label>
                      <input type="date" class="form-control @error('dateTo') is-invalid @enderror" name="dateTo" value="{{old('dateTo')}}">
                      @error('dateTo')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                        <label class="form-check-label" for="selectAll">
                          Select All
                        </label>
                    </div>

                    @error('employee')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="btn-group" id="employeeGroup" role="group" aria-label="Basic checkbox toggle button group" style="display: grid; grid-template-columns: 1fr 1fr 1fr;">
                        @foreach ($employees as $employee)
                            <input type="checkbox" class="btn-check" id="{{$employee->employee_gen_id}}" name="employee[]" value="{{$employee->employee_gen_id}}">
                            <label class="btn btn-outline-primary" for="{{$employee->employee_gen_id}}">{{$employee->person->fullname}}</label>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Export</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
