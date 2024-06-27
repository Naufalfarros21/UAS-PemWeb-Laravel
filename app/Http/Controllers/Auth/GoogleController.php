<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(\Str::random(24)),
                    'email_verified_at' => now(),
                ]);

                $user->assignRole('Admin');
            } elseif (!$user->hasRole('Admin')) {
                // Jika pengguna ada tapi bukan Admin, tolak akses
                return redirect()->route('login')->with('failed', 'Akun Anda tidak memiliki akses Admin.');
            }

            Auth::login($user);

            return redirect()->route('admin.beranda');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('failed', 'Login dengan Google gagal, coba lagi.');
        }
    }
}