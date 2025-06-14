<!-- resources/views/barang/edit.blade.php -->
@extends('layouts.main')

@section('title', 'Edit Barang')

@section('content')
    <h1>Edit Barang</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nama">Nama Barang:</label><br>
        <input type="text" name="nama" value="{{ $barang->nama }}" required><br><br>

        <label for="stok">Stok:</label><br>
        <input type="number" name="stok" value="{{ $barang->stok }}" required><br><br>

        <label for="harga">Harga:</label><br>
        <input type="number" name="harga" value="{{ $barang->harga }}" required><br><br>

        <button type="submit" class="btn btn-green">Update</button>
        <a href="{{ route('barang.index') }}" class="btn btn-orange">Kembali</a>
    </form>
@endsection
