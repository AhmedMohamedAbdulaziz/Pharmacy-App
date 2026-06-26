<?php
namespace App\Modules\Auth\Repositories;

use App\Modules\Auth\Interfaces\UserRepositoryInterface;
use App\Modules\Auth\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function attemptLogin(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }

    public function register(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'user',
        ]);
    }
}
