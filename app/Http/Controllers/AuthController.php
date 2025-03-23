<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Filters\CarFilter;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CarForSelectResource;
use App\Models\Car;
use App\Models\Login;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with(['success' => 'Вы вышли!']);
    }
    public function auth(Request $request)
    {
        if (!Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])) {
            return back()->with('fail', 'Не верные данные!');
        } else {
            $request->session()->regenerate();
            return redirect()->intended()->with('success', 'Вы вошли!');
        }
    }
}
