@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Candidate Profile</h2>
                    </div>
                    <div class="card-body">

                        <h4>Personal Information</h4>
                        <ul class="list-group list-group-flush mb-4">
                            {{-- <p>{{ $candidate->user }}</p> --}}
                            <li class="list-group-item"><strong>Name:</strong> {{ $user->name }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                            <li class="list-group-item"><strong>Phone Number:</strong> {{ $candidate->phone_number }}</li>
                        </ul>

                        <h4>Job Details</h4>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item"><strong>Job Title:</strong> {{ $candidate->job_title }}</li>
                            <li class="list-group-item"><strong>CV:</strong>
                                @if ($candidate->cv)
                                    <a href="{{ asset('candidates/'.$candidate->cv) }}" target="_blank">View CV</a>
                                @else
                                    <span>No CV uploaded</span>
                                @endif
                            </li>
                        </ul>

                        <h4>Additional Information</h4>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item"><strong>Joined on:</strong>
                                {{ $candidate->created_at->format('M d, Y') }}</li>
                        </ul>

                        <div class="text-center">
                            {{-- <a href="{{ route('candidate.edit', $candidate->id) }}" class="btn btn-primary">Edit Profile</a> --}}
                            {{-- <a href="" class="btn btn-danger">Delete profile</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
