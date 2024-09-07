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
        $company = $user->company()->with('user')->first();
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
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
        // dd($request,$company);
          $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|max:255|unique:users,email,'.$company->user->id,
            'contact_phone' => 'required|string|max:15|unique:companies,contact_phone,'.$company->id,
            'description' => 'required|string|max:255',
            'logo' => 'nullable|mimes:png,jpg,jpeg,gif|max:2048',
        ]);
        // $oldlogo=$company->logo;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'companies');

            if ($company->logo) {
                Storage::disk('companies')->delete($company->logo);
            }

            $company->logo = $logoPath;
        }

        $company->user->name = $request->name;
        $company->user->email = $request->email;
        $company->user->save();

        $company->update([
            'contact_phone' => $request->contact_phone,
            'description' => $request->description,
            // 'logo' => $logoPath,
        ]);

        return redirect()->route('company.profile')->with('success', 'Profile updated successfully.');

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
