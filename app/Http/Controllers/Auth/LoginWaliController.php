<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Models\Murid;
use App\Models\TagihanDetail;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginWaliController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function index()
    {
        return view('auth.loginwali');
    }

    public function loginprocess(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials) && auth()->user()->role == 'WALI') {
            return redirect()->route('wali.dashboard');
        } else {
            return redirect()->route('login-wali')->withErrors([
                'email' => 'Hanya Wali Murid!!!!!',
                'password' => 'Hanya Wali Murid!!!!!'
            ])->withInput();
        }
    }

    public function dashboard()
    {
        $instansi = Instansi::first();
        $wali_id = Auth::user()->id;
        $tagihanMurids = TagihanDetail::whereHas('murids', function ($query) use ($wali_id) {
            $query->where('id_users', $wali_id);
        })->with('murids')
        ->get();
        $notifikasiMurids = $tagihanMurids->count();
        $jumlahMurid = Murid::where('id_users', $wali_id)->count();
        return view('wali.dashboard', compact('jumlahMurid', 'instansi', 'tagihanMurids', 'notifikasiMurids'));
    }
    

}
