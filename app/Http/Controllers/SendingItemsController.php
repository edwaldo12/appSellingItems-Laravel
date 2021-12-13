<?php

namespace App\Http\Controllers;

use App\Models\Container;
use App\Models\DetailSendingItem;
use App\Models\Good;
use App\Models\SendingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SendingItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sendingItems = SendingItem::all();
        return view('pengiriman.index', compact('sendingItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $goods = Good::all();
        return view('pengiriman.create', compact('goods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "jenis" => "required",
            "no_container" => "required",
            "plat_nomor" => "required",
            "po" => "required",
            "good_id" => "required",
            "keterangan" => "required",
            "foto" => "required"
        ]);

        $sendingItems = new SendingItem;
        $sendingItems->tanggal = date("Y/m/d");
        $sendingItems->jenis = $request->jenis;
        $sendingItems->no_container = $request->no_container;
        $sendingItems->plat_nomor = $request->plat_nomor;
        $sendingItems->po = $request->po;
        $sendingItems->good_id = $request->good_id;
        $sendingItems->keterangan = $request->keterangan;
        Session::flash('save_sending_items', $sendingItems->save());

        foreach ($request->file('foto') as $_foto) {
            $detail = new DetailSendingItem;
            $detail->photo = $_foto->getClientOriginalName();
            $detail->detail_id = $sendingItems->id;
            $_foto->move('foto', $detail->photo);
            $sendingItems->detail_picture()->save($detail);
        }
        return redirect()->route('sendingItems.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SendingItem  $sendingItem
     * @return \Illuminate\Http\Response
     */
    public function show(SendingItem $sendingItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SendingItem  $sendingItem
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sendingItem = SendingItem::findOrFail($id);
        $goods = Good::all();
        return view('pengiriman.edit', compact('sendingItem', 'goods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SendingItem  $sendingItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "jenis" => "required",
            "no_container" => "required",
            "plat_nomor" => "required",
            "po" => "required",
            "good_id" => "required",
            "keterangan" => "required",
            "foto" => "required"
        ]);

        $sendingItems = SendingItem::findOrFail($id);
        $sendingItems->tanggal = date("Y/m/d");
        $sendingItems->jenis = $request->jenis;
        $sendingItems->no_container = $request->no_container;
        $sendingItems->plat_nomor = $request->plat_nomor;
        $sendingItems->po = $request->po;
        $sendingItems->good_id = $request->good_id;
        $sendingItems->keterangan = $request->keterangan;
        Session::flash('save_sending_items', $sendingItems->save());

        foreach ($request->file('foto') as $_foto) {
            $detail = new DetailSendingItem;
            $detail->photo = $_foto->getClientOriginalName();
            $detail->detail_id = $sendingItems->id;
            $_foto->move('foto', $detail->photo);
            $sendingItems->detail_picture()->save($detail);
        }
        return redirect()->route('sendingItems.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SendingItem  $sendingItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sendingItem = SendingItem::findOrFail($id);
        Session::flash('delete_sendingItem', $sendingItem->delete());
        return redirect()->route('sendingItems.index');
    }

    public function getFoto($id)
    {
        $sendingItem = SendingItem::findOrFail($id);
        return response()->json([
            'foto' => $sendingItem->detail_picture()->get()
        ]);
    }

    public function hapusFoto($id)
    {
        $detailSendingItem = DetailSendingItem::findOrFail($id);
        $detailSendingItem->delete();
        return redirect()->route('sendingItems.index')->with('Status', 'Gambar Pengiriman Berhasil Dihapus');
    }
}
