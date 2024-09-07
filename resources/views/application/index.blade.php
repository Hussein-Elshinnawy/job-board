@extends("layouts.app")

@section("title")
    All Jobs
@endsection

@section("content")
    <div class="py-3">
        <h1 class="text-center pt-5 fw-bolder fftitle codark">Job Listing</h1>
        @foreach ($applications as $application)
            <div class="m-5 p-4 job-item">
                <div class="row">
                    <div class="col">
                        <h4 class="codark fftitle">Job Title: {{ $application->jobPost->title }}</h4>
                        <p>Company Name: {{ $application->jobPost->company->company_name }}</p>
                        <span class="me-3">
                            Candidate Name: {{ $application->candidate->user->name }}
                        </span>
                        <span class="me-3">
                            Candidate CV: {{ $application->candidate->cv }}
                        </span>
                        <span class="me-3">
                            Status: {{ $application->status }}
                        </span>
                        {{-- <span class="me-3">
                        </span> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
