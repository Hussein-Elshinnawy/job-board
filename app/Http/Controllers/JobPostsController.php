<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobsRequest;
use App\Http\Requests\UpdateJobsRequest;
use App\Models\Application;
use App\Models\Category;
use App\Models\City;
use App\Models\Technology;
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
        $application = null;
        if (Auth::user()->type == 'candidate') {
            $application = Application::where('job_post_id', $job->id)->where('candidate_id', Auth::user()->candidate->id)->first();
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
    public function filter(Request $request)
    {
        // dd($request);
        $query = JobPost::query();
        // dd($query);
        if ($request->filled('keywords')) {
            $keywords = $request->input('keywords');
            $technologyIds = Technology::where('name', 'like', "%{$keywords}%")->pluck('id')->toArray();
            // dd($technologyIds);

            $query->where(function ($q) use ($keywords, $technologyIds) {
                $q->where('title', 'like', "%{$keywords}%")
                    ->orWhere('work_type', 'like', "%{$keywords}%")
                    ->orWhere('responsibilities', 'like', "%{$keywords}%")
                ;
                if (!empty($technologyIds)) {
                    // $jobs = JobPost::whereHas('technologies', function ($q) use ($technologyIds) {
                    //     $q->whereIn('technologies.id', $technologyIds);
                    // })->get();
                    // $categories = Category::all();
                    // $cities = City::all();
                    // return view('jobs.search', compact('jobs', 'cities', 'categories'));
                    $q->orWhereHas('technologies', function ($q) use ($technologyIds) {
                        $q->whereIn('technologies.id', $technologyIds);
                    });
                    // dd($q->toSql(), $q->getBindings());
                }
            });

        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->input('city_id'));
            // dd($query);
        }

        if ($request->filled('category')) {
            $categoryId = $request->input('category');
            // whereHas to like many to many relations
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }
        if ($request->filled('min_salary')) {
            $minSalary = $request->input('min_salary');
            // $query->where('min_salary', '>=', $minSalary  );
            $query->where('max_salary', '>=', $minSalary)
                ->where('min_salary', '<=', $minSalary);
        }

        if ($request->filled('max_salary')) {
            $maxSalary = $request->input('max_salary');
            // $query->where('max_salary', '<=', $maxSalary);
            $query->where('max_salary', '>=', $maxSalary)
                ->where('min_salary', '<=', $maxSalary);
        }
        $jobs = $query->where('is_active', 1)->get();
        // $jobs = $query->where('is_active', 1)->paginate(10);
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
