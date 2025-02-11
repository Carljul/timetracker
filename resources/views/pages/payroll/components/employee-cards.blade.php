
@forelse ($timelogs as $name => $logs)
    @php
        $employeeId = $logs[0]->employee_id;
    @endphp
    {{-- Cards --}}
    <div class="card mb-3" id="{{$employeeId}}">
        <div class="card-body">
            <div class="card-title">
                <h6 class="mb-0">Employee: {{$name}}</h6>
                <h6 class="mb-0">ID Number: {{$employeeId}}</h6>
            </div>

            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="{{'pay-tab'.$employeeId}}" data-bs-toggle="tab" data-bs-target="{{'#pay'.$employeeId}}" type="button" role="tab" aria-controls="home" aria-selected="true">Pay</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="{{'timesheet-tab'.$employeeId}}" data-bs-toggle="tab" data-bs-target="{{'#timesheet'.$employeeId}}" type="button" role="tab" aria-controls="profile" aria-selected="false">Timesheet</button>
                </li>
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="{{'pay'.$employeeId}}" role="tabpanel" aria-labelledby="{{'pay-tab'.$employeeId}}">
                    @include('pages.payroll.tabs.employee-pay', compact('logs', 'employeeId'))
                </div>
                <div class="tab-pane fade" id="{{'timesheet'.$employeeId}}" role="tabpanel" aria-labelledby="{{'timesheet-tab'.$employeeId}}">
                    @include('pages.payroll.tabs.timesheet', compact('logs', 'employeeId'))
                </div>
            </div>
        </div>
    </div>
@empty
    <b>No Record Found</b>
@endforelse
