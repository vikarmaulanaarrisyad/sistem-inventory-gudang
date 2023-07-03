@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Barang Masuk</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <span>List Data Barang Masuk</span>
                </x-slot>


            </x-card>
        </div>
    </div>
    @includeIf('admin.kategori.form')
@endsection

@include('includes.datatables')
@include('admin.kategori.scripts')
