@extends('layouts.app')

@section('title', 'Kategori')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Kategori</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <span>List Kategori</span>
                    <button onclick="addForm(`{{ route('category.store') }}`)" class="btn btn-sm btn-outline-primary float-right mr-3"><i class="fas fa-plus-circle"></i> Tambah
                        Data</button>
                </x-slot>

                <x-table class="kategori-table">
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
    @includeIf('admin.kategori.form')
@endsection

@include('includes.datatables')
@include('admin.kategori.scripts')
