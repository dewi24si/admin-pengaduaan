<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __construct()
    {
        // Hanya admin yang bisa akses semua method kecuali edit profile sendiri
        $this->middleware('admin')->except(['edit', 'update']);
    }

    public function index(Request $request)
    {
        $query = User::query()->latest();

        // Search: nama / email
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter: role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter: waktu registrasi
        if ($request->filled('registered')) {
            switch ($request->registered) {
                case 'today':
                    $query->whereDate('created_at', Carbon::today());
                    break;
                case 'week':
                    $query->where('created_at', '>=', Carbon::now()->subDays(7));
                    break;
                case 'month':
                    $query->where('created_at', '>=', Carbon::now()->subDays(30));
                    break;
            }
        }

        $users = $query->paginate(10)->appends($request->query());

        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,petugas', // TAMBAH VALIDASI ROLE
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // TAMBAH ROLE
        ]);

        return redirect()->route('users.index')->with('success', 'Data user berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Petugas hanya bisa edit profile sendiri
        if (auth()->user()->isPetugas() && $user->id != auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Anda hanya bisa mengedit profil sendiri.');
        }

        return view('pages.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Petugas hanya bisa edit profile sendiri
        if (auth()->user()->isPetugas() && $user->id != auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Anda hanya bisa mengedit profil sendiri.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => auth()->user()->isAdmin() ? 'required|in:admin,petugas' : '', // Hanya admin bisa ubah role
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Hanya admin yang bisa ubah role
        if (auth()->user()->isAdmin() && $request->has('role')) {
            $data['role'] = $request->role;
        }

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if ($id == auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        User::findOrFail($id)->delete();
        return redirect()->route('users.index')->with('success', 'Data user berhasil dihapus.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.show', compact('user'));
    }
}