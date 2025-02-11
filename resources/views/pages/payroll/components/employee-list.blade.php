
<h5>Employees</h5>
<ul class="list-unstyled">
    @forelse ($timelogs as $name => $log)
        @php
            $employeeId = $log[0]->employee_id;
        @endphp
        <li><a href="#{{$employeeId}}" class="btn btn-primary text-white mb-1 w-100">{{$name}}</a></li>
    @empty
        <li><b>No Record Found</b></li>
    @endforelse
</ul>
