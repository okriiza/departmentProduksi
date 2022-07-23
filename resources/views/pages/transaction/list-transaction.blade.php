@extends('layouts.home')

@section('title')
    Daftar Transaksi - Department Produksi
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Transaksi</h1>
        <a href="{{ route('transaction.showTransaction') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-cash-register fa-sm text-white-50"></i>Transaksi</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-left-primary shadow ">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th style="width: 15%">No Transaksi</th>
                                    <th style="width: 15%">Tanggal</th>
                                    <th>Nama Customer</th>
                                    <th>Jumlah Barang</th>
                                    <th>Sub Total</th>
                                    <th>Diskon</th>
                                    <th>Ongkir</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                    $total = 0;
                                @endphp
                                @foreach ($sales as $item)
                                    @php $total += $item->total_payment; @endphp
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->code_sale }}</td>
                                        <td>{{ date('d-M-Y', strtotime($item->date_sale)) }}</td>
                                        <td>{{ $item->customer->name_customer }}</td>
                                        <td>{{ $item->salesDet->count() }}</td>
                                        <td>{{ number_format($item->subtotal, 2) }}</td>
                                        <td>{{ number_format($item->discount, 2) }}</td>
                                        <td>{{ number_format($item->shipping_cost, 2) }}</td>
                                        <td>{{ number_format($item->total_payment, 2) }}</td>
                                    </tr>
                                @endforeach
                            <tfoot>
                                <tr>
                                    <td colspan="7" class="text-right">Grand Total</td>
                                    <td colspan="2" class="text-right">{{ number_format($total, 2) }}</td>
                                </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('addon-script')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
