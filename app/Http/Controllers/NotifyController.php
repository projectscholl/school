<?php

namespace App\Http\Controllers;

use App\Models\Notify;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
    public function index()
    {
        $notify = Notify::where('id', 1)->get();
        $notify2 = Notify::where('id', 2)->get();
        $notify3 = Notify::where('id', 3)->get();
        return view('admin.notify.index', compact('notify', 'notify2', 'notify3'));
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
        $notify->update($data);
        return redirect()->route('admin.pesan-whatsaap.index')->with('success', 'Berhasil Mengubah Notification');
    }
}
