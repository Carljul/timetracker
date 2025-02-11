<div class="row w-100 mt-4">
    <div class="col-sm-4">
        <h4 class="mb-0 text-center">100 Hrs.</h4>
        <hr>
    </div>
    <div class="col-sm-2 lh-sm">
        <span class="mb-0">80 hrs.</span><br>
        <small>Regular</small>
    </div>
    <div class="col-sm-2 lh-sm">
        <span class="mb-0">20 hrs.</span><br>
        <small>Overtime</small>
    </div>
    <div class="col-sm-2 lh-sm">
        <span class="mb-0">8 hrs.</span><br>
        <small>Absences</small>
    </div>
    <div class="col-sm-2 lh-sm">
        <span class="mb-0">5 hrs.</span><br>
        <small>Undertime</small>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <h6 class="double-line">NET Pay: 8,700.00</h6>
        <button class="btn btn-sm btn-outline-primary float-end" type="button" data-bs-toggle="collapse" data-bs-target="{{'#paymentDetails'.$employeeId}}" aria-expanded="false" aria-controls="collapseExample">
          Show Payment Details
        </button>
        <div class="collapse" id="{{'paymentDetails'.$employeeId}}">
            <table class="table table-sm table-bordered table-striped">
                <tbody>
                    <tr>
                        <th colspan="2" class="text-center fs-6">Earnings</th>
                    </tr>
                    <tr>
                        <th class="fs-6">Basic Pay</th>
                        <td class="fs-6">10,000.00</td>
                    </tr>
                    <tr>
                        <th class="fs-6">O.T. Ordinary</th>
                        <td class="fs-6">0.00</td>
                    </tr>
                    <tr>
                        <th class="fs-6">R.D. O.T. (Special)</th>
                        <td class="fs-6">0.00</td>
                    </tr>
                    <tr>
                        <th class="fs-6">R.D. O.T. (Regular)</th>
                        <td class="fs-6">0.00</td>
                    </tr>
                    <tr>
                        <th class="fs-6">Special Holiday</th>
                        <td class="fs-6">0.00</td>
                    </tr>
                    <tr>
                        <th class="fs-6">Holiday</th>
                        <td class="fs-6">0.00</td>
                    </tr>
                    <tr>
                        <th class="fs-6">Total Earnings</th>
                        <th class="fs-6">10,000.00</th>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center fs-6">Deductions</th>
                    </tr>
                    <tr>
                        <th class="fs-6">Absences / Undertime (Per Hour)</th>
                        <td class="fs-6">0.00</td>
                    </tr>
                    <tr>
                        <th class="fs-6">SSS</th>
                        <td class="fs-6">900.00</td>
                    </tr>
                    <tr>
                        <th class="fs-6">Philhealth</th>
                        <td class="fs-6">300.00</td>
                    </tr>
                    <tr>
                        <th class="fs-6">Pagibig</th>
                        <td class="fs-6">100.00</td>
                    </tr>
                    <tr>
                        <th class="fs-6">SSS Loan</th>
                        <td class="fs-6">0.00</td>
                    </tr>
                    <tr>
                        <th class="fs-6">HDMF Loan</th>
                        <td class="fs-6">0.00</td>
                    </tr>
                    <tr>
                        <th class="fs-6">HMO</th>
                        <td class="fs-6">0.00</td>
                    </tr>
                    <tr>
                        <th class="fs-6">Other Deduction</th>
                        <td class="fs-6">0.00</td>
                    </tr>
                    <tr>
                        <th class="fs-6">Total Deductions</th>
                        <th class="fs-6">1,300.00</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    .double-line {
        display: inline-block;
        border-bottom: 3px double black;
        padding-bottom: 3px;
    }
</style>
