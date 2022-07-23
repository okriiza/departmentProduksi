@extends('layouts.home')

@section('title')
    form-transaction - Department Produksi
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Transaksi</h1>
        {{-- <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#addItem"><i class="fas fa-cash-register fa-sm text-white-50"></i> Tambah Barang</button> --}}
    </div>
    <div class="row">

        <div class="col-lg-12">
            <form action="{{ route('transaction.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                        <div class="card border-left-primary shadow">
                            <div class="card-body">
                                <h5>Transaksi</h5>
                                <div class="form-group">
                                    <label for="">No Transaksi </label>
                                    <input readonly name="code_sale"
                                        class="form-control @error('code_sale') is-invalid @enderror" type="text"
                                        value="{{ $code }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal </label>
                                    <input type="date" name="date_sale"
                                        class="form-control @error('date_sale') is-invalid @enderror" value="">
                                    @error('date_sale')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                        <div class="card border-left-success shadow">
                            <div class="card-body">
                                <h5>Customer</h5>
                                <div class="form-group">
                                    <label for="">Code Customer</label>
                                    <select name="customer_id" id="customer_id"
                                        class="form-control customer_id @error('customer_id') is-invalid @enderror">
                                        {{-- @foreach ($customer as $item)
                                            <option value="{{ $item->id }}">{{ $item->customer_id }}</option>
                                        @endforeach --}}
                                    </select>
                                    @error('customer_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name_customer">Nama Customer</label>
                                    <input type="text" name="name_customer" id="name_customer" class="form-control"
                                        disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Telp</label>
                                    <input type="text" name="phone_customer" id="phone_customer" class="form-control"
                                        disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-lg-12">
                        <div class="card border-left-danger shadow">
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <span class="mb-3 float-lg-right btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                                    data-target="#addItem"><i class="fa fa-plus fa-sm text-white-50"></i> Tambah
                                    Barang</span>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">Kode Barang</th>
                                                <th rowspan="2">Nama Barang</th>
                                                <th rowspan="2" style="width:10%;">Quantity</th>
                                                <th rowspan="2">Harga Bandrol</th>
                                                <th colspan="2">Diskon</th>
                                                <th rowspan="2">Harga Diskon</th>
                                                <th rowspan="2">Total</th>
                                                <th rowspan="2">Aksi</th>
                                            </tr>
                                            <tr class="text-center">
                                                <th>%</th>
                                                <th>(Rp)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (session('cart'))
                                                @php
                                                    $subtotal = 0;
                                                    $no = 1;
                                                @endphp
                                                @foreach (session('cart') as $id => $item)
                                                    @php $subtotal += $item['total_price'] ; @endphp
                                                    <tr data-id="{{ $id }}">
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $item['code_item'] }}</td>
                                                        <td>{{ $item['name_item'] }}</td>
                                                        <td data-th='Quantity'>
                                                            <input type="number" value="{{ $item['quantity'] }}"
                                                                class="form-control quantity update-cart">
                                                        </td>
                                                        <td>{{ number_format($item['price_item'], 2) }}</td>
                                                        <td>
                                                            {{ $item['discount_percentage'] ?? 0 }}

                                                        </td>
                                                        <td>{{ number_format($item['discount_value'], 2) ?? 0 }}</td>
                                                        <td>{{ number_format($item['discount_price'], 2) ?? 0 }}</td>
                                                        <td>{{ number_format($item['total_price'], 2) }}</td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm remove-from-cart"><i
                                                                    class="fas fa-trash"></i></button>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr class="text-center">
                                                    <td colspan="10">Data Tidak Tersedia</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row float-lg-right mt-3">
                    {{-- <div class="col-lg-4">

                    </div> --}}
                    <div class="col-lg-12">
                        <div class="card border-left-warning shadow ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="my-2">
                                            <b>Subtotal</b>
                                            <span id="subtotal" class="float-right">{{ $subtotal ?? 0 }}</span>
                                        </div>
                                        <div class="my-2">
                                            <div class="row">
                                                <div class="col-6">
                                                    <b>Discount</b>
                                                </div>
                                                <div class="col-6">
                                                    <input type="number" id="discount" value="" onkeyup="sum()"
                                                        class="form-control @error('discount') is-invalid @enderror discount float-right"
                                                        name="discount">
                                                    @error('discount')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-2">
                                            <div class="row">
                                                <div class="col-6">
                                                    <b>Ongkir</b>
                                                </div>
                                                <div class="col-6">
                                                    <input type="number" id="shipping_cost" value=""
                                                        onkeyup="sum()"
                                                        class="form-control @error('shipping_cost') is-invalid @enderror shipping_cost float-right"
                                                        name="shipping_cost">
                                                    @error('shipping_cost')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-2">
                                            <b>Total Bayar</b>
                                            <span id="total" class="float-right">0</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- <table width="100%">
                                    <tr>
                                        <th>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </table> --}}
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-sm btn-success shadow-sm">Simpan</button>
                                    <a href="{{ route('transaction.index') }}"
                                        class="btn btn-sm btn-warning shadow-sm">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('pages.transaction.modalItem')
@endsection

@push('addon-script')
    <script>
        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(number);
        }
        var subTotalFormat = rupiah({{ $subtotal ?? 0 }});
        $("#subtotal").text(subTotalFormat)
        $("#total").text(subTotalFormat);

        function sum() {
            var subtotal = {{ $subtotal ?? 0 }};
            var discount = $("#discount").val();
            var shipping_cost = $("#shipping_cost").val();
            var total = subtotal - discount - shipping_cost;
            $("#total").text(rupiah(total));

        }
        $(".update-cart").on('change', function(e) {
            e.preventDefault();
            var getAttr = $(this);
            $.ajax({
                url: '{{ route('transaction.update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: getAttr.parents("tr").attr("data-id"),
                    quantity: getAttr.parents("tr").find(".quantity").val()
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        $(".remove-from-cart").click(function(e) {
            e.preventDefault();
            var getAttr = $(this);
            if (confirm("Are you sure want to remove?")) {
                $.ajax({
                    url: '{{ route('transaction.destroy') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: getAttr.parents("tr").attr("data-id")
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
        $(document).ready(function() {
            $('#customer_id').select2({
                placeholder: 'Pilih Customer',
                //getCustomer
                ajax: {
                    url: "{{ route('jqueryAjax.getCustomer') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.code_customer + ' - ' + item.name_customer,
                                    phone_customer: item.phone_customer,
                                    name_customer: item.name_customer
                                }
                            })
                        };
                    },
                }
            });
            $('#customer_id').on('select2:select', function(e) {
                var data = e.params.data;
                console.log(data)
                $('#name_customer').val(data.name_customer);
                $('#phone_customer').val(data.phone_customer);
            });
            $('.items').select2({
                placeholder: "Pilih Barang",
                dropdownParent: $('#addItem'),
            });
        });
    </script>
@endpush
