<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Detail_Penjualan;
use App\Models\Penjualan;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualan = Penjualan::all();
        return view('penjualan.index', compact('penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelanggan = Customer::all();
        $barang = Barang::all();
        return view('penjualan.create', compact('pelanggan', 'barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $penjualan = new Penjualan();
        $penjualan->user_id = Auth::user()->id;
        $penjualan->pelanggan_id = $request->penjualan['pelanggan_id'];
        $penjualan->save();
        foreach ($request->penjualanOrder as $detailPenjualan) {
            $barang = Barang::find($detailPenjualan['id_barang']);
            $barang->stok = $barang->stok - $detailPenjualan['jumlah_pesanan'];
            $barang->save();
            $detail_penjualan = new Detail_Penjualan();
            $detail_penjualan->penjualan_id = $penjualan->id;
            $detail_penjualan->barang_id = $barang->id;
            $detail_penjualan->jumlah = $detailPenjualan['jumlah_pesanan'];
            $detail_penjualan->save();
        }
        $response = [
            'success' => true
        ];
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penjualan = Penjualan::find($id);
        $detailPenjualan = $penjualan->detail_penjualan;
        return view('penjualan.show', compact('detailPenjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['pelanggan'] = Customer::get();
        $data['barang'] = Barang::all();
        $data['penjualan'] = Penjualan::with('detail_penjualan', 'detail_penjualan.barang')->find($id);
        return view('penjualan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $penjualan->pelanggan_id = $request->penjualan['pelanggan_id'];

        $penjualan->detail_penjualan->each(function ($item) {
            $barang = $item->barang;
            $barang->stok -= $item->jumlah;
            $barang->save();
            $item->delete();
        });

        foreach ($request->penjualanOrder as $item) {
            $detail_penjualan = new Detail_Penjualan();
            $detail_penjualan->penjualan_id = $penjualan->id;
            $detail_penjualan->barang_id = $item['barang_id'];
            $detail_penjualan->jumlah = $item['jumlah'];
            $detail_penjualan->save();
        }
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        $penjualan->detail_penjualan->each(function ($item) {
            $barang = $item->barang;
            $barang->stok += $item->jumlah;
            $barang->save();
            $item->delete();
        });

        $penjualan->delete();
        return redirect()->back();
    }

    public function print()
    {
        $penjualan = Penjualan::all();
        return view('penjualan.print', compact('penjualan'));
        // return PDF::loadView("penjualan.print", compact('penjualan'))->download("Laporan Penjualan " . date('YmdHis') . ".pdf");
    }
}
