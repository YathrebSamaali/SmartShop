<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    /**
     * Display paginated list of users
     */
    public function index()
    {
        $users = User::when(request('search'), function($query) {
                    $query->where('name', 'like', '%'.request('search').'%')
                          ->orWhere('email', 'like', '%'.request('search').'%');
                })
                ->paginate(5);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show user creation form
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store new user
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'last_login' => now()
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    /**
     * Display user details
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show user edit form
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user data
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
            'last_login' => now()
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    /**
     * Delete user
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }

    /**
     * Export users in specified format
     */
    public function export($format)
    {
        switch ($format) {
            case 'csv':
                return Excel::download(new UsersExport, 'users.csv');
            case 'excel':
                return Excel::download(new UsersExport, 'users.xlsx');
            case 'pdf':
                $users = User::all();
                $pdf = PDF::loadView('admin.users.export_pdf', compact('users'));
                return $pdf->download('users.pdf');
            default:
                abort(404, 'Unsupported format');
        }
    }
}
