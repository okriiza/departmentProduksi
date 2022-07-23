<!-- Modal -->
<div class="modal fade" id="createCustomer" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('customer.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="barang">Kode Customer</label>
                        <input type="text" value="{{ $codeCustomer }}" readonly name="code_customer"
                            class="form-control @error('code_customer') is-invalid @enderror" id="code_customer">
                        @error('code_customer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name_customer">Nama Customer</label>
                        <input type="text" value="" name="name_customer"
                            class="form-control @error('name_customer') is-invalid @enderror"
                            placeholder="Masukkan Nama Customer" id="name_customer">
                        @error('name_customer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone_customer">Phone Customer</label>
                        <input type="text" value="" name="phone_customer"
                            class="form-control @error('phone_customer') is-invalid @enderror"
                            placeholder="Masukkan Phone Customer" id="phone_customer">
                        @error('phone_customer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
