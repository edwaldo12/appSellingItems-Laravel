<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Good;
use App\Models\Supplier;
use App\Models\Container;
use App\Models\DetailGood;
use Illuminate\Support\Facades\Session;

class GoodController extends Controller
{
    public function index()
    {
        $goods = Good::all();
        return view('good.index', compact('goods'));
    }

    public function create()
    {
        return view('good.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => "required",
            "nomor_produk" => "required",
            "satuan" => "required",
            "jenis" => "required",
            "nomor_produk" => ["required", "min:6", "max:8"],
            "batch" => "required",
            "po" => ["required", "min:3"],
            "bs" => "required",
            "priority_check" => "required",
            "sampling" => ["required", "min:10"],
            "release" => ["required", "min:10"],
            "rejected" => ["required", "min:10"],
            "keterangan" => "required",
            "foto" => "required"
        ]);

        $good = new Good;
        $good->nama_produk = $request->nama_produk;
        $good->nomor_produk = $request->nomor_produk;
        $good->satuan = $request->satuan;
        $good->tanggal = date("Y/m/d");
        $good->jenis = $request->jenis;
        $good->nomor_produk = $request->nomor_produk;
        $good->batch = $request->batch;
        $good->po = $request->po;
        $good->bs = $request->bs;
        $good->priority_check = $request->priority_check;
        $good->sampling = $request->sampling;
        $good->release = $request->release;
        $good->rejected = $request->rejected;
        $good->keterangan = $request->keterangan;
        Session::flash('save_good', $good->save());

        foreach ($request->file('foto') as $_foto) {
            $detail = new DetailGood();
            $detail->foto = $_foto->getClientOriginalName();
            $detail->detail_id = $good->id;
            $_foto->move('foto', $detail->foto);
            $good->good_details()->save($detail);
        }
        return redirect()->route('goods.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $good = Good::findOrFail($id);
        return view('good.edit', compact('good'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => "required",
            "nomor_produk" => "required",
            "satuan" => "required",
            "jenis" => "required",
            "nomor_produk" => ["required", "min:6", "max:8"],
            "batch" => "required",
            "po" => ["required", "min:3"],
            "bs" => "required",
            "priority_check" => "required",
            "sampling" => ["required", "min:10"],
            "release" => ["required", "min:10"],
            "rejected" => ["required", "min:10"],
            "keterangan" => "required",
            "foto" => "required"
        ]);

        $good = Good::findOrFail($id);
        $good->nama_produk = $request->nama_produk;
        $good->nomor_produk = $request->nomor_produk;
        $good->satuan = $request->satuan;
        $good->tanggal = date("Y/m/d");
        $good->jenis = $request->jenis;
        $good->nomor_produk = $request->nomor_produk;
        $good->batch = $request->batch;
        $good->po = $request->po;
        $good->bs = $request->bs;
        $good->priority_check = $request->priority_check;
        $good->sampling = $request->sampling;
        $good->release = $request->release;
        $good->rejected = $request->rejected;
        $good->keterangan = $request->keterangan;
        Session::flash('save_good', $good->save());

        foreach ($request->file('foto') as $_foto) {
            $detail = new DetailGood();
            $detail->foto = $_foto->getClientOriginalName();
            $detail->detail_id = $good->id;
            $_foto->move('foto', $detail->foto);
            $good->good_details()->save($detail);
        }
        return redirect()->route('goods.index');
    }

    public function destroy($id)
    {
        $good = Good::findOrFail($id);
        Session::flash('delete_good', $good->delete());
        return redirect()->route('goods.index');
    }

    public function getFoto($id)
    {
        $good = Good::findOrFail($id);
        return response()->json([
            'foto' => $good->good_details()->get()
        ]);
    }

    public function hapusFoto($id)
    {
        $detailGood = DetailGood::findOrFail($id);
        $detailGood->delete();
        return redirect()->route('goods.index')->with('Status', 'Gambar Barang Berhasil Dihapus');
    }
}
