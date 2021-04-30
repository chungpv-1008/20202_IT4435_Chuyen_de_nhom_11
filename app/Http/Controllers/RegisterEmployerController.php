<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Company;
use App\Models\Image;
use App\Http\Requests\RegisterEmployerRequest;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;

class RegisterEmployerController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(RegisterEmployerRequest $request)
    {
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role_id' => config('user.employer'),
            'status' => config('user.unconfirmed'),
        ]);
    }

    protected function createCompany(RegisterEmployerRequest $request, $idUser)
    {
        return Company::create([
            'name' => $request['name-company'],
            'address' => $request['address'],
            'website' => $request['link-website'],
            'introduce' => $request['introduce-company'],
            'user_id' => $idUser,
        ]);
    }

    protected function createAvatar($idCompany, $idUser)
    {
        Image::create([
            'url' => config('user.default_avatar_company'),
            'imageable_id' => $idCompany,
            'imageable_type' => Company::class,
            'type' => config('user.avatar'),
        ]);

        Image::create([
            'url' => config('user.default_avatar'),
            'imageable_id' => $idUser,
            'imageable_type' => User::class,
            'type' => config('user.avatar'),
        ]);
    }

    public function register(RegisterEmployerRequest $request)
    {
        event(new Registered($user = $this->create($request)));
        event(new Registered($company = $this->createCompany($request, $user->id)));
        
        $this->createAvatar($company->id, $user->id);
        
        if ($response = $this->registered($request, $user, $company)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }
}
