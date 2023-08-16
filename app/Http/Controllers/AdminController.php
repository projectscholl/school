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

    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'telepon' => 'required',
        ]);

        $user = Auth::user();
        if ($request->image) {
            $content = $request->file('image');
            $imageName = time() . '.' . $content->extension();
            $path = 'image/' . $imageName;
            Storage::disk('public')->put($path, file_get_contents($content));
            $data['image'] = $imageName;
        } else {
            $user->image;
        }
        

        return redirect()->route('admin.profile');
    }
}
