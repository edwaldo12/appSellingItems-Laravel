<?php

namespace App\Http\Controllers;

use App\Models\Container;
use App\Models\DetailContainer;
use App\Models\Good;
use App\Models\SendingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $containers = Container::all();
        return view('container.index', compact('containers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sendingItems = SendingItem::all();
        return view('container.create', compact('sendingItems'));
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
            "sending_id" => "required",
            "no_seal_container" => "required",
            "type_container" => "required",
            "suhu_sebelum_loading" => "required",
            "suhu_sesudah_loading" => "required",
            "kondisi_fisik" => "required",
            "tidak_berbau_menyengat" => "required",
            "tidak_kotor" => "required",
            "tidak_terdapat_bocor" => "required",
            "status_container" => "required",
            "foto" => "required"
        ]);

        $container = new Container;
        $container->tanggal = date("Y/m/d");
        $container->jenis = $request->jenis;
        $container->sending_id = $request->sending_id;
        $container->no_seal_container = $request->no_seal_container;
        $container->type_container = $request->type_container;
        $container->suhu_sebelum_loading = $request->suhu_sebelum_loading;
        $container->suhu_sesudah_loading = $request->suhu_sesudah_loading;
        $container->kondisi_fisik = $request->kondisi_fisik;
        $container->tidak_berbau_menyengat = $request->tidak_berbau_menyengat;
        $container->tidak_kotor = $request->tidak_kotor;
        $container->tidak_terdapat_bocor = $request->tidak_terdapat_bocor;
        $container->status_container = $request->status_container;
        Session::flash('save_container', $container->save());

        foreach ($request->file('foto') as $fotoUpload) {
            $detail = new DetailContainer();
            $detail->detail_containers = $container->id;
            $detail->foto = $fotoUpload->getClientOriginalName();
            $fotoUpload->move('foto', $detail->foto);
            $container->detail_container()->save($detail);
        }
        return redirect()->route('containers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function show(Container $container)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $container = Container::findOrFail($id);
        $sendingItems = SendingItem::all();
        return view('container.edit', compact('container', 'sendingItems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "jenis" => "required",
            "sending_id" => "required",
            "no_seal_container" => "required",
            "type_container" => "required",
            "suhu_sebelum_loading" => "required",
            "suhu_sesudah_loading" => "required",
            "kondisi_fisik" => "required",
            "tidak_berbau_menyengat" => "required",
            "tidak_kotor" => "required",
            "tidak_terdapat_bocor" => "required",
            "status_container" => "required",
            "foto" => "required"
        ]);

        $container = Container::findOrFail($id);
        $container->tanggal = date("Y/m/d");
        $container->jenis = $request->jenis;
        $container->sending_id = $request->sending_id;
        $container->no_seal_container = $request->no_seal_container;
        $container->type_container = $request->type_container;
        $container->suhu_sebelum_loading = $request->suhu_sebelum_loading;
        $container->suhu_sesudah_loading = $request->suhu_sesudah_loading;
        $container->kondisi_fisik = $request->kondisi_fisik;
        $container->tidak_berbau_menyengat = $request->tidak_berbau_menyengat;
        $container->tidak_kotor = $request->tidak_kotor;
        $container->tidak_terdapat_bocor = $request->tidak_terdapat_bocor;
        $container->status_container = $request->status_container;
        Session::flash('update_container', $container->save());

        foreach ($request->file('foto') as $fotoUpload) {
            $detail = new DetailContainer();
            $detail->detail_containers = $container->id;
            $detail->foto = $fotoUpload->getClientOriginalName();
            $fotoUpload->move('foto', $detail->foto);
            $container->detail_container()->save($detail);
        }
        return redirect()->route('containers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $container = Container::findOrFail($id);
        Session::flash('delete_container', $container->delete());
        return redirect()->route('containers.index');
    }

    public function hapusFoto($id)
    {
        $detailContainer = DetailContainer::findOrFail($id);
        $detailContainer->delete();
        return redirect()->route('containers.index')->with('Status', 'Gambar Kontainer Berhasil Dihapus');
    }

    public function getFoto($id)
    {
        $container = Container::findOrFail($id);
        return response()->json([
            'foto' => $container->detail_container()->get()
        ]);
    }
}
