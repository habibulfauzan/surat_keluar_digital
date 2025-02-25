<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function list()
    {
        $PermissionRole = PermissionRoleModel::getPermission('User', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add User', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit User', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete User', Auth::user()->role_id);
        $data['getRecord'] = User::getRecord();
        return view('panel.user.list', $data);
    }
    public function add()
    {
        $PermissionRole = PermissionRoleModel::getPermission('Add User', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }
        $data['getRole'] = RoleModel::getRecord();
        return view('panel.user.add', $data);
    }

    public function edit($id)
    {
        $PermissionRole = PermissionRoleModel::getPermission('Edit User', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }
        $data['getRecord'] = User::getSingle($id);
        $data['getRole'] = RoleModel::getRecord();
        return view('panel.user.edit', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->role_id = trim($request->role_id);
        $user->save();

        return redirect('panel/user')->with('success', 'User created.');
    }

    public function update($id, Request $request)
    {
        $user = User::getSingle($id);
        $user->name = trim($request->name);
        if (!empty($request->passowrd)) {
            $user->password = Hash::make($request->password);
        }
        $user->role_id = trim($request->role_id);
        $user->save();

        return redirect('panel/user')->with('success', 'User updated .');
    }

    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->delete();

        return redirect('panel/user')->with('success', "User deleted");
    }
}
