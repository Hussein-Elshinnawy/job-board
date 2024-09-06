@extends("layouts.app")

@section("content")
    <div class="py-5 px-3">
        <form action="{{ route("jobs.store") }}" method="POST">
            @csrf
            <h1 class="text-center pt-5 fw-bolder fftitle codark">Post a Job</h1>
            <div class="d-flex justify-content-end mb-5">
                <a href="{{ route("jobs.index") }}" class="btn bgprimary cowhite fw-bolder fs-4">Back</a>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old("title") }}">
                @error("title")
                    <div class="alert alert-danger my-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="work_type" class="form-label d-inline">Work Type:</label>
                <select class="form-select d-inline w-auto" id="work_type" name="work_type">
                    <option selected disabled>Please Select Work Type</option>
                    <option {{ old("work_type") == "onsite" ? "selected" : "" }} value="onsite">On Site</option>
                    <option {{ old("work_type") == "remote" ? "selected" : "" }} value="remote">Remote</option>
                    <option {{ old("work_type") == "hybrid" ? "selected" : "" }} value="hybrid">Hybrid</option>
                    <option {{ old("work_type") == "freelance" ? "selected" : "" }} value="freelance">Freelance</option>
                </select>
                </select>
                </select>
                </select>
                @error("work_type")
                    <div class="alert alert-danger my-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 ">
                <label for="city" class="">City:</label>
                <input type="text" class="form-control w-auto d-inline-block" id="city" name="city" value="{{ old("city") }}">
                @error("city")
                    <div class="alert alert-danger my-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="me-2">Salary:</label>
                <input type="text" class="form-control w-auto d-inline-block me-3" id="min_salary" name="min_salary" value="{{ old("min_salary") }}">
                <input type="text" class="form-control w-auto d-inline-block me-3" id="max_salary" name="max_salary" value="{{ old("max_salary") }}">
                @error("min_salary")
                    <div class="alert alert-danger my-3">{{ $message }}</div>
                @enderror
                @error("max_salary")
                    <div class="alert alert-danger my-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 ">
                <label for="deadline" class="">Date Line:</label>
                <input type="date" class="form-control w-auto d-inline-block" id="deadline" name="deadline" min="{{ \Carbon\Carbon::now()->format("Y-m-d") }}"
                    max="{{ \Carbon\Carbon::now()->addMonth()->format("Y-m-d") }}" value="{{ \Carbon\Carbon::parse(old("deadline"))->format("Y-m-d") }}">
                @error("deadline")
                    <div class="alert alert-danger my-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="10">{{ old("description") }}</textarea>
                @error("description")
                    <div class="alert alert-danger my-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="qualification" class="form-label">Qualifications:</label>
                <textarea class="form-control" id="qualification" name="qualification" rows="10">{{ old("qualification") }}</textarea>
                @error("qualification")
                    <div class="alert alert-danger my-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="responsibilities" class="form-label">Responsibilities:</label>
                <textarea class="form-control" id="responsibilities" name="responsibilities" rows="10">{{ old("responsibilities") }}</textarea>
                @error("responsibilities")
                    <div class="alert alert-danger my-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="benefits" class="form-label">Benefits:</label>
                <textarea class="form-control" id="benefits" name="benefits" rows="10">{{ old("benefits") }}</textarea>
                @error("benefits")
                    <div class="alert alert-danger my-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn bgprimary cowhite fw-bolder fs-4">Post Job</button>
            </div>
        </form>
    </div>
@endsection
