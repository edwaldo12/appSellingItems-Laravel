<?php

namespace App\Http\Controllers;

use App\Models\SendingItem;
use Illuminate\Http\Request;

class PrintSendingItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        if (!empty($r->start_date) && !empty($r->end_date)) {
            $sendingItem = SendingItem::whereBetween('created_at', [$r->start_date, $r->end_date . " 23:59:59"])->get();
        } else if (!empty($r->start_date)) {
            $sendingItem = SendingItem::whereDate('created_at', ">=", $r->start_date)->get();
        } else if (!empty($r->end_date)) {
            $sendingItem = SendingItem::whereDate('created_at', "<=", $r->end_date)->get();
        } else {
            $sendingItem = SendingItem::all();
        }
        return view('printItem.index', compact('sendingItem'));
    }

    public function print(Request $r, $sendingItem_id)
    {
        $sendingItem = SendingItem::find($sendingItem_id);
        // dd($sendingItem);
        return view('printItem.printpage', compact('sendingItem'));
    }

    public function printSendingItemAll(Request $r)
    {
        if (!empty($r->start_date) && !empty($r->end_date)) {
            $sendingItems = SendingItem::whereBetween('created_at', [$r->start_date, $r->end_date . " 23:59:59"])->get();
        } else if (!empty($r->start_date)) {
            $sendingItems = SendingItem::whereDate('created_at', ">=", $r->start_date)->get();
        } else if (!empty($r->end_date)) {
            $sendingItems = SendingItem::whereDate('created_at', "<=", $r->end_date)->get();
        } else {
            $sendingItems = SendingItem::all();
        }
        return view('printItem.printall', compact('sendingItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
