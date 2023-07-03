<x-modal data-backdrop="static" data-keyboard="false" size="modal-xl">
    <x-slot name="title">
        Tambah
    </x-slot>

    <div class="row">
        <div class="col-md-12">
            <x-table class="tableBarangPencarian">
                <x-slot name="thead">
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Stok</th>
                    </tr>
                </x-slot>
            </x-table>
        </div>
    </div>


    <x-slot name="footer">
        <button type="button" data-dismiss="modal" class="btn btn-sm btn-outline-danger">
            <i class="fas fa-times"></i>
            Close
        </button>
    </x-slot>
</x-modal>
