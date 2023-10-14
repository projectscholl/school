<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Instansi;
use App\Models\Murid;
use App\Models\TagihanDetail;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;


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
            activity()->causedBy(Auth::user())->event('login')->log('Wali murid ' . auth()->user()->name . ' melakukan login');

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
        })->with('murids')->get();

        $notifikasiMurids = $tagihanMurids->count();
        $jumlahMurid = Murid::where('id_users', $wali_id)->count();
        $murids = Murid::where('id_users', $wali_id)->get();
        $kartuSPPs = [];

        $tagihanSPPs = []; // Initialize it before the loop


        foreach ($murids as $murid) {
            $biayaRutin = $murid->biayas()->where('jenis_biaya', 'routine')->first();

            if ($biayaRutin) {
                $tagihanSPPs = $murid->tagihanDetail()
                    ->whereHas('tagihan', function ($query) use ($biayaRutin) {
                        $query->whereHas('biayas', function ($subquery) use ($biayaRutin) {
                            $subquery->where('jenis_biaya', 'routine')
                                ->where('id', $biayaRutin->id);
                        });
                    })
                    ->get();

                $bulanBulanan = [];
                $status = 'BELUM';

                foreach ($tagihanSPPs as $tagihanSPP) {
                    $bulan = $tagihanSPP->start_date;

                    if (!in_array($bulan, $bulanBulanan)) {
                        $bulanBulanan[] = $bulan;
                    }

                    if ($tagihanSPP->status === 'SUDAH') {
                        $status = 'SUDAH';
                    }
                }

                // Tambahkan data kartu SPP ke dalam array
                $kartuSPPs[] = [
                    'id_murids' => $murid->id,
                    'nama_murid' => $murid->name,
                    'bulan' => $bulanBulanan,
                    'status' => $status,
                ];
            }
        }


        return view('wali.dashboard', compact('jumlahMurid', 'instansi', 'tagihanMurids', 'notifikasiMurids', 'kartuSPPs', 'murids', 'tagihanSPPs'));
    }
}
