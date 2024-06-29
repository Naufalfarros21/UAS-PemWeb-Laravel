<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\User;
use App\Models\PasswordResetToken;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole('Admin')) {
                return redirect()->route('admin.beranda');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('failed', 'Role tidak ditemukan atau Anda bukan Admin');
            }
        } else {
            return redirect()->route('login')->with('failed', 'Email atau Password Salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Kamu berhasil logout');
    }

    public function forgot_password()
    {
        return view('auth.forgot-password');
    }

    public function forgot_password_act(Request $request)
    {
        $customMessage = [
            'email.required'    => 'Email tidak boleh kosong',
            'email.email'       => 'Email tidak valid',
            'email.exists'      => 'Email tidak terdaftar di database',
        ];

        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], $customMessage);

        $token = \Str::random(60);

        \Log::info('Email untuk penyimpanan token: ' . $request->email);

        $passwordReset = PasswordResetToken::updateOrCreate(
            [
                'email' => $request->email
            ],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]
        );

        \Log::info('Token reset password disimpan untuk email: ' . $passwordReset->email);
        \Log::info('Data disimpan: ' . json_encode($passwordReset));

        Mail::to($request->email)->send(new ResetPasswordMail($token));

        return redirect()->route('login')->with('success', 'Kami telah mengirimkan link reset password ke email anda');
    }



    public function validasi_forgot_password_act(Request $request)
    {
        $customMessage = [
            'password.required' => 'Password tidak boleh kosong',
            'password.min'      => 'Password minimal 6 karakter',
        ];

        $request->validate([
            'password' => 'required|min:6'
        ], $customMessage);

        $tokenData = PasswordResetToken::where('token', $request->token)->first();

        if (!$tokenData) {
            \Log::error('Token tidak valid: ' . $request->token);
            return redirect()->route('login')->with('failed', 'Token tidak valid');
        }

        \Log::info('Token ditemukan untuk validasi: ' . $tokenData->token . ' dengan email: ' . $tokenData->email);

        $user = User::where('email', $tokenData->email)->first();

        if (!$user) {
            \Log::error('Email tidak terdaftar di database: ' . $tokenData->email);
            return redirect()->route('login')->with('failed', 'Email tidak terdaftar di database');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        \Log::info('Password berhasil direset untuk email: ' . $user->email);

        $tokenData->delete();

        return redirect()->route('login')->with('success', 'Password berhasil direset');
    }



    public function validasi_forgot_password(Request $request, $token)
    {
        $tokenData = PasswordResetToken::where('token', $token)->first();

        if (!$tokenData) {
            \Log::error('Token tidak valid: ' . $token);
            return redirect()->route('login')->with('failed', 'Token tidak valid');
        }

        \Log::info('Token ditemukan untuk validasi: ' . $token . ' dengan email: ' . $tokenData->email);

        return view('auth.validasi-token', compact('token'));
    }


    public function register()
    {
        return view('auth.register');
    }

    public function register_proses(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Tetapkan peran Admin
        $user->assignRole('Admin');

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.notice');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();

        $user = $request->user();

        if ($user->hasRole('Admin')) {
            return redirect()->route('admin.beranda')->with('success', 'Email anda berhasil diverifikasi.');
        } else {
            return redirect()->route('login')->with('failed', 'Role tidak ditemukan setelah verifikasi email.');
        }
    }

    public function resendEmailVerification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Link verifikasi email telah dikirim!');
    }
}
