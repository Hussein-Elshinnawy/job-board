<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Company;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type' => ['required', 'in:candidate,company'],
        ];

        if (isset($data['type']) && $data['type'] === 'candidate') {
            $rules['phone_number'] = ['required', 'string', 'max:15', 'unique:candidates'];
            $rules['job_title'] = ['required', 'string', 'max:255'];
            $rules['cv'] = ['mimes:pdf,doc,docx', 'max:2048'];
        }

        if (isset($data['type']) && $data['type'] === 'company') {
            $rules['company_name'] = ['required', 'string', 'max:255', 'unique:companies'];
            $rules['description'] = ['required', 'string', 'max:255'];
            $rules['contact_phone'] = ['required', 'string', 'max:15', 'unique:companies'];
            $rules['logo'] = ['mimes:jpeg,jpg,png,gif', 'max:2048'];
        }

        return Validator::make($data, $rules);
    }

    protected function create(array $data)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'type' => $data['type'],
            ]);
            // dd( $data['type']);
            // dd($data);

            if ($data['type'] == 'candidate') {
                $cvPath = null;
                if (isset($data['cv'])) {
                    // dd($data['cv']->file());
                    $cv = $data['cv'];
                    $cvPath = $cv->store('cvs', 'candidates');
                }

                Candidate::create([
                    'user_id' => $user->id,
                    'phone_number' => $data['phone_number'],
                    'job_title' => $data['job_title'],
                    'cv' => $cvPath,
                ]);
            } elseif ($data['type'] == 'company') {
                $logoPath = null;
                if (isset($data['logo'])) {
                    // dd($data);
                    $logo = $data['logo'];
                    $logoPath = $logo->store('logos', 'companies');
                }
                Company::create([
                    'user_id' => $user->id,
                    // 'email' => $data['email'],
                    'company_name' => $data['company_name'],
                    'description' => $data['description'],
                    'contact_phone' => $data['contact_phone'],
                    'logo' => $logoPath,
                ]);
            }
            DB::commit();
            return $user;
        } catch (\Exception $error) {
            DB::rollBack();
            Log::error('Failed to create user ', ['error' => $error->getMessage()]);
            throw $error;
        }
    }


    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            Log::error('Validation failed', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $user = $this->create($request->all());

        Auth::login($user);


        return $this->redirectBasedOnUser($user);
    }

    protected function redirectBasedOnUser(User $user)
    {

        if ($user->type == 'candidate') {
            return redirect()->route('candidate.profile')->with('success', 'welcome ' . $user->name);
        } elseif ($user->type == 'company') {
            return redirect()->route('company.profile')->with('success', 'welcome ' . $user->name);
        }

        return redirect($this->redirectTo);
    }
}
