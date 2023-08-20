<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Enum;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $user1 = User::where('role', 'ADMIN')->get();
        return view('admin.user.index', compact('user1', 'user'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:ADMIN,WALI',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('storage/image'), $imageName);
        $user = User::create([
            'name' => $request->name,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'password_confirm' => $request->password_confirm,
            'image' => $imageName,
        ]);
        if ($user) {
            return redirect(route('admin.user.index'))->with('success', 'Data berhasil dibuat');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email,' . $user['id'],
            'telepon' => 'required|min:8',
        ]);


        if ($request->image) {
            $content = $request->file('image');
            $imageName = time() . '.' . $content->extension();
            $path = 'image/' . $imageName;
            Storage::disk('public')->put($path, file_get_contents($content));
            $data['image'] = $imageName;
        } else {
            $user->image;
        }

        if (!$request->password) {
            $user->password;
        } else {
            $data = $request->validate([
                'password' => 'min:5',
                'password_confirmation' => 'required|same:password',
            ]);

            Hash::make($request->password);
        }
        $user->update($data);
        // dd($data);
        return redirect(route('admin.user.index'))->with('success', 'Berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user == Auth::user()) {
            return redirect()->route('admin.user.index')->with('error', 'User Sedang dipakai');
        }
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'Berhasil dihapus');
    }
}
