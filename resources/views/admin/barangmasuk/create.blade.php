@extends('layouts.app')

@section('title', 'Input Barang Masuk')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Input Barang Masuk</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <button class="btn btn-outline-info btn-sm"> <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali</button>
                </x-slot>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tglfaktur">No Transaksi Barang Masuk</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Input Transaksi" name="transaksi"
                                    id="transaksi" autocomplete="off" disabled readonly>
                                <div class="input-group-append">
                                    <button id="tombolBuatTransaksiBaru" onclick="tombolBuatTransaksiBaru()"
                                        title="Buat transaksi" class="btn btn-info"><i
                                            class="fas fa-plus-square"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tgltransaksi">Tanggal Transaksi</label>
                            <input id="tgltransaksi" disabled readonly class="form-control" type="date"
                                name="tgltransaksi" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-primary">
                        Input Barang
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kdbarang">Kode Barang</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Input Kode Barang"
                                            name="kdbarang" id="kdbarang" autocomplete="off"
                                            onkeydown="ambilDataBarang(event)">
                                        <div class="input-group-append">
                                            <button onclick="tampilModalCariBarang()" class="btn btn-outline-primary"
                                                type="button" id="tombolCariBarang"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="namabarang">Nama Barang</label>
                                    <input id="namabarang" class="form-control" type="text" name="namabarang" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="hargajual">Harga Jual</label>
                                    <input id="hargajual" class="form-control" type="text" name="hargajual" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="hargabeli">Harga Beli</label>
                                    <input id="hargabeli" class="form-control" type="number" name="hargabeli"
                                        autocomplete="off" onkeyup="format_uang(this)">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input id="jumlah" class="form-control" type="number" name="jumlah"
                                        autocomplete="off" min="1">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="">Aksi</label>
                                    <div class="input-group">
                                        <button onclick="tombolTambahItem()" type="button" class="btn btn-sm btn-info"><i
                                                class="fas fa-plus-square" title="Tambah Item"
                                                id="tombolTambahItem"></i></button>&nbsp;
                                        <button onclick="resetFormInput()" type="button" class="btn btn-sm btn-warning"><i
                                                class="fas fa-sync-alt" title="Reload Data" id="tombolReload"></i></button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <x-table class="transaksi">
                                    <x-slot name="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>aksi</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Harga Jual</th>
                                            <th>Harga Beli</th>
                                            <th>Jumlah</th>
                                            <th>Sub. Total</th>
                                        </tr>
                                    </x-slot>
                                </x-table>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <Button class="btn btn-success btn-sm float-right"><i class="fas fa-save"></i> Simpan
                            Transaksi</Button>
                    </div>

                </div>
            </x-card>
        </div>
    </div>
@endsection

@include('includes.datatables')


@push('scripts')
    <script>
        let modal = '#modal-form';
        let button = '#submitBtn';
        let table;

        table = $('.transaksi').DataTable({
            paging: false,
            serverSide: true,
            processing: true,
            autoWidth: false,
            info: false,
            ordering: false,
            searching: false,
            lengthChange: false,
            ajax: {
                url: '{{ route('barangmasuk.ambil_item_barang') }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'aksi',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'kodebarang',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'namabarang',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'hrgajual',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'hrgabeli',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'jumlah',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'subtotal',
                    searchable: false,
                    sortable: false
                },

            ],
        });
    </script>
@endpush

