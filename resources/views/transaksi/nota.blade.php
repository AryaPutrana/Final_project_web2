<!DOCTYPE html>
<html>
<head>
    <title>Nota Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
        }

        .sidebar {
            width: 200px;
            background-color: #343a40;
            padding: 20px 10px;
            height: 100vh;
            color: white;
            box-sizing: border-box;
        }

        .sidebar h2 {
            color: #fff;
            text-align: center;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin: 10px 0;
            padding: 8px;
            border-radius: 4px;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            flex-grow: 1;
            padding: 30px;
        }

        .nota {
            max-width: 600px;
            margin: auto;
            border: 1px solid #000;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .total {
            font-weight: bold;
        }

        .btn-print,
        .btn-kembali,
        .sidebar {
            /* akan disembunyikan saat print */
        }

        /* -------- CETAK HANYA ISI NOTA -------- */
        @media print {
            body * {
                visibility: hidden;
            }

            .nota, .nota * {
                visibility: visible;
            }

            .nota {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                border: none;
                padding: 0;
            }

            .btn-print,
            .btn-kembali,
            .sidebar {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Menu</h2>
        <a href="{{ url('/') }}">🏠 Dashboard</a>
        <a href="{{ route('barang.index') }}">📦 Barang</a>
        <a href="{{ route('transaksi.index') }}">💰 Transaksi</a>
    </div>

    <div class="content">
        <div class="nota">
            <h2>Nota Transaksi</h2>
            <p><strong>Nama Pembeli:</strong> {{ $transaksi->nama_pembeli }}</p>
            <p><strong>Tanggal:</strong> {{ $transaksi->created_at->format('d-m-Y H:i') }}</p>

            <table>
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi->details as $detail)
                        <tr>
                            <td>{{ $detail->barang->nama ?? 'Barang telah dihapus' }}</td>
                            <td>Rp{{ number_format($detail->barang->harga ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td>Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="total">
                        <td colspan="3">Total Harga</td>
                        <td>Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="btn-print">
                <button onclick="window.print()">🖨️ Cetak Nota</button>
            </div>

            <div class="btn-kembali">
                <a href="{{ route('transaksi.index') }}">← Kembali ke Riwayat</a>
            </div>
        </div>
    </div>

</body>
</html>
