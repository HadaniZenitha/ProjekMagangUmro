<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nid' => 'required|string|max:20|unique:users,nid|regex:/^[a-zA-Z0-9]+$/',
            'roles' => 'array',
            'roles.*' => 'string|exists:roles,name',
        ]);

        // Password di-generate dari NID
        $password = $request->nid;

        $user = User::create([
            'name' => $request->name,
            'nid' => $request->nid,
            'password' => Hash::make($password),
            'role' => $request->roles[0] ?? null,
        ]);

        // Assign roles
        if ($request->roles) {
            $roleNames = Role::whereIn('name', $request->roles)->pluck('name')->toArray();
            $user->syncRoles($roleNames);
        }

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan. Password: ' . $password);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nid' => 'required|string|max:20|regex:/^[a-zA-Z0-9]+$/|unique:users,nid,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'roles' => 'array',
            'roles.*' => 'string|exists:roles,name',
        ]);

        $updateData = [
            'name' => $request->name,
            'nid' => $request->nid,
        ];

        if ($request->roles) {
            $updateData['role'] = $request->roles[0];
        }

        // Jika password dikosongkan, generate dari NID
        if (!$request->password) {
            $updateData['password'] = Hash::make($request->nid);
        }

        $user->update($updateData);

        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        // Update roles
        if ($request->roles) {
            $roleNames = Role::whereIn('name', $request->roles)->pluck('name')->toArray();
            $user->syncRoles($roleNames);
        } else {
            $user->syncRoles([]);
        }

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Prevent self-deletion
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Tidak dapat menghapus akun Anda sendiri');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
