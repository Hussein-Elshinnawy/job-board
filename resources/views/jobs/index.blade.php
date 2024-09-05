@extends("layouts.app")

@section("title")
    All Jobs
@endsection

@section("content")
    <div class="bgwhite py-3">
        <h1 class="text-center pt-5 fw-bolder">Job Listing</h1>
        @foreach ($jobs as $job)
            <div class="m-5 p-4 job-item">
                <a href="{{ route("jobs.show", $job) }}" class="text-decoration-none cogrey">
                    <div class="row">
                        <div class="col-2">
                            <img src="{{ asset("assets/images/company/logo.jpg") }}" width="100" height="100" style="border: 1px solid #dee2e6 !important">
                        </div>
                        <div class="col-7">
                            <h4 class="codark">{{ $job->title }}</h4>
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
                        <div class="col-3 text-end">
                            <button class="btn bgprimary cowhite m-3">View Details</button>
                            <p class="me-4">
                                <i class="fa-solid fa-calendar-days coprimary me-1"></i>
                                Date Line:
                                {{ \Carbon\Carbon::parse($job->deadline)->format("d M Y") }}
                            </p>

                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
