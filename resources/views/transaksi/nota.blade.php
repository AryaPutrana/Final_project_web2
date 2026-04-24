@extends('layouts.main')

@section('title', 'Riwayat Transaksi')

@section('content')
    <h1>Riwayat Transaksi</h1>

    <!-- Tombol Tambah Transaksi & Kembali ke Dashboard -->
    <div style="margin-bottom: 15px;">
        <a href="{{ route('transaksi.create') }}" class="btn btn-green">
            🛒 + Tambah Transaksi
        </a>

        <a href="{{ url('/') }}" class="btn btn-orange">
            🏠 Kembali ke Dashboard
        </a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Pembeli</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        @foreach($transaksis as $index => $transaksi)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $transaksi->nama_pembeli }}</td>

            <!-- ✅ Barang -->
            <td>
                <ul>
                    @foreach ($transaksi->details as $detail)
                        <li>{{ $detail->barang->nama ?? 'Barang telah dihapus' }}</li>
                    @endforeach
                </ul>
            </td>

            <!-- ✅ Jumlah -->
            <td>
                <ul>
                    @foreach ($transaksi->details as $detail)
                        <li>{{ $detail->jumlah }}</li>
                    @endforeach
                </ul>
            </td>

            <td>Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
            <td>{{ $transaksi->created_at->format('d-m-Y H:i') }}</td>
            <td>
                <a href="{{ route('transaksi.nota', $transaksi->id) }}" class="btn btn-orange">
                    🧾 Cetak Nota
                </a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
