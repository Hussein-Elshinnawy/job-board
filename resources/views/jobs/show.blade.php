@extends('layouts.app')

@section('content')
    <div class="row py-5 px-3">

        @if (Auth::user()->type == 'company' && Auth::user()->company->id == $job->company_id)
            <h1 class="text-center pt-5 fw-bolder fftitle codark">Job Details</h1>
            <div class="d-flex justify-content-end mb-5">
                <a href="{{ route('jobs.edit', $job) }}" class="btn bgprimary cowhite fw-bolder fs-4">Edit Job</a>
                <a href="{{ route('application.index', $job) }}" class="btn bgsecondary cowhite fw-bolder fs-4 mx-3">View
                    Applications</a>
            </div>
        @endif
        @if (Auth::user()->type == 'candidate')
            @if (isset($application))
                <form action="{{ route('application.destroy', $application->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="job_post_id" value="{{ $job->id }}">
                    <div class="d-flex justify-content-end mb-5">
                        <button type="submit" class="btn btn-danger cowhite fw-bolder fs-4">Cancel</button>
                    </div>
                </form>
            @else
                <form action="{{ route('application.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="job_post_id" value="{{ $job->id }}">
                    <div class="d-flex justify-content-end mb-5">
                        <button type="submit" class="btn bgprimary cowhite fw-bolder fs-4">Apply Now</button>
                    </div>
                </form>
            @endif
        @endif
        @isset($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endisset

        <div class="col-lg-8">
            <div class="row mb-5">
                <div class="col-2">
                    <img src="{{ asset('assets/images/company/logo.jpg') }}" width="100" height="100"
                        style="border: 1px solid #dee2e6 !important">
                </div>
                <div class="col-10">
                    <h2 class="fftitle codark fw-bold">{{ $job->title }}</h2>
                    <p class="">Company Name: {{ $job->company->company_name }}</p>
                    <span class=" me-3">
                        <i class="fa-solid fa-location-dot coprimary me-1"></i>
                        {{ $job->city->name }}
                    </span>
                    <span class=" me-3">
                        <i class="fa-regular fa-clock coprimary me-1"></i>
                        {{ $job->work_type }}
                    </span>
                    <span class=" me-3">
                        <i class="fa-regular fa-money-bill-1 coprimary me-1"></i>
                        {{ $job->min_salary }} - {{ $job->max_salary }}
                    </span>
                    {{-- <p class="">{{ \Illuminate\Support\Str::words($job->description, 10) }}</p> --}}
                    {{-- <h4>descripttion: {{ strlen($job->description) > 50 ? substr($job->description, 0, 100) . ".." : $job->description }}</h4> --}}
                </div>
            </div>
            <div class="my-4">
                <h2 class="fw-bold my-3 fftitle codark">Job Description</h2>
                <p class="">{{ $job->description }}</p>
            </div>
            <div class="my-4">
                <h2 class="fw-bold my-3 fftitle codark">Responsibility</h2>
                <p class="">{{ $job->responsibilities }}</p>
            </div>
            <div class="my-4">
                <h2 class="fw-bold my-3 fftitle codark">Qualifications</h2>
                <p class="">{{ $job->qualification }}</p>
            </div>
            <div class="my-4">
                <h2 class="fw-bold my-3 fftitle codark">Benefits</h2>
                <p class="">{{ $job->benefits }}</p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="bglight px-5 py-4  mb-4">
                <h3 class="fw-bold my-4 fftitle codark">Job Summary</h3>
                <p class="my-4">
                    <i class="fa-solid fa-chevron-right coprimary me-2"></i>
                    Published On: {{ \Carbon\Carbon::parse($job->created_at)->format('d M, Y') }}
                </p>
                <p class="my-4">
                    <i class="fa-solid fa-chevron-right coprimary me-2"></i>
                    Vacancy: {{ $job->vacancies }}
                </p>
                <p class="my-4">
                    <i class="fa-solid fa-chevron-right coprimary me-2"></i>
                    Job Nature: {{ $job->work_type }}
                </p>
                <p class="my-4">
                    <i class="fa-solid fa-chevron-right coprimary me-2"></i>
                    Salary: {{ $job->min_salary }} - {{ $job->max_salary }}
                </p>
                <p class="my-4">
                    <i class="fa-solid fa-chevron-right coprimary me-2"></i>
                    Location: {{ $job->city->name }}
                </p>
                <p class="my-4">
                    <i class="fa-solid fa-chevron-right coprimary me-2"></i>
                    Date Line: {{ \Carbon\Carbon::parse($job->deadline)->format('d M, Y') }}
                </p>
            </div>
            <div class="bglight px-5 py-4 ">
                <h3 class="fw-bold my-4 fftitle codark">Company Details</h3>
                <p class="my-4">
                    {{ $job->company->description }}
                </p>
            </div>
        </div>

        @foreach ($job->comments as $comment)
            <x-comment :addNew="false" :comment="$comment"> </x-comment>
        @endforeach
        @if (Auth::user()->type == 'candidate')
            <x-comment :addNew="true"> </x-comment>
        @endif
    </div>
@endsection
