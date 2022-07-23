@extends('layouts.home')
@section('title')
    Customer - Department Produksi
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Customer</h1>
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#createCustomer"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Customer</button>
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
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Customer</th>
                                    <th>Nama Customer</th>
                                    <th>Phone Customer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($customers as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->code_customer }}</td>
                                        <td>{{ $item->name_customer }}</td>
                                        <td>{{ $item->phone_customer }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-primary btn-circle btn-sm"
                                                data-toggle="modal" data-target="#updateCustomer"
                                                data-id="{{ $item->id }}"
                                                data-codecustomer="{{ $item->code_customer }}"
                                                data-namecustomer="{{ $item->name_customer }}"
                                                data-phonecustomer="{{ $item->phone_customer }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <form action="{{ route('customer.destroy', $item->id) }}" method="post"
                                                class="d-inline" onclick="return confirm('Yakin hapus data?')">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-outline-danger btn-circle btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.customer.modalCreate');
    @include('pages.customer.modalUpdate');
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            @if (Session::has('errors'))
                $('#createCustomer').modal({
                    show: true
                });
            @endif
            $('#updateCustomer').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var codeCustomer = button.data('codecustomer')
                var nameCustomer = button.data('namecustomer')
                var phoneCustomer = button.data('phonecustomer')
                console.log(nameCustomer);
                var modal = $(this)
                $('#updateForm').attr('action', '/customer/' + id);
                modal.find('.modal-body #id').val(id)
                modal.find('.modal-body #code_customer').val(codeCustomer)
                modal.find('.modal-body #name_customer').val(nameCustomer)
                modal.find('.modal-body #phone_customer').val(phoneCustomer)
            })
        });
    </script>
@endpush
