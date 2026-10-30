<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PenjualanController extends Controller
{
    // Menampilkan seluruh data penjualan
    public function index(Request $request)
{
    $query = Penjualan::query();
 
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('kode_transaksi', 'like', "%{$search}%")
              ->orWhere('nama_pelanggan', 'like', "%{$search}%")
              ->orWhere('nama_produk', 'like', "%{$search}%");
        });
    }
 
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }
 
    $penjualan = $query->orderByDesc('tanggal')->orderByDesc('id')->get();
    $totalOmzet = Penjualan::where('status', 'Selesai')->sum('total');
 
    return view('penjualan.index', compact('penjualan', 'totalOmzet'));
}

    // Menampilkan formulir tambah data
    public function create()
    {
        return view('penjualan.create');
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_transaksi' => [
                'required', 'string', 'max:30',
                'unique:penjualan,kode_transaksi'
            ],
            'tanggal' => ['required', 'date'],
            'nama_pelanggan' => ['required', 'string', 'max:100'],
            'nama_produk' => ['required', 'string', 'max:120'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'harga_satuan' => ['required', 'numeric', 'min:0'],
            'status' => [
                'required',
                Rule::in(['Selesai', 'Pending', 'Batal'])
            ],
            'catatan' => ['nullable', 'string', 'max:1000'],
        ]);

        $validated['total'] =
            $validated['jumlah'] * $validated['harga_satuan'];

        Penjualan::create($validated);

        return redirect()->route('penjualan.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // Menampilkan detail transaksi
    public function show(Penjualan $penjualan)
    {
        return view('penjualan.show', compact('penjualan'));
    }

    // Menampilkan formulir edit
    public function edit(Penjualan $penjualan)
    {
        return view('penjualan.edit', compact('penjualan'));
    }

    // Memperbarui transaksi
    public function update(Request $request, Penjualan $penjualan)
    {
        $validated = $request->validate([
            'kode_transaksi' => [
                'required', 'string', 'max:30',
                Rule::unique('penjualan', 'kode_transaksi')
                    ->ignore($penjualan->id),
            ],
            'tanggal' => ['required', 'date'],
            'nama_pelanggan' => ['required', 'string', 'max:100'],
            'nama_produk' => ['required', 'string', 'max:120'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'harga_satuan' => ['required', 'numeric', 'min:0'],
            'status' => [
                'required',
                Rule::in(['Selesai', 'Pending', 'Batal'])
            ],
            'catatan' => ['nullable', 'string', 'max:1000'],
        ]);

        $validated['total'] =
            $validated['jumlah'] * $validated['harga_satuan'];

        $penjualan->update($validated);

        return redirect()->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    // Menghapus transaksi
    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();

        return redirect()->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}