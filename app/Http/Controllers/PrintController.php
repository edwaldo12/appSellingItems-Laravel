<?php

namespace App\Http\Controllers;

use App\Models\Good;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        if (!empty($r->start_date) && !empty($r->end_date)) {
            $goods = Good::whereBetween('created_at', [$r->start_date, $r->end_date . " 23:59:59"])->get();
        } else if (!empty($r->start_date)) {
            $goods = Good::whereDate('created_at', ">=", $r->start_date)->get();
        } else if (!empty($r->end_date)) {
            $goods = Good::whereDate('created_at', "<=", $r->end_date)->get();
        } else {
            $goods = Good::all();
        }
        return view('print.index', compact('goods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function print($good_id)
    {
        $good = Good::find($good_id);
        return view('print.printpage', compact('good'));
    }

    public function printall(Request $r)
    {
        if (!empty($r->start_date) && !empty($r->end_date)) {
            $goods = Good::whereBetween('created_at', [$r->start_date, $r->end_date . " 23:59:59"])->get();
        } else if (!empty($r->start_date)) {
            $goods = Good::whereDate('created_at', ">=", $r->start_date)->get();
        } else if (!empty($r->end_date)) {
            $goods = Good::whereDate('created_at', "<=", $r->end_date)->get();
        } else {
            $goods = Good::all();
        }
        return view('print.printall', compact('goods'));
    }
}
