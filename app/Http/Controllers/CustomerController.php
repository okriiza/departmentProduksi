<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        $codeCustomer = 'CUST-' . date('Ym') . '-' . rand(1, 9999);
        return view('pages.customer.index', compact('customers', 'codeCustomer'));
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
        $request->validate([
            'code_customer' => 'required|unique:customers',
            'name_customer' => 'required',
            'phone_customer' => 'required',
        ]);

        $customer = Customer::create([
            'code_customer' => $request->code_customer,
            'name_customer' => $request->name_customer,
            'phone_customer' => $request->phone_customer,
        ]);

        return redirect()->route('customer.index')->with('success', 'Data berhasil ditambahkan');
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
        $request->validate([
            'code_customer' => 'required',
            'name_customer' => 'required',
            'phone_customer' => 'required',
        ]);

        $customer = Customer::find($id);

        $customer->update([
            'code_customer' => $request->code_customer,
            'name_customer' => $request->name_customer,
            'phone_customer' => $request->phone_customer,
        ]);

        return redirect()->route('customer.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'Data berhasil dihapus');
    }
}
