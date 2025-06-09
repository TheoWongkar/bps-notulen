<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Validasi Search Form
        $validated = $request->validate([
            'status' => 'nullable|string|in:Arsip,Terbit,all',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'search' => 'nullable|string|max:50',
        ]);

        // Ambil Nilai
        $status = $validated['status'] ?? 'all';
        $start_date = $validated['start_date'] ?? null;
        $end_date = $validated['end_date'] ?? null;
        $search = $validated['search'] ?? null;

        // Semua Pengguna
        $users = User::when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            });
        })
            ->when($start_date, function ($query) use ($start_date) {
                return $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->whereDate('created_at', '<=', $end_date);
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        // Judul Halaman
        $title = "Data Pengguna";

        return view('user.index', compact('title', 'users', 'start_date', 'end_date', 'search'));
    }

    public function create()
    {
        $title = "Tambah Pengguna";

        return view('user.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'avatar' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|string|confirmed|min:6'
        ]);

        // Simpan Gambar Avatar
        if ($request->hasFile('avatar')) {
            $filePath = $request->file('avatar')->store('users', 'public');
            $validated['avatar'] = $filePath;
        }

        // Simpan Data User
        User::create([
            'avatar' => $validated['avatar'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('dashboard.user.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        $title = "Tambah Pengguna";

        return view('user.edit', compact('title', 'user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'role' => 'required|string',
            'password' => 'nullable|string|confirmed|min:6',
        ]);

        // Jika ada file avatar baru diunggah
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Simpan avatar baru
            $validated['avatar'] = $request->file('avatar')->store('users', 'public');
        }

        // Jika password dikosongkan, jangan ubah
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('dashboard.user.index')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('dashboard.user.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
