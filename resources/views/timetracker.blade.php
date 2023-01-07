@extends('layouts.app')

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
                                <form action="" id="timeActivity" class="mt-4">
                                    <input type="text" class="form-control form-control-lg text-center" name="idNumber" placeholder="Enter ID Number">
                                    <div class="row mt-4">
                                        <div class="col-sm-6">
                                            <button class="form-control btn btn-info" id="btnTimeIn">Time In</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button class="form-control btn btn-danger" id="btnTimeOut">Time Out</button>
                                        </div>
                                    </div>
                                </form>
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
@endsection
