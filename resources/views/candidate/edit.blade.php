@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Edit Candidate Profile</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('candidate.update', $candidate) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="name">Name </label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    value="{{ old('name', $candidate->user->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email </label>
                                <input type="text" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="name"
                                    value="{{ old('email', $candidate->user->email) }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number"
                                    class="form-control  @error('phone_number') is-invalid @enderror" id="phone_number"
                                    value="{{ old('phone_number', $candidate->phone_number) }}" required>
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="job_title">Job Title</label>
                                <input type="text" name="job_title"
                                    class="form-control  @error('job_title') is-invalid @enderror" id="job_title"
                                    value="{{ old('job_title', $candidate->job_title) }}" required>
                                    @error('job_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group mb-3">
                                @if ($candidate->cv)
                                    <p>Current CV: <a href="{{ asset('candidates/' . $candidate->cv) }}"
                                            target="_blank">View CV</a></p>
                                @endif
                                <label for="cv">Upload CV</label>
                                <input type="file" name="cv" class="form-control @error ('cv') is-invalid @enderror" id="cv" accept=".pdf,.doc,.docx" >
                                <small class="text-muted">Leave blank if you don't want to change the CV.</small>
                                @error('cv')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success">Update Profile</button>
                            <a href="{{ route('candidate.profile') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
