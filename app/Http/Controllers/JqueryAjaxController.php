<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class JqueryAjaxController extends Controller
{
    public function getCustomer(Request $request)
    {
        $customer = Customer::all();
        return response()->json($customer);
    }
    public function showCustomer(Request $request)
    {
        $id = $request->id;
        $customer = Customer::find($id);
        return response()->json($customer);
    }
}
