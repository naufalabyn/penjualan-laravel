
<div class="card">
    <label>Kode Transaksi</label>
    <input type="text" name="kode_transaksi"
        value="{{ old('kode_transaksi', $data->kode_transaksi ?? '') }}"
        placeholder="Contoh: TRX-001">
    @error('kode_transaksi')
        <div class="error">{{ $message }}</div>
    @enderror

    <label>Tanggal</label>
    <input type="date" name="tanggal"
        value="{{ old('tanggal', isset($data) ? $data->tanggal->format('Y-m-d') : date('Y-m-d')) }}">
    @error('tanggal')
        <div class="error">{{ $message }}</div>
    @enderror

    <label>Nama Pelanggan</label>
    <input type="text" name="nama_pelanggan"
        value="{{ old('nama_pelanggan', $data->nama_pelanggan ?? '') }}">
    @error('nama_pelanggan')
        <div class="error">{{ $message }}</div>
    @enderror

    <label>Nama Produk</label>
    <input type="text" name="nama_produk"
        value="{{ old('nama_produk', $data->nama_produk ?? '') }}">
    @error('nama_produk')
        <div class="error">{{ $message }}</div>
    @enderror

    <label>Jumlah</label>
    <input type="number" name="jumlah" min="1"
        value="{{ old('jumlah', $data->jumlah ?? 1) }}">
    @error('jumlah')
        <div class="error">{{ $message }}</div>
    @enderror

    <label>Harga Satuan (Rp)</label>
    <input type="number" name="harga_satuan" min="0" step="0.01"
        value="{{ old('harga_satuan', $data->harga_satuan ?? '') }}">
    @error('harga_satuan')
        <div class="error">{{ $message }}</div>
    @enderror

    <label>Status</label>
    <select name="status">
        @foreach(['Selesai', 'Pending', 'Batal'] as $status)
            <option value="{{ $status }}"
                @selected(old('status', $data->status ?? 'Selesai') == $status)>
                {{ $status }}
            </option>
        @endforeach
    </select>
    @error('status')
        <div class="error">{{ $message }}</div>
    @enderror

    <label>Catatan</label>
    <textarea name="catatan" rows="3">{{ old('catatan', $data->catatan ?? '') }}</textarea>
    @error('catatan')
        <div class="error">{{ $message }}</div>
    @enderror

    <button type="submit" class="btn primary">
        {{ $tombol }}
    </button>

    <a href="{{ route('penjualan.index') }}" class="btn secondary">
        Kembali
    </a>
</div>
