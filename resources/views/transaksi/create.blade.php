@extends('layouts.main')

@section('title', 'Transaksi Penjualan')

@section('content')
    <h1>Transaksi Penjualan</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transaksi.store') }}" method="POST" style="max-width: 500px;">
        @csrf

        <div style="margin-bottom: 10px;">
            <label for="nama_pembeli">Nama Pembeli:</label><br>
            <input type="text" name="nama_pembeli" value="{{ old('nama_pembeli') }}" required style="width: 100%;">
        </div>

        <div id="barang-container">
            <div class="barang-group" style="margin-bottom: 10px; border: 1px solid #ccc; padding: 10px; position: relative;">
                <label>Pilih Barang:</label><br>
                <select name="barang_id[]" required style="width: 100%;">
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">
                            {{ $barang->nama }} - Stok: {{ $barang->stok }} - Rp{{ number_format($barang->harga, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>

                <label>Jumlah Beli:</label><br>
                <input type="number" name="jumlah[]" min="1" required style="width: 100%;">

                <button type="button" class="btn-hapus" onclick="hapusBarang(this)" style="margin-top: 10px; background-color: red; color: white; border: none; padding: 5px 10px;">
                    ❌ Hapus
                </button>
            </div>
        </div>

        <button type="button" onclick="tambahBarang()" style="margin-bottom: 10px;">➕ Tambah Barang</button><br>

        <button type="submit" class="btn btn-green">💾 Simpan Transaksi</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-orange">📋 Lihat Riwayat</a>
    </form>

    <script>
        function tambahBarang() {
            const container = document.getElementById('barang-container');
            const group = container.querySelector('.barang-group');
            const clone = group.cloneNode(true);

            // Reset semua input pada clone
            clone.querySelectorAll('select, input').forEach(el => el.value = '');

            container.appendChild(clone);
        }

        function hapusBarang(button) {
            const container = document.getElementById('barang-container');
            if (container.querySelectorAll('.barang-group').length > 1) {
                button.parentElement.remove();
            } else {
                alert('Minimal satu barang harus dipilih.');
            }
        }
    </script>
@endsection
