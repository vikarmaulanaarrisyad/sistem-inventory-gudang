<div id="modalDetail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                        Detail Data Barang
                </h5>
            </div>
            <div class="modal-body">
                <x-table>
                    <x-slot name="thead">
                        <tr>
                            <td style="width: 15px">Kode Barang</td>
                            <td style="width: 5px">:</td>
                            <td id="kodeBarang">0</td>
                        </tr>
                        <tr>
                            <td style="width: 15px">Nama Barang</td>
                            <td style="width: 5px">:</td>
                            <td id="namaBarang">0</td>
                        </tr>
                        <tr>
                            <td style="width: 15px">Kategori Barang</td>
                            <td style="width: 5px">:</td>
                            <td id="kategoriBarang">0</td>
                        </tr>
                        <tr>
                            <td style="width: 15px">Satuan Barang</td>
                            <td style="width: 5px">:</td>
                            <td id="satuanBarang">0</td>
                        </tr>
                        <tr>
                            <td style="width: 15px">Harga Beli Barang</td>
                            <td style="width: 5px">:</td>
                            <td id="hargaBeliBarang">0</td>
                        </tr>
                        <tr>
                            <td style="width: 15px">Harga Jual Barang</td>
                            <td style="width: 5px">:</td>
                            <td id="hargaJualBarang">0</td>
                        </tr>
                        <tr>
                            <td style="width: 15px">Stok Barang</td>
                            <td style="width: 5px">:</td>
                            <td id="stokBarang">0</td>
                        </tr>
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
</div>
