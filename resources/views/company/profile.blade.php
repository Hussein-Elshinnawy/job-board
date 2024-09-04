@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Compnay Profile</h2>
                    </div>
                    <div class="card-body">
                        @if($company->logo)
                            {{-- <p>{{asset('companies/'.$company->logo)}}</p> --}}
                            <div class="text-center mb-4">

                                <img src="{{asset('companies/'.$company->logo)  }}" alt="company Picture" class="img-thumbnail rounded-circle object-fit-cover" width="20%">
                            </div>

                        @else
                            <span>No Company Logo</span>
                        @endif

                        <h4>Company Information</h4>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item"><strong>Name:</strong> {{ $user->name }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                            <li class="list-group-item"><strong>Contact Number:</strong> {{ $company->contact_phone }}</li>
                        </ul>

                        <h4>Job Details</h4>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item"><strong>Company Name:</strong> {{ $company->company_name }}</li>

                            <li class="list-group-item"><strong>Company description:</strong> {{ $company->description }}</li>

                        </ul>

                        <h4>Additional Information</h4>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item"><strong>Joined on:</strong>
                                {{ $company->created_at->format('M d, Y') }}</li>
                        </ul>

                        <div class="text-center">
                            {{-- <a href="{{ route('company.edit', $company->id) }}" class="btn btn-primary">Edit Profile</a> --}}
                            {{-- <a href="" class="btn btn-danger">Delete profile</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
