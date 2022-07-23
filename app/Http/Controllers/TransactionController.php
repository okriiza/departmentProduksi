<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Sales;
use App\Models\SalesDet;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $sales = Sales::with(['customer', 'salesDet'])->get();

        return view('pages.transaction.list-transaction', compact('sales'));
    }
    public function showTransaction()
    {
        $lastSales = Sales::orderBy('created_at', 'desc')->first();

        if (isset($lastSales)) {
            $getLastCode = explode('-', $lastSales->code_sale);
            // dd($getLastCode);
            $code = date('Ym') . '-' . str_pad($getLastCode[1] + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $code = date('Ym') . '-' . str_pad(1, 4, '0', STR_PAD_LEFT);
        }
        $customer = Customer::all();
        $items = Item::all();

        // dd(session()->all());
        return view('pages.transaction.transaction', compact('customer', 'code', 'items'));
    }

    public function addItemCart(Request $request)
    {
        $id = $request->items;
        $item = Item::find($id);
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            $quantity = $request->quantity ?? 1;
            $discountValue = ($request->discount / 100) * $item->price_item;
            $discountPrice = $item->price_item - $discountValue;
            $totalPrice = $discountPrice * $quantity;
            $cart[$id] = [
                'id' => $id,
                'code_item' => $item->code_item,
                'name_item' => $item->name_item,
                'price_item' => $item->price_item,
                'quantity' => $quantity,
                'discount_percentage' => $request->discount ?? 0,
                'discount_value' => $discountValue,
                'discount_price' => $discountPrice,
                'total_price' => $totalPrice,

            ];
        } else {
            $cart[$id]['quantity']++;
            $cart[$id]['discount_percentage'] = $request->discount ?? 0;
            $cart[$id]['discount_value'] = ($request->discount / 100) * $cart[$id]['price_item'];
            $cart[$id]['discount_price'] = $cart[$id]['price_item'] - $cart[$id]['discount_value'];
            $cart[$id]['total_price'] = $cart[$id]['discount_price'] * $cart[$id]['quantity'];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Item added to cart successfully');
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (count($cart) == 0) {
            return redirect()->back()->with('error', 'Barang Belum Ditambahkan');
        }
        $request->validate([
            'code_sale' => 'required',
            'date_sale' => 'required',
            'customer_id' => 'required|exists:customers,id',
            'discount' => 'required',
            'shipping_cost' => 'required',
        ], [
            'date_sale.required' => 'Tanggal Belum Di Pilih',
            'customer_id.required' => 'Customer Belum Di Pilih',
            'customer_id.exists' => 'Data Customer Tidak Ditemukan',
            'discount.required' => 'Diskon Belum Di Isi',
            'shipping_cost.required' => 'Ongkir Belum Di Isi',
        ]);

        $subtotal = 0;
        $shippingCost = $request->shipping_cost;
        $discount = $request->discount;

        $sale = Sales::create([
            'code_sale' => $request->code_sale,
            'date_sale' => $request->date_sale,
            'customer_id' => $request->customer_id,
            'subtotal' => 0,
            'discount' => $discount,
            'shipping_cost' => $shippingCost,
            'total_payment' => 0
        ]);

        $getSessionCart = session()->get('cart', []);

        foreach ($getSessionCart as $item) {
            $subtotal += $item['total_price'];
            SalesDet::create([
                'sale_id' => $sale->id,
                'item_id' => $item['id'],
                'price_tag' => $item['price_item'],
                'quantity' => $item['quantity'],
                'discount_percentage' => $item['discount_percentage'],
                'discount_value' => $item['discount_value'],
                'discount_price' => $item['discount_price'],
                'total_amount' => $item['total_price'],
            ]);
        }
        $total =  $subtotal - $discount - $shippingCost;
        $sale->subtotal = $subtotal;
        $sale->total_payment = $total;
        $sale->save();
        session()->forget('cart');
        return redirect()->route('transaction.index')->with('success', 'Data Berhasil Disimpan');
    }
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            $cart[$request->id]['total_price'] = $request->quantity * $cart[$request->id]['discount_price'];
            session()->put('cart', $cart);
            session()->flash('success', 'Item updated successfully');
        }
    }
    public function destroy(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Item removed successfully');
        }
    }
}
