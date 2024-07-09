<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        $user = Auth::user();

        // Periksa apakah password lama sesuai
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        // Update password baru
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diubah.');
    }

    public function updateProfilePicture(Request $request)
    {
        $user = Auth::user();

        // Validasi file gambar
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Hapus gambar lama jika ada
        if ($user->image) {
            Storage::disk('public')->delete('profile_pictures/' . $user->image);
        }

        // Simpan gambar baru
        $imageName = time() . '.' . $request->profile_picture->extension();
        $request->profile_picture->storeAs('profile_pictures', $imageName, 'public');

        // Perbarui path gambar di database
        $user->image = $imageName;
        $user->save();

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function deleteProfilePicture()
    {
        $user = Auth::user();

        // Hapus gambar jika ada
        if ($user->image) {
            Storage::disk('public')->delete('profile_pictures/' . $user->image);
            $user->image = null;
            $user->save();
        }

        return redirect()->back()->with('success', 'Foto profil berhasil dihapus.');
    }
}
