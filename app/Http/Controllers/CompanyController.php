<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
class CompanyController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $company = $user->companies()->with('user')->first();
        // dd($company->user->name);
        return view('company.profile', compact('company'));

        // $user = Auth::user()->load('companies');
        // $company = $user->companies;

        // return view("company.profile", compact('company','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
         if ($company->logo) {
            $disk = Storage::disk('companies');
            $companyLogo = $company->logo;
            if ($disk->exists($companyLogo)) {
                       $disk->delete($companyLogo);
            }
        }
        $user= $company->user;
          $user->delete();
        $company->delete();

        Auth::logout();
        return redirect()->route('home')->with('success', 'Profile deleted successfully.');
    }
}
