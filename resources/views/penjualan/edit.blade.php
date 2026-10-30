
@extends('layouts.app')

@section('title', 'Edit Penjualan')

@section('content')

<h2>Edit Transaksi Penjualan</h2>

<form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
    @csrf
    @method('PUT')

    @include('penjualan._form', [
        'data' => $penjualan,
        'tombol' => 'Perbarui Transaksi'
    ])
</form>

@endsection
