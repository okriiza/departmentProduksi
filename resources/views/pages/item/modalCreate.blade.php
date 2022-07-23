<!-- Modal -->
<div class="modal fade" id="createItem" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('item.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="barang">Kode Barang</label>
                        <input type="text" value="" name="code_item"
                            class="form-control @error('code_item') is-invalid @enderror" id="code_item"
                            placeholder="Masukkan Kode Barang">
                        @error('code_item')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name_item">Nama Barang</label>
                        <input type="text" value="" name="name_item"
                            class="form-control @error('name_item') is-invalid @enderror"
                            placeholder="Masukkan Nama item" id="name_item">
                        @error('name_item')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price_item">Harga Barang</label>
                        <input type="text" value="" name="price_item"
                            class="form-control @error('price_item') is-invalid @enderror"
                            placeholder="Masukkan Phone Customer" id="price_item">
                        @error('price_item')
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
