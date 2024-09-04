@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="type" class="col-md-4 col-form-label text-md-end">Register As</label>
                                <div class="col-md-6">
                                    <select id="type" name="type" class="form-control" required
                                        onchange="getRespectiveFields()">
                                        {{-- <option value="">Select Type</option> --}}
                                        <option value="candidate">Candidate</option>
                                        <option value="company">Company</option>
                                    </select>
                                    @error('type')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div id="candidate-fields" style="display: none;">
                                <div class="row mb-3">
                                    <label for="phone_number" class="col-md-4 col-form-label text-md-end">Phone
                                        Number</label>
                                    <div class="col-md-6">
                                        <input id="phone_number" type="text"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            name="phone_number" value="{{ old('phone_number') }}">
                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="job_title" class="col-md-4 col-form-label text-md-end">Job Title</label>
                                    <div class="col-md-6">
                                        <input id="job_title" type="text"
                                            class="form-control @error('job_title') is-invalid @enderror" name="job_title"
                                            value="{{ old('job_title') }}">
                                        @error('job_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="cv" class="col-md-4 col-form-label text-md-end">CV</label>
                                    <div class="col-md-6">
                                        <input id="cv" type="file"
                                            class="form-control @error('cv') is-invalid @enderror" name="cv"
                                            accept=".pdf,.doc,.docx">
                                        @error('cv')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div id="company-fields" style="display: none;">
                                <div class="row mb-3">
                                    <label for="company_name" class="col-md-4 col-form-label text-md-end">Company
                                        Name</label>
                                    <div class="col-md-6">
                                        <input id="company_name" type="text"
                                            class="form-control @error('company_name') is-invalid @enderror"
                                            name="company_name" value="{{ old('company_name') }}">

                                        @error('company_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="description"
                                        class="col-md-4 col-form-label text-md-end">Description</label>
                                    <div class="col-md-6">
                                        <input id="description" type="text"
                                            class="form-control  @error('description') is-invalid @enderror"
                                            name="description"  value="{{ old('description') }}">
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">

                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="contact_phone" class="col-md-4 col-form-label text-md-end">Contact
                                        Phone</label>
                                    <div class="col-md-6">
                                        <input id="contact_phone" type="text"
                                            class="form-control  @error('contact_phone') is-invalid @enderror"
                                            name="contact_phone"  value="{{ old('contact_phone') }}">
                                        @error('contact_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="logo" class="col-md-4 col-form-label text-md-end">Logo</label>
                                    <div class="col-md-6">
                                        <input id="logo" type="file"
                                            class="form-control  @error('logo') is-invalid @enderror" name="logo"
                                            accept=".png,.jpg,.jpeg,.gif">
                                        @error('logo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getRespectiveFields() {
            var userType = document.getElementById('type').value;
            var candidateFields = document.getElementById('candidate-fields');
            var companyFields = document.getElementById('company-fields');

            if (userType === 'candidate') {
                candidateFields.style.display = 'block';
                companyFields.style.display = 'none';
            } else if (userType === 'company') {
                candidateFields.style.display = 'none';
                companyFields.style.display = 'block';
            } else {
                candidateFields.style.display = 'none';
                companyFields.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            getRespectiveFields();
        });
    </script>
@endsection
