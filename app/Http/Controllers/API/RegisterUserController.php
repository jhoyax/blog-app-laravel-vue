<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterUserController extends Controller
{
    use RegistersUsers;

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterUserRequest $request)
    {
        $user = $this->create($request->all());

        return response()->json($user, Response::HTTP_CREATED);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     *
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return new UserResource($user);
    }
}
