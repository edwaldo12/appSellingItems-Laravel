<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::all();
        return view('customer.index', compact('customer'));
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_customer' => "required",
            'telepon' => "required",
            'alamat' => "required",
        ]);

        $customer = new Customer;
        $customer->nama = $request->nama_customer;
        $customer->telepon = $request->telepon;
        $customer->alamat = $request->alamat;
        Session::flash('store_customer', $customer->save());
        return redirect()->route('customer.index');
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        dd($customer);
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $rules = [
            'nama_customer' => "required",
            'telepon' => "required",
            'alamat' => "required",
        ];
        $request->validate($rules);

        $customer->nama = $request->nama_customer;
        $customer->telepon = $request->telepon;
        $customer->alamat = $request->alamat;
        Session::flash('update_customer', $customer->save());
        return redirect()->route('customer.index');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        Session::flash('destroy_customer', $customer->delete());
        return redirect()->route('customer.index');
    }
}
