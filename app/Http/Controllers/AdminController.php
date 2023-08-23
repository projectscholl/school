<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    /** 
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $jumlahMurid = Murid::count();
        return view('admin.dashboard', compact('user', 'jumlahMurid'));
    }
    public function edit()
    {
        $user = User::find(Auth::user()->id);
        return view('admin.user.profile', compact('user'));
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
            $user->password;
        }

        $user->update($validate);

        return redirect()->back()->with('message', 'Success Update User');
    }
}