@push('scripts')
    <script>
        function tombolBuatTransaksiBaru() {
            let transaksi = $('#transaksi').val();
            var sudahAdaTransaksi = true; // Ganti dengan logika yang sesuai

            if (transaksi == "") {
                // var numberTransaksi = 'T-' + Math.floor(Math.random() * Date.now());

                var currentDate = new Date();
                var day = String(currentDate.getDate()).padStart(2, '0');
                var month = String(currentDate.getMonth() + 1).padStart(2, '0');
                var year = currentDate.getFullYear();
                var formattedDate = day + '' + month + '' + year;

                var numberTransaksi = 'T-' + formattedDate + '' + Math.floor(Math.random() * 100);



                // Buat transaksi
                $('#transaksi').val(numberTransaksi);

                if (sudahAdaTransaksi) {
                    document.getElementById("tombolBuatTransaksiBaru").disabled = true;

                    // Simpan transaksi ke localStorage
                    localStorage.setItem('transaksi', numberTransaksi);
                }
            } else {
                alert('Transaksi sudah ada!');

                // localStorage.removeItem('transaksi');
            }
        }

        function ambilDataBarang(e) {
            var keyCode = e.keyCode || e.which; // Mendapatkan kode tombol dari event

            if (keyCode === 13) {
                e.preventDefault();
                // Panggil fungsi untuk mengambil data barang

                let kodebarang = $('#kdbarang').val();

                $.ajax({
                    type: "POST",
                    url: '{{ route('barangmasuk.ambil_barang') }}',
                    data: {
                        kodebarang: kodebarang
                    },
                    dataType: "json",
                    success: function(response) {
                        $('#namabarang').val(response.data.name);
                        $('#hargajual').val(format_uang(response.data.harga));
                    },
                    error: function(errors) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Opps! Gagal',
                            text: errors.responseJSON.message,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                });

            }
        }

        function tampilModalCariBarang() {
            alert();
        }

        function tombolTambahItem() {
            let transaksi = $('#transaksi').val();
            let tgltransaksi = $('#tgltransaksi').val();
            let kodebarang = $('#kdbarang').val();
            let namabarang = $('#namabarang').val();
            let hargabeli = $('#hargabeli').val();
            let hargajual = $('#hargajual').val();
            let jumlah = $('#jumlah').val();

            if (transaksi.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Opps! Gagal',
                    text: 'Maaf, transaksi wajib diisi. silahkan tekan tombol tambah untuk membuat transaksi baru',
                    showConfirmButton: false,
                    timer: 3000
                });
            } else if (hargabeli.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Opps! Gagal',
                    text: 'Harga beli wajib diisi.',
                    showConfirmButton: false,
                    timer: 3000
                });
            } else if (kodebarang.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Opps! Gagal',
                    text: 'Kode Barang wajib diisi.',
                    showConfirmButton: false,
                    timer: 3000
                });
                resetFormInput()
            } else if (jumlah.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Opps! Gagal',
                    text: 'Jumlah wajib diisi.',
                    showConfirmButton: false,
                    timer: 3000
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: '{{ route('barangmasuk.store') }}',
                    data: {
                        kodebarang: kodebarang,
                        transaksi: transaksi,
                        tgltransaksi: tgltransaksi,
                        namabarang: namabarang,
                        hargabeli: hargabeli,
                        hargajual: hargajual,
                        jumlah: jumlah

                    },
                    dataType: "json",
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 3000,
                        }).then(() => {
                            resetFormInput();
                            table.ajax.reload();

                        });
                    },
                    error: function(errors) {
                        console.log('err ', errors)
                        Swal.fire({
                            icon: 'error',
                            title: 'Opps! Gagal',
                            text: errors.responseJSON.message,
                            showConfirmButton: true,
                        });
                    }
                });
            }
        }

        function resetFormInput() {
            $('#kdbarang').val('');
            $('#namabarang').val('');
            $('#hargabeli').val('');
            $('#hargajual').val('');
            $('#jumlah').val('');
        }


        function deleteData(url, name) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })
            swalWithBootstrapButtons.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda akan menghapus data ' + name +
                    ' !',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Iya, Hapus!',
                cancelButtonText: 'Batalkan',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(url, {
                            '_method': 'delete'
                        })
                        .done(response => {
                            if (response.status = 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                table.ajax.reload();
                            }
                        })
                        .fail(errors => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Opps! Gagal!',
                                text: errors.responseJSON.message,
                                showConfirmButton: false,
                                timer: 3000
                            })
                            table.ajax.reload();
                        });
                }
            })
        }

        // Cek apakah ada transaksi tersimpan di localStorage saat halaman dimuat
        window.onload = function() {
            var transaksi = localStorage.getItem('transaksi');
            if (transaksi) {
                // Lakukan logika untuk memuat kembali transaksi yang tersimpan
                $('#transaksi').val(transaksi);
                // console.log("Transaksi yang tersimpan: " + transaksi);

                // Menonaktifkan tombol saat halaman dimuat jika ada transaksi tersimpan
                document.getElementById("tombolBuatTransaksiBaru").disabled = true;
            }
        }
    </script>
@endpush
