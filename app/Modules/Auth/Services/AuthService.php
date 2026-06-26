<?php
namespace App\Modules\Auth\Services;

use App\Modules\Auth\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct(protected UserRepositoryInterface $userRepo) {}

    public function login(array $credentials): bool
    {
        return $this->userRepo->attemptLogin($credentials);
    }

    public function register(array $data)
    {
        return $this->userRepo->register($data);
    }

    public function logout(): void
    {
        Auth::logout();
    }

    public function isAdmin(): bool
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }
}
