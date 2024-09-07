<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobsRequest;
use App\Http\Requests\UpdateJobsRequest;
use App\Models\City;
use App\Models\JobPost;
use Illuminate\Http\Request;

class JobPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = JobPost::all();
        return view("jobs.index", compact("jobs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view("jobs.create", compact("cities"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobsRequest $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPost $job)
    {
        return view("jobs.show", compact("job"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPost $job)
    {
        $cities = City::all();
        $workType = ["onsite", "remote", "hybrid", "freelance"];
        return view("jobs.edit", compact("job", 'workType', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, JobPost $job)
    public function update(UpdateJobsRequest $request, JobPost $job)
    {
        dd($job->max_salary, $job->work_type, $request->max_salary, $request->work_type);
        $job->update($request->all());
        return to_route("jobs.show", compact('job'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPost $job)
    {
        //
    }
}
