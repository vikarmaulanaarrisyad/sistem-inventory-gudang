<x-modal data-backdrop="static" data-keyboard="false" size="modal-lg">
    <x-slot name="title">
        Tambah
    </x-slot>

    @method('POST')

    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="name">Nama <span class="text-danger" style="font-size: 0.80em">Supplier *</span></label>
                <input id="name" class="form-control form-control-border" type="text" name="name"
                    autocomplete="off" placeholder="Masukkan nama supplier">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="email">Email <span class="text-danger" style="font-size: 0.80em">Supplier
                        *</span></label>
                <input id="email" class="form-control form-control-border" type="email" name="email"
                    autocomplete="off" placeholder="Masukkan nama supplier">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="phone">Nomor Hp <span class="text-danger" style="font-size: 0.80em">Supplier
                        *</span></label>
                <input id="phone" class="form-control form-control-border" type="number" name="phone"
                    autocomplete="off" placeholder="Masukkan nama supplier">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="address">Alamat <span class="text-danger" style="font-size: 0.80em">Supplier
                        *</span></label>
                <textarea name="address" id="address" cols="30" rows="5" class="form-control"></textarea>
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
