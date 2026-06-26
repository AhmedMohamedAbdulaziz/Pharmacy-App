<?php
namespace App\Modules\Auth\Interfaces;

interface UserRepositoryInterface
{
    public function attemptLogin(array $credentials): bool;
    public function register(array $data);
}
