<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $user = User::find($id);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('password', 'Currrent password do not match!');
        }
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('admin.user.index');
    }
}
