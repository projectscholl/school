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
        $messages = [
            'telepon.regex' => 'Nomor telepon harus diawali 08'
        ];
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'telepon' => 'required|min:12|max:12|regex:/^08\d+$/',
            'role' => 'required|in:ADMIN',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], $messages);
        $phone = ltrim($request->telepon, '0');
        $phone = '62' . $phone;
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('storage/image'), $imageName);
        $user = User::create([
            'name' => $request->name,
            'telepon' => $phone,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'password_confirm' => $request->password_confirm,
            'image' => $imageName,
        ]);
        if ($user) {
            return redirect(route('admin.user.index'))->with('success', 'Berhasil membuat data User = ' . $request->name);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }
    public function deleteSelect(Request $request)
    {
        $ids = $request->ids;
        $user = User::whereIn('id', $ids);
        $users = User::where('id', $ids)->first();
        if ($users == Auth::user()) {
            return redirect()->route('admin.user.index')->with('pesan', 'User Sedang dipakai');
        }
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'Berhasil menghapus data');
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
        $messages = [
            'telepon.regex' => 'Nomor telepon harus diawali 08'
        ];
        $data = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email,' . $user['id'],
            'telepon' => 'required|min:8|regex:/^08\d+$/',
        ], $messages);


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
                'name' => 'required|min:3',
                'email' => 'required|unique:users,email,' . $user['id'],
                'telepon' => 'required|min:8|regex:/^08\d+$/',
                'password' => 'min:5',
                'password_confirmation' => 'required|same:password',
            ], $messages);
            $telepon = ltrim($data['telepon'], '0');
            $data['telepon'] = '62' . $telepon;
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
            return redirect()->route('admin.user.index')->with('errors', 'User Sedang dipakai');
        }
        $user->delete();

        return redirect()->route('admin.user.index')->with('success');
    }
}
