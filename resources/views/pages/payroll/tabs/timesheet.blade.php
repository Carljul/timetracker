<div class="row border-bottom fw-bold py-1">
    <div class="col-sm-2">Date</div>
    <div class="col-sm-2">Time In</div>
    <div class="col-sm-2">Time Out</div>
    <div class="col-sm-1">OT</div>
    <div class="col-sm-1">Late</div>
    <div class="col-sm-2">Undertime</div>
    <div class="col-sm-2">Actions</div>
</div>
@forelse ($logs as $log)
    <form action="" method="POST" class="row border-bottom py-1">
        <div class="col-sm-2">{{$log->activity_date}}</div>
        <div class="col-sm-2"><input type="time" value="{{$log->time_in}}"></div>
        <div class="col-sm-2"><input type="time" value="{{$log->time_out}}"></div>
        <div class="col-sm-1">1hr/s</div>
        <div class="col-sm-1">1hr/s</div>
        <div class="col-sm-2">1hr/s</div>
        <div class="col-sm-2"><button type="submit" class="btn btn-sm btn-success">Save</button></div>
    </form>
@empty
    <b>No Record found</b>
@endforelse


