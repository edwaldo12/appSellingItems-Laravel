<?php

namespace App\Http\Controllers;

use App\Models\Container;
use Illuminate\Http\Request;

class PrintContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        if (!empty($r->start_date) && !empty($r->end_date)) {
            $containers = Container::whereBetween('created_at', [$r->start_date, $r->end_date . " 23:59:59"])->get();
        } else if (!empty($r->start_date)) {
            $containers = Container::whereDate('created_at', ">=", $r->start_date)->get();
        } else if (!empty($r->end_date)) {
            $containers = Container::whereDate('created_at', "<=", $r->end_date)->get();
        } else {
            $containers = Container::all();
        }
        return view('printContainer.index', compact('containers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function print(Request $r, $container_id)
    {
        $container = Container::find($container_id);
        return view('printContainer.printpage', compact('container'));
    }

    public function printcontainerall(Request $r)
    {
        if (!empty($r->start_date) && !empty($r->end_date)) {
            $containers = Container::whereBetween('created_at', [$r->start_date, $r->end_date . " 23:59:59"])->get();
        } else if (!empty($r->start_date)) {
            $containers = Container::whereDate('created_at', ">=", $r->start_date)->get();
        } else if (!empty($r->end_date)) {
            $containers = Container::whereDate('created_at', "<=", $r->end_date)->get();
        } else {
            $containers = Container::all();
        }
        return view('printContainer.printall', compact('containers'));
    }
}
