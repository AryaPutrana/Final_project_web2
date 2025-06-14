<!-- resources/views/barang/create.blade.php -->
@extends('layouts.main')

@section('title', 'Tambah Barang')

@section('content')
    <h1>Tambah Barang</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        <label for="nama">Nama Barang:</label><br>
        <input type="text" name="nama" required><br><br>

        <label for="stok">Stok:</label><br>
        <input type="number" name="stok" required><br><br>

        <label for="harga">Harga:</label><br>
        <input type="number" name="harga" required><br><br>

        <button type="submit" class="btn btn-green">Simpan</button>
        <a href="{{ route('barang.index') }}" class="btn btn-orange">Kembali</a>
    </form>
@endsection
