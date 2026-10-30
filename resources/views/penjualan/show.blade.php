
@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

<div class="card">
    <h2>Detail Transaksi</h2>

    <p><strong>Kode Transaksi:</strong> {{ $penjualan->kode_transaksi }}</p>
    <p><strong>Tanggal:</strong> {{ $penjualan->tanggal->format('d-m-Y') }}</p>
    <p><strong>Pelanggan:</strong> {{ $penjualan->nama_pelanggan }}</p>
    <p><strong>Produk:</strong> {{ $penjualan->nama_produk }}</p>
    <p><strong>Jumlah:</strong> {{ $penjualan->jumlah }}</p>

    <p><strong>Harga Satuan:</strong>
        Rp {{ number_format($penjualan->harga_satuan, 0, ',', '.') }}
    </p>

    <p><strong>Total:</strong>
        Rp {{ number_format($penjualan->total, 0, ',', '.') }}
    </p>

    <p><strong>Status:</strong> {{ $penjualan->status }}</p>
    <p><strong>Catatan:</strong> {{ $penjualan->catatan ?? '-' }}</p>

    <a href="{{ route('penjualan.index') }}" class="btn secondary">
        Kembali
    </a>

    <a href="{{ route('penjualan.edit', $penjualan->id) }}" class="btn primary">
        Edit Transaksi
    </a>
</div>

@endsection