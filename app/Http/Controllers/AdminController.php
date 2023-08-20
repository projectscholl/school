<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        return view('admin.user.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user['id'],
            'telepon' => 'required',
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $path = 'image/' . $imageName;
        Storage::disk('public')->put($path, file_get_contents($request->image));
        $user->name = $request->name;
        $user->email = $request->email;
        $user->telepon = $request->telepon;
        $user->image = $imageName;
        // if ($user->image) {
        //     Storage::delete($user->image);
        // } elseif ($request->file('image')) {
        //     $content = $request->file('image');
        //     $imageName = time() . '.' . $content->extension();
        //     $path = 'image/' . $imageName;
        //     Storage::disk('public')->put($path, file_get_contents($content));
        //     $user['image'] = $imageName;
        // } else {
        //     $user->image;
        // }

        $user->save();

        return redirect()->route('admin.profile.edit',);
    }
}
