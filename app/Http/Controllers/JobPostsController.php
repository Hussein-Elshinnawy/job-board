<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobsRequest;
use App\Http\Requests\UpdateJobsRequest;
use App\Models\City;
use App\Models\Category;
use App\Models\Application;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $softDeletedJobs = [];
        // if (isset(Auth::user()->company)) {
        //     $companyId = Auth::user()->company->id;
        //     $jobs = JobPost::where('company_id', $companyId)->get();
        //     $softDeletedJobs = JobPost::onlyTrashed()->where('company_id', $companyId)->get();
        //     return view("jobs.index", compact("jobs", "softDeletedJobs"));
        // }
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
        $data = $request->all();
        $data['company_id'] = Auth::user()->company->id;
        $job = JobPost::create($data);
        return to_route("jobs.show", $job);
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPost $job)
    {
        $application = null;
        if (isset(Auth::user()->candidate)) {
            $application =  Application::where('job_post_id', $job->id)->where('candidate_id', Auth::user()->candidate->id)->first();
        }
        return view("jobs.show", compact("job", 'application'));
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
        $job->update($request->all());
        return to_route("jobs.show", compact('job'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPost $job)
    {
        $job->delete();
        return to_route("jobs.index");
    }

    public function trashed(JobPost $job)
    {
        $softDeletedJobs = JobPost::onlyTrashed()->where('company_id', Auth::user()->company->id)->get();
        return view("jobs.trashed", compact("softDeletedJobs"));
    }

    public function restore(string $id)
    {
        // dd("hello");
        $job = JobPost::onlyTrashed()->findOrFail($id);
        $job->restore();
        if (JobPost::onlyTrashed()->count() > 0) {
            return to_route("jobs.trashed");
        } else {
            return to_route("jobs.index");
        }
    }

    public function forceDelete(string $id)
    {
        $job = JobPost::onlyTrashed()->findOrFail($id);
        $job->forceDelete();
        if (JobPost::onlyTrashed()->count() > 0) {
            return to_route("jobs.trashed");
        } else {
            return to_route("jobs.index");
        }
    }

    public function applications(JobPost $job)
    {
        $applications = Application::where("job_post_id", $job->id)->get();
        return view("application.index", compact("applications"));
    }

    public function accept(Application $application)
    {
        $application->accept();
        return redirect()->route('jobs.show', $application->job_post_id)->with('success', 'Application Accepted');
    }

    public function reject(Application $application)
    {
        $application->reject();
        return redirect()->route('jobs.show', $application->job_post_id)->with('danger', 'Application Rejected');
    }

    public function review(Application $application)
    {
        $application->review();
        return redirect()->route('jobs.show', $application->job_post_id)->with('warning', 'Application Reviewed');
    }

    public function filter(Request $request)
    {
        // dd($request);
        $query = JobPost::query();
        // dd($query);

        if ($request->filled('keywords')) {
            // dd('test');
            $keywords = $request->input('keywords');
            $query->where(function ($q) use ($keywords) {
                $q->where('title', 'like', "%{$keywords}%")
                    ->orWhere('work_type', 'like', "%{$keywords}%")
                    ->orWhere('responsibilities', 'like', "%{$keywords}%")
                ;
            });
            // dd($query);
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->input('city_id'));
            // dd($query);
        }

        // // Filter by category
        // if ($request->filled('category')) {
        //     $query->where('category_id', $request->input('category'));
        // }

        $jobs = $query->where('is_active', 1)->get();
        // dd($jobs);
        $categories = Category::all();
        $cities = City::all();

        return view('jobs.search', compact('jobs', 'cities', 'categories'));
    }

    public function search()
    {
        $categories = Category::all();
        $cities = City::all();
        return view('jobs.search', compact('categories', 'cities'));
    }
}
