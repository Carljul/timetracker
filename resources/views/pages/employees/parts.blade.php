
<form method="POST" action="{{$isEdit ? route('employee.update', $employee->id) : route('employee.store')}}">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif
    <div class="row mb-3">
        <label for="firstname" class="col-md-4 col-form-label text-md-end">{{ __('First Name *') }}</label>

        <div class="col-md-6">
            <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname', $firstname) }}" required autofocus>

            @error('firstname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="middlename" class="col-md-4 col-form-label text-md-end">{{ __('Middle Name') }}</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="middlename" value="{{ old('middlename', $middlename) }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('Last Name *') }}</label>

        <div class="col-md-6">
            <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname', $lastname) }}">

            @error('lastname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="suffix" class="col-md-4 col-form-label text-md-end">{{ __('Suffix') }}</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="suffix" value="{{ old('suffix', $suffix) }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="birthdate" class="col-md-4 col-form-label text-md-end">{{ __('birthdate') }}</label>

        <div class="col-md-6">
            <input type="date" class="form-control" name="birthdate" value="{{ old('birthdate', $birthdate) }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="employeed" class="col-md-4 col-form-label text-md-end">{{ __('Date employeed') }}</label>

        <div class="col-md-6">
            <input type="date" class="form-control" name="employeed" value="{{ old('employeed', $employeed) }}">
        </div>
    </div>

    @if(!$isEdit)
    <div class="row mb-3">
        <label for="jobTitle" class="col-md-4 col-form-label text-md-end">{{ __('Job title') }}</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="jobTitle" value="">
        </div>
    </div>
    <div class="row mb-3">
        <label for="rate" class="col-md-4 col-form-label text-md-end">{{ __('Employee Salary Rate') }} <small>(Per day)</small></label>

        <div class="col-md-6">
            <input type="number" class="form-control" name="rate" value="">
        </div>
    </div>
    @endif
    @if($isEdit)
    <div class="row mb-3">
        <label for="resigned" class="col-md-4 col-form-label text-md-end">{{ __('Date Resigned') }}</label>

        <div class="col-md-6">
            <input type="date" class="form-control" name="resigned" value="{{ old('resigned', $resigned) }}">
        </div>
    </div>
    @endif

    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ $buttonText }}
            </button>
            <a href="{{route('employee.index')}}" class="btn btn-warning">Cancel</a>
        </div>
    </div>
</form>