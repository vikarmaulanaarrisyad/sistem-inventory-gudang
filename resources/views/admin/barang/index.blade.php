@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Barang</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <span>List Data Barang</span>
                    <button onclick="addForm(`{{ route('barang.store') }}`)" class="btn btn-sm btn-outline-primary float-right mr-3"><i class="fas fa-plus-circle"></i> Tambah
                        Data</button>
                </x-slot>

                <x-table class="barang-table">
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Barang</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
    @includeIf('admin.barang.form')
    @includeIf('admin.barang.detail')
@endsection

@include('includes.select2')
@include('includes.datatables')
@include('admin.barang.scripts')
