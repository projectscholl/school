<?php

namespace App\Http\Controllers;

use App\Models\Notify;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifyController extends Controller
{
    public function index()
    {
        $notify = Notify::where('id', 1)->get();
        $notify2 = Notify::where('id', 2)->get();
        $notify3 = Notify::where('id', 3)->get();
        $notify4 = Notify::where('id', 4)->get();

        return view('admin.notify.index', compact('notify', 'notify2', 'notify3', 'notify4'));
    }
    public function edit()
    {
        //
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'notif' => 'required',
        ]);
        $notify = Notify::findOrFail($id);
        $tagihan = Tagihan::all();

        if ($notify->id == 4) {
            // print_r($ids[$keys]);

            $tagihanGet = Tagihan::all();
            $notify->update($data);
            foreach ($tagihanGet as $index => $tagihs) {
                $end_date = strtotime($notify->notif, strtotime($tagihs->end_date)); // foreach ($valid as $index => $n) {
                $end_dates = date('d-m', $end_date);
                $tagihanDetails = TagihanDetail::where('id_tagihan', $tagihs->id);
                $tagihanDetails->update([
                    'bulan' => $end_dates,
                ]);
                activity()->causedBy(Auth::user())->event('Updated')->log('User operator melakukan update notification ' . $notify->notif);
                // dd($notify);
            }
        }
        $notify->update($data);
        return redirect()->route('admin.pesan-whatsaap.index')->with('success', 'Berhasil Mengubah Notification');
    }
}
