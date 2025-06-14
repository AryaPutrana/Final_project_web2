@extends('layouts.main')

@section('title', 'Daftar Barang')

@section('content')
    <h1>Daftar Barang</h1>

    <a href="{{ route('barang.create') }}"
       class="btn btn-green"
       style="margin-bottom: 15px; display: inline-block;">
       + Tambah Barang
    </a>

    <table>
        <tr>
            <th>Nama</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        @foreach($barangs as $barang)
        <tr>
            <td>{{ $barang->nama }}</td>
            <td style="color: {{ $barang->stok < 5 ? 'red' : 'black' }}; font-weight: {{ $barang->stok < 5 ? 'bold' : 'normal' }};">
                {{ $barang->stok }}
                @if($barang->stok < 5)
                    ⚠️
                @endif
            </td>
            <td>Rp{{ number_format($barang->harga, 0, ',', '.') }}</td>
            <td>
                <a href="{{ route('barang.edit', $barang->id) }}"
                   class="btn btn-orange">Edit</a>

                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn btn-red"
                            style="border: none;">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
