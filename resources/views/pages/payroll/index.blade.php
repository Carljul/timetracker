@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7"><h3>Payroll</h3></div>
        <div class="col-md-3">
            <form action="" method="GET">
                <div class="input-group mb-3">
                  <input type="text" name="dates" class="form-control" aria-describedby="date-picker">
                  <button class="btn btn-outline-primary" type="submit" id="date-picker">Draft Payroll</button>
                </div>
            </form>
        </div>
    </div>
    @if (isset($timelogs) && count($timelogs) > 0)
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('pages.payroll.components.employee-list', $timelogs)
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-sm-6">
                        <h5>Pay & Timesheets</h5>
                    </div>
                    <div class="col-sm-6">
                        <form action="" method="POST">
                            <button class="btn btn-success float-end btn-sm" type="submit">Generate Payroll</button>
                        </form>
                    </div>
                </div>
                @include('pages.payroll.components.employee-cards', $timelogs)
            </div>
        </div>
    @endif
</div>
@endsection
