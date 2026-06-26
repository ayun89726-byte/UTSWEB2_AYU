<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->get();
        return view("customers.index", compact('customers'));
    }

    public function create()
    {
        return view("customers.create");
    }

    public function store(Request $request)
    {
        Customer::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'alamat'  => $request->alamat,
        ]);

        return redirect()->route('admin.customers.index')->with('succes', 'customers berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $customer->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'alamat'  => $request->alamat,
        ]);

        return redirect()->route('admin.customers.index')->with('succes', 'Customer berhasil diupdate!');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customers.index')->with('succes', 'Customer berhasil dihapus!');
    }
}