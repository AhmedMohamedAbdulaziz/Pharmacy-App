<?php
namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Requests\LoginRequest;
use App\Modules\Auth\Requests\RegisterRequest;
use App\Modules\Auth\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Modules\Auth\Models\User;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function showLogin()  { return view('auth.login'); }
    public function showRegister() { return view('auth.register'); }

    public function login(LoginRequest $request)
    {
        if ($this->authService->login($request->validated())) {
            $request->session()->regenerate();
            return $this->authService->isAdmin()
                ? redirect()->route('admin.dashboard')
                : redirect()->route('medicines.index');
        }
        return back()->withErrors(['email' => 'Invalid login credentials.']);
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->authService->register($request->validated());
        Auth::login($user);
        return redirect()->route('medicines.index');
    }

    public function logout(Request $request)
    {
        $this->authService->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
