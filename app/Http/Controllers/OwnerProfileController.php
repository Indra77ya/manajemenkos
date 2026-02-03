<?php

namespace App\Http\Controllers;

use App\Models\OwnerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OwnerProfileController extends Controller
{
    public function edit()
    {
        $profile = OwnerProfile::first();
        return view('admin.pusat_data.owner_profil', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_kost' => 'nullable|string|max:255',
            'nama_pemilik' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profile = OwnerProfile::first();

        if (!$profile) {
            $profile = new OwnerProfile();
        }

        $profile->nama_kost = $request->nama_kost;
        $profile->nama_pemilik = $request->nama_pemilik;
        $profile->alamat = $request->alamat;
        $profile->no_telepon = $request->no_telepon;
        $profile->email = $request->email;

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($profile->logo_path && Storage::disk('public')->exists($profile->logo_path)) {
                Storage::disk('public')->delete($profile->logo_path);
            }

            $path = $request->file('logo')->store('logos', 'public');
            $profile->logo_path = $path;
        }

        $profile->save();

        return redirect()->route('admin.owner-profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
