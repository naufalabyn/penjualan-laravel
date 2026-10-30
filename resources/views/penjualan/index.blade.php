@extends('layouts.app')

@section('title', 'Data Penjualan')

@section('content')

<div class="card">
    <h2>Dashboard Penjualan</h2>
    <p>Kelola seluruh transaksi penjualan di sini.</p>

    <h3>Total Omzet Transaksi Selesai</h3>
    <h2 style="color: #2563eb">
        Rp {{ number_format($totalOmzet, 0, ',', '.') }}
    </h2>

    <a href="{{ route('penjualan.create') }}" class="btn primary">
        + Tambah Penjualan
    </a>
</div>
<form method="GET" action="{{ route('penjualan.index') }}" class="actions" style="margin-bottom: 14px;">
    <input name="search" value="{{ request('search') }}" placeholder="Cari kode, pelanggan, produk">
    <select name="status">
        <option value="">Semua status</option>
        @foreach (['Selesai', 'Pending', 'Batal'] as $s)
            <option value="{{ $s }}" @selected(request('status') === $s)>{{ $s }}</option>
        @endforeach
    </select>
    <button class="btn btn-primary" type="submit">Terapkan</button>
</form>
<div class="card">
    <h2>Daftar Transaksi</h2>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Produk</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($penjualan as $item)
                <tr>
                    <td>{{ $item->kode_transaksi }}</td>
                    <td>{{ $item->tanggal->format('d-m-Y') }}</td>
                    <td>{{ $item->nama_pelanggan }}</td>
                    <td>{{ $item->nama_produk }}</td>
                    <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('penjualan.show', $item->id) }}"
                               class="btn secondary">Detail</a>

                            <a href="{{ route('penjualan.edit', $item->id) }}"
                               class="btn primary">Edit</a>

                            <form action="{{ route('penjualan.destroy', $item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn danger">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada data penjualan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
