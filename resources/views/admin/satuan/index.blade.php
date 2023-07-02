@extends('layouts.app')

@section('title', 'Satuan Barang')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Satuan Barang</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <span>List Satuan Barang</span>
                    <button onclick="addForm(`{{ route('satuan.store') }}`)" class="btn btn-sm btn-outline-primary float-right mr-3"><i class="fas fa-plus-circle"></i> Tambah
                        Data</button>
                </x-slot>

                <x-table class="kategori-table">
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
    @includeIf('admin.satuan.form')
@endsection

@include('includes.datatables')
@include('admin.satuan.scripts')
