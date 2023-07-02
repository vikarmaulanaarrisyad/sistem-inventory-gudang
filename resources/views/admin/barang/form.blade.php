<x-modal data-backdrop="static" data-keyboard="false" size="modal-md">
    <x-slot name="title">
        Tambah
    </x-slot>

    @method('POST')

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="code">Kode <span class="text-danger" style="font-size: 0.80em">Barang *</span></label>
                <input id="code" class="form-control form-control-border" type="text" name="code"
                    autocomplete="off" placeholder="Masukkan kode barang">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="name">Nama <span class="text-danger" style="font-size: 0.80em">Barang *</span></label>
                <input id="name" class="form-control form-control-border" type="text" name="name"
                    autocomplete="off" placeholder="Masukkan nama barang">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="name">Kategori <span class="text-danger" style="font-size: 0.80em">Barang
                        *</span></label>
                <select name="categories" id="categories" class="form-control select2"></select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="satuan">Satuan <span class="text-danger" style="font-size: 0.80em">Barang
                        *</span></label>
                <select name="satuan" id="satuan" class="form-control select2"></select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="harga_beli">Harga Beli <span class="text-danger" style="font-size: 0.80em">Barang
                        *</span></label>
                <input id="harga_beli" class="form-control form-control-border" type="text" name="harga_beli"
                    autocomplete="off" placeholder="Masukkan harga beli barang" min="0" onkeyup="format_uang(this)">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="harga_jual">Harga Jual <span class="text-danger" style="font-size: 0.80em">Barang
                        *</span></label>
                <input id="harga_jual" class="form-control form-control-border" type="text" name="harga_jual"
                    autocomplete="off" placeholder="Masukkan harga jual barang" min="0" onkeyup="format_uang(this)">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="stock">Stok <span class="text-danger" style="font-size: 0.80em">Barang
                        *</span></label>
                <input id="stock" class="form-control form-control-border" type="number" name="stock"
                    autocomplete="off" placeholder="Masukkan stok barang" min="0" onkeyup="format_uang(this)">
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <button type="button" onclick="submitForm(this.form)" class="btn btn-sm btn-outline-primary" id="submitBtn">
            <span id="spinner-border" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <i class="fas fa-save mr-1"></i>
            Simpan</button>
        <button type="button" data-dismiss="modal" class="btn btn-sm btn-outline-danger">
            <i class="fas fa-times"></i>
            Close
        </button>
    </x-slot>
</x-modal>
