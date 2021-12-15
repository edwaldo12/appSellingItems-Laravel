<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Detail_Pembelian;
use App\Models\Pembelian;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembelian = Pembelian::all();
        return view('pembelian.index', compact('pembelian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::all();
        $barang = Barang::all();
        return view('pembelian.create', compact('supplier', 'barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pembelian = new Pembelian();
        $pembelian->user_id = Auth::user()->id;
        $pembelian->id_supplier = $request->pembelian['id_supplier'];
        $pembelian->save();
        foreach ($request->pembelianOrder as $detailPembelian) {
            $barang = Barang::find($detailPembelian['id_barang']);
            $barang->stok = $barang->stok + $detailPembelian['jumlah_pesanan'];
            $barang->save();
            $detail_pembelian = new Detail_Pembelian();
            $detail_pembelian->id_pembelian = $pembelian->id;
            $detail_pembelian->id_barang = $barang->id;
            $detail_pembelian->jumlah = $detailPembelian['jumlah_pesanan'];
            $detail_pembelian->save();
        }
        $response = [
            'success' => true
        ];
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pembelian = Pembelian::find($id);
        $detailPembelian = $pembelian->detail_pembelian;
        return view('pembelian.show', compact('detailPembelian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['supplier'] = Supplier::get();
        $data['barang'] = Barang::all();
        $data['pembelian'] = Pembelian::with('detail_pembelian', 'detail_pembelian.barang')->find($id);
        return view('pembelian.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        $pembelian->id_supplier = $request->pembelian['id_supplier'];

        $pembelian->detail_pembelian->each(function ($item) {
            $barang = $item->barang;
            $barang->stok += $item->jumlah;
            $barang->save();
            $item->delete();
        });

        foreach ($request->pembelianOrder as $item) {
            $detail_pembelian = new Detail_Pembelian;
            $detail_pembelian->id_pembelian = $pembelian->id;
            $detail_pembelian->id_barang = $item['id_barang'];
            $detail_pembelian->jumlah = $item['jumlah'];
            $detail_pembelian->save();
        }

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelian $pembelian)
    {
        $pembelian->detail_pembelian->each(function ($item) {
            $barang = $item->barang;
            $barang->stok -= $item->jumlah;
            $barang->save();
            $item->delete();
        });

        $pembelian->delete();
        return redirect()->back();
    }

    public function checkStok($id)
    {
        $barang = Barang::find($id);
        return response()->json($barang);
    }

    public function print()
    {
        $pembelian = pembelian::all();
        return view('pembelian.print', compact('pembelian'));
        // return PDF::loadView("pembelian.print", compact('pembelian'))->download("Laporan Pembelian " . date('YmdHis') . ".pdf");
    }
}
