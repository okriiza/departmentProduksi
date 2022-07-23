@extends('layouts.home')
@section('title')
    Barang - Department Produksi
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#createItem"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Barang</button>
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
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->code_item }}</td>
                                        <td>{{ $item->name_item }}</td>
                                        <td>{{ number_format($item->price_item, 2) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-primary btn-circle btn-sm"
                                                data-toggle="modal" data-target="#updateItem" data-id="{{ $item->id }}"
                                                data-codeitem="{{ $item->code_item }}"
                                                data-nameitem="{{ $item->name_item }}"
                                                data-phoneitem="{{ $item->price_item }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <form action="{{ route('item.destroy', $item->id) }}" method="post"
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
    @include('pages.item.modalCreate');
    @include('pages.item.modalUpdate');
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            @if (Session::has('errors'))
                $('#createItem').modal({
                    show: true
                });
            @endif
            $('#updateItem').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var codeItem = button.data('codeitem')
                var nameItem = button.data('nameitem')
                var priceItem = button.data('phoneitem')
                var modal = $(this)
                $('#updateForm').attr('action', '/item/' + id);
                modal.find('.modal-body #id').val(id)
                modal.find('.modal-body #code_item').val(codeItem)
                modal.find('.modal-body #name_item').val(nameItem)
                modal.find('.modal-body #price_item').val(priceItem)
            })
        });
    </script>
@endpush
