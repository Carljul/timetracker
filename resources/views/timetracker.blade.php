@extends('layouts.app')

@push('js')
    <script>
        $(document).ready(function () {
            $('#btnTimeIn').on('click', function () {
                let action = $('#timeActivity').attr('action');
                if ($('#idNumber').val()) {
                    $.ajax({
                        type: 'POST',
                        url: action,
                        data: {'employee_id': $('#idNumber').val()},
                        success: function (response) {
                            console.log(response)
                            if (!response.withRecord && response.exists) {
                                $('#activityForm').attr('action', "{{route('timelog.store')}}");
                                $('#idNumberInput').val(response.employee_id);
                                $('#activity').html('Time In: '+response.readable);
                                $('#exampleModal').modal('show');
                                $('input[name="_method"]').remove();
                            } else if (!response.exists) {
                                alert('Employee ID number not found');
                            } else {
                                alert('You already have time in for this day');
                            }
                        }
                    });
                }
            });
            $('#btnTimeOut').on('click', function () {
                let action = $('#timeActivity').attr('action');

                if ($('#idNumber').val() != '') {
                    $.ajax({
                        type: 'POST',
                        url: action,
                        data: {'employee_id': $('#idNumber').val()},
                        success: function (response) {
                            if (response.withTimeOut) {
                                alert('You have time out already');
                            }else if (response.withRecord && response.exists) {
                                $('#activityForm').attr('action', '/timelog/'+response.employee_id);
                                $('#idNumberInput').val(response.employee_id);
                                $('#activityForm').append('<input type="hidden" name="_method" value="PUT">');
                                $('#activity').html('Time Out: '+ response.readable);
                                $('#exampleModal').modal('show');
                            } else if (!response.exists) {
                                alert('Employee ID number not found');
                            } else if (!response.withRecord) {
                                alert('You have no time in yet');
                            }
                        }
                    });
                }
            });

            $('#activityForm').on('submit', function () {
                $('#activityForm button').attr('disabled', true);
            });
        });
    </script>
@endpush

@section('content') 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="text-center">
                                    Byte N Cool Timetracker
                                </h4>
                                <div action="{{route('timelog.show')}}" id="timeActivity" class="mt-4">
                                    <input type="text" class="form-control form-control-lg text-center" name="idNumber" id="idNumber" placeholder="Enter ID Number" required>
                                    <p style="color: red;">Field is required</p>
                                    <div class="row mt-4">
                                        <div class="col-sm-6">
                                            <button class="form-control btn btn-info" id="btnTimeIn">Time In</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button class="form-control btn btn-danger" id="btnTimeOut">Time Out</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-8 text-center">
                <a href="{{ route('login') }}">{{ __('Register User') }}</a>
            </div>
        </div>
    </div>

  
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to <span id="activity"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="" method="post" id="activityForm">
                    @csrf
                    <input type="hidden" name="employee_id" id="idNumberInput">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection
