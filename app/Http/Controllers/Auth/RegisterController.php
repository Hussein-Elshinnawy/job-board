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

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

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
            $rules['phone_number'] = ['required', 'string', 'max:255'];
            $rules['job_title'] = ['required', 'string', 'max:255'];
            $rules['cv'] = ['required', 'string', 'max:255'];
        }

        if (isset($data['type']) && $data['type'] === 'company') {
            $rules['company_name'] = ['required', 'string', 'max:255'];
            $rules['description'] = ['required', 'string', 'max:255'];
            $rules['contact_phone'] = ['required', 'string', 'max:255'];
        }

        return Validator::make($data, $rules);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => $data['type'],
        ]);
        // dd( $data['type']);
        // dd($data);
        if ( $data['type'] == 'candidate') {


            Candidate::create([
                'user_id' => $user->id,
                'email' =>  $data['email'],
                'phone_number' => $data['phone_number'],
                'job_title' => $data['job_title'],
                'cv' => $data['cv'],
            ]);

        } elseif ( $data['type'] == 'company') {

            Company::create([
                'user_id' => $user->id,
                'email' => $data['email'],
                'company_name' => $data['company_name'],
                'description' => $data['description'],
                'contact_phone' => $data['contact_phone'],
            ]);

        }

        return $user;
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
            return redirect()->route('candidate.dashboard');
        } elseif ($user->type == 'company') {
            return redirect()->route('company.dashboard');
        }

        return redirect($this->redirectTo);
    }
}
