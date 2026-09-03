<?php

namespace App\Http\Controllers;

use App\Models\AdminAccount;
use Illuminate\Http\Request;

class AdminAccountController extends Controller
{
    public function index()
    {
        $admins = AdminAccount::all();

        return view('admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(Request $request)
    {
        $existingAdmin = AdminAccount::where('username', $request->username)->first();

        if ($existingAdmin) {
            return back()->with('error', 'Username admin sudah digunakan.');
        }

        AdminAccount::create([
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect('/admins');
    }

    public function edit(AdminAccount $admin)
    {
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, AdminAccount $admin)
    {
        $admin->update([
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect('/admins');
    }

    public function destroy(AdminAccount $admin)
    {
        $admin->delete();

        return redirect('/admins');
    }
}