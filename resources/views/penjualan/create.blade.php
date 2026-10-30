
@extends('layouts.app')

@section('title', 'Tambah Penjualan')

@section('content')

<h2>Tambah Transaksi Penjualan</h2>

<form action="{{ route('penjualan.store') }}" method="POST">
    @csrf

    @include('penjualan._form', [
        'data' => null,
        'tombol' => 'Simpan Transaksi'
    ])
</form>

@endsection
