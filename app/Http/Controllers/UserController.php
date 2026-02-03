<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('branch')
            ->filter($request->only(['search', 'role', 'branch_id', 'status']))
            ->paginate(10)
            ->withQueryString();

        $branches = Branch::all();
        $roles = Role::all();

        return view('admin.pusat_data.pengguna.index', compact('users', 'branches', 'roles'));
    }

    public function create()
    {
        $branches = Branch::all();
        $roles = Role::all();
        return view('admin.pusat_data.pengguna.create', compact('branches', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'exists:roles,name'],
            'branch_id' => ['nullable', 'exists:branches,id'],
            'status' => ['required', 'boolean'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        // "Untuk lokasi cabang kos ini, wajib diisi kalau owner bisa melihat semua cabang"
        // Interpretation: Branch is required, but Owner (Admin) can see all, implying Admin might not need to be tied to one branch
        // or allows NULL to signify "All Branches".
        // However, for other roles (Staff, Tenant), it must be mandatory.
        if ($request->role !== 'admin' && empty($request->branch_id)) {
             $request->validate([
                'branch_id' => 'required'
            ], [
                'branch_id.required' => 'Lokasi cabang kos wajib diisi untuk role ini.'
            ]);
        }

        $userData = $request->except(['password', 'password_confirmation', 'photo']);
        $userData['password'] = Hash::make($request->password);

        if ($request->hasFile('photo')) {
            $userData['photo_path'] = $request->file('photo')->store('profile-photos', 'public');
        }

        User::create($userData);

        return redirect()->route('admin.pengguna')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $branches = Branch::all();
        $roles = Role::all();
        return view('admin.pusat_data.pengguna.edit', compact('user', 'branches', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', 'string', 'exists:roles,name'],
            'branch_id' => ['nullable', 'exists:branches,id'],
            'status' => ['required', 'boolean'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->role !== 'admin' && empty($request->branch_id)) {
             $request->validate([
                'branch_id' => 'required'
            ], [
                'branch_id.required' => 'Lokasi cabang kos wajib diisi untuk role ini.'
            ]);
        }

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->fill($request->except(['password', 'password_confirmation', 'photo']));

        if ($request->hasFile('photo')) {
            if ($user->photo_path && Storage::disk('public')->exists($user->photo_path)) {
                Storage::disk('public')->delete($user->photo_path);
            }
            $user->photo_path = $request->file('photo')->store('profile-photos', 'public');
        }

        $user->save();

        return redirect()->route('admin.pengguna')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        // Optional: Delete photo
        if ($user->photo_path && Storage::disk('public')->exists($user->photo_path)) {
            Storage::disk('public')->delete($user->photo_path);
        }

        $user->delete();
        return redirect()->route('admin.pengguna')->with('success', 'Pengguna berhasil dihapus.');
    }
}
