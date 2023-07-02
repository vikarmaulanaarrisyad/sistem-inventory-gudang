@extends('layouts.app')

@section('title', 'Supplier')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Supplier</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <span>List Supplier</span>
                    <button onclick="addForm(`{{ route('supplier.store') }}`)" class="btn btn-sm btn-outline-primary float-right mr-3"><i class="fas fa-plus-circle"></i> Tambah
                        Data</button>
                </x-slot>

                <x-table class="kategori-table">
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>Email Supplier</th>
                            <th>Nomor Hp Supplier</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
    @includeIf('admin.supplier.form')
@endsection

@include('includes.datatables')
@include('admin.supplier.scripts')
