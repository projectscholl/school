<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileWaliController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $instansi = Instansi::first();
        return view('wali.profile-wali', compact('user', 'instansi'));
    }
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $validate = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telepon' => 'required'
        ]);

        if ($request->image) {
            $content = $request->file('image');
            $imageName = time() . '.' . $content->extension();
            $path = 'image/' . $imageName;
            Storage::disk('public')->put($path, file_get_contents($content));
            $validate['image'] = $imageName;
        } else {
            $user->image;
        }
        //password

        if ($request->password && $request->old_password) {
            $validate = $request->validate([
                'old_password' => 'required',
                'password' => 'required|confirmed',
            ]);
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back();
            }
            $validate['password'] = Hash::make($request->password);
        } else {
            $user->save();
        }

        $user->update($validate);

        return redirect()->back()->with('message', 'Success Update Wali Murid!!');
    }
}
