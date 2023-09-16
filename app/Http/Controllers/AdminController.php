<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Murid;
use App\Models\Pembayaran;
use App\Models\TagihanDetail;
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
        $instansi = Instansi::first();
        $user = Auth::user();
        $jumlahMurid = Murid::count();
        $tagihanDetail = TagihanDetail::all();

        $jumlahLunas = $tagihanDetail->where('status', 'SUDAH')->count();
        $jumlahBelumBayar = $tagihanDetail->where('status', 'BELUM')->count();
        $pembayaran = Pembayaran::all();
        $pembayaranDikonfirmasi = $pembayaran->where('payment_status', 'Dikonfirmasi')->count();
        $pembayaranBelum_Dikonfirmasi = $pembayaran->where('payment_status', 'Belum Di Konfirmasi')->count();
        return view('admin.dashboard', compact('user', 'jumlahMurid', 'instansi', 'tagihanDetail', 'jumlahBelumBayar', 'jumlahLunas', 'pembayaranDikonfirmasi', 'pembayaranBelum_Dikonfirmasi'));
    }
    public function edit()
    {
        $user = User::find(Auth::user()->id);
        $instansi = Instansi::first();
        return view('admin.user.profile', compact('user', 'instansi'));
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
