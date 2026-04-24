<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;


class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('details.barang')->get();

        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('transaksi.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:barangs,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
        ]);
    
        $total = 0;
        $details = [];
    
        foreach ($request->barang_id as $index => $barangId) {
            $barang = Barang::findOrFail($barangId);
            $jumlah = $request->jumlah[$index];
    
            if ($barang->stok < $jumlah) {
                return back()->withErrors(['Stok barang ' . $barang->nama . ' tidak mencukupi.'])->withInput();
            }
    
            $subtotal = $barang->harga * $jumlah;
            $total += $subtotal;
    
            $details[] = [
                'barang' => $barang,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal
            ];
        }
    
        // Untuk Simpan transaksi utama
        $transaksi = Transaksi::create([
            'nama_pembeli' => $request->nama_pembeli,
            'total_harga' => $total
        ]);
    
        // Untuk Simpan detail transaksi
        foreach ($details as $item) {
            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'barang_id' => $item['barang']->id,
                'jumlah' => $item['jumlah'],
                'subtotal' => $item['subtotal']
            ]);
    
            // Untuk Kurangi stok barang
            $item['barang']->stok -= $item['jumlah'];
            $item['barang']->save();
        }
    
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    
    public function nota($id)

    {
    $transaksi = Transaksi::with('details.barang')->findOrFail($id);
    return view('transaksi.nota', compact('transaksi'));
    }

}

