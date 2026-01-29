<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use HasinHayder\Tyro\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRoleController extends Controller
{
    /**
     * Display all users with their roles
     */
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(15);
        $roles = Role::all();

        return view('admin.user-roles.index', compact('users', 'roles'));
    }

    /**
     * Update roles for a specific user
     */
    public function updateUserRoles(Request $request, User $user)
    {
        $validated = $request->validate([
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $roleIds = $validated['roles'] ?? [];
        $user->roles()->sync($roleIds);

        return back()->with('success', 'User roles updated successfully!');
    }

    /**
     * Add users to a specific role
     */
    public function addUsersToRole(Request $request, Role $role)
    {
        $validated = $request->validate([
            'users' => 'required|array',
            'users.*' => 'exists:users,id',
        ]);

        $userIds = $validated['users'];
        
        // Attach users to role (without detaching existing ones)
        $role->users()->syncWithoutDetaching($userIds);

        return back()->with('success', 'Users added to role successfully!');
    }

    /**
     * Remove a user from a role
     */
    public function removeUserFromRole(Role $role, User $user)
    {
        $role->users()->detach($user->id);

        return back()->with('success', 'User removed from role successfully!');
    }
}
