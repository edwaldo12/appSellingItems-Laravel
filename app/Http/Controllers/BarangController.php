<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PDF;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => "required",
            'satuan' => "required",
            'harga_beli' => "required",
            'harga_jual' => "required",
            'stok' => "required",
        ]);

        $barang = new Barang;
        $barang->nama = $request->nama;
        $barang->satuan = $request->satuan;
        $barang->harga_beli = $request->harga_beli;
        $barang->harga_jual = $request->harga_jual;
        $barang->stok = $request->stok;
        Session::flash('store_barang', $barang->save());
        return redirect()->route('barang.index');
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        dd($barang);
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $rules = [
            'nama' => "required",
            'satuan' => "required",
            'harga_beli' => "required",
            'harga_jual' => "required",
            'stok' => "required",
        ];
        $request->validate($rules);


        $barang->nama = $request->nama;
        $barang->satuan = $request->satuan;
        $barang->harga_beli = $request->harga_beli;
        $barang->harga_jual = $request->harga_jual;
        $barang->stok = $request->stok;
        Session::flash('update_barang', $barang->save());
        return redirect()->route('barang.index');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        Session::flash('destroy_barang', $barang->delete());
        return redirect()->route('barang.index');
    }

    public function print()
    {
        $barang = Barang::all();
        return view('barang.print', compact('barang'));
        // return PDF::loadView("barang.print", compact('barang'))->download("Laporan Barang " . date('YmdHis') . ".pdf");
    }
}
