@push('scripts')
    <script>
        let modal = '#modal-form';
        let modalDetail = '#modalDetail';
        let button = '#submitBtn';
        let table;

        table = $('.barang-table').DataTable({
            serverSide: true,
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('barang.data') }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'code'
                },
                {
                    data: 'name'
                },
                {
                    data: 'harga'
                },
                {
                    data: 'kategori'
                },
                {
                    data: 'satuan'
                },
                {
                    data: 'stock'
                },
                {
                    data: 'aksi',
                    searchable: false,
                    sortable: false
                },
            ],
        });

        function addForm(url, title = "Form Tambah Data Barang") {
            $(modal).modal('show');
            $(`${modal} .modal-title`).text(title);
            $(`${modal} form`).attr('action', url);
            $(`${modal} [name=_method]`).val('POST');
            $('#spinner-border').hide();
            $(button).prop('disabled', false);
            resetForm(`${modal} form`);
        }

        function editForm(url, title = 'Form Edit Data Barang') {
            $.get(url)
                .done(response => {
                    $(modal).modal('show');
                    $(`${modal} .modal-title`).text(title);
                    $(`${modal} form`).attr('action', url);
                    $(`${modal} [name=_method]`).val('PUT');
                    $('#spinner-border').hide();
                    $(button).prop('disabled', false);
                    resetForm(`${modal} form`);
                    loopForm(response.data);

                    var categories = new Option(response.data.category.name, response.data.category.id, true, true);
                    var satuan = new Option(response.data.satuan.name, response.data.satuan.id, true, true);

                    $('#categories').append(categories).trigger('change');
                    $('#satuan').append(satuan).trigger('change');
                    $('#harga_jual').val(format_uang(response.data.harga_jual));
                    $('#harga_beli').val(format_uang(response.data.harga_beli));

                })
                .fail(errors => {
                    Swall.fire({
                        icon: 'error',
                        title: 'Opps! Gagal',
                        text: errors.responseJSON.message,
                        showConfirmButton: true,
                    });
                    $('#spinner-border').hide();
                    $(button).prop('disabled', false);
                });
        }

        function detailForm(url, title = 'Detail Barang') {
            $.get(url)
                .done(response => {
                    $(modalDetail).modal('show');
                    $(`${modalDetail} .modal-title`).text(title);

                    $(`${modalDetail} .modal-body #kodeBarang`).text(response.data.code)
                    $(`${modalDetail} .modal-body #namaBarang`).text(response.data.name)
                    $(`${modalDetail} .modal-body #kategoriBarang`).text(response.data.category.name)
                    $(`${modalDetail} .modal-body #satuanBarang`).text(response.data.satuan.name)
                    $(`${modalDetail} .modal-body #hargaBeliBarang`).text(format_uang(response.data.harga_beli))
                    $(`${modalDetail} .modal-body #hargaJualBarang`).text(format_uang(response.data.harga_jual))
                    $(`${modalDetail} .modal-body #stokBarang`).text(response.data.stock)
                });
        }

        function submitForm(originalForm) {
            $(button).prop('disabled', true);
            $('#spinner-border').show();
            $.post({
                    url: $(originalForm).attr('action'),
                    data: new FormData(originalForm),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false
                })
                .done(response => {
                    $(modal).modal('hide');
                    if (response.status = 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 3000
                        })
                    }
                    $(button).prop('disabled', false);
                    $('#spinner-border').hide();
                    table.ajax.reload();
                })
                .fail(errors => {
                    $('#spinner-border').hide();
                    $(button).prop('disabled', false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Opps! Gagal',
                        text: errors.responseJSON.message,
                        showConfirmButton: true,
                    });
                    if (errors.status == 422) {
                        $('#spinner-border').hide()
                        $(button).prop('disabled', false);
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }
                });
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

        function formatUang(angka) {
            return angka.toLocaleString('id-ID');
        }

        $('#categories').select2({
            placeholder: 'Pilih kategori',
            ajax: {
                url: '{{ route('ajax.category_search') }}',
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        })
                    }
                }
            }
        });

        $('#satuan').select2({
            placeholder: 'Pilih satuan',
            ajax: {
                url: '{{ route('ajax.satuan_search') }}',
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        })
                    }
                }
            }
        });
    </script>
@endpush
