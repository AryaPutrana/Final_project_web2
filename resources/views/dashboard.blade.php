<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 200px;
            background-color: #2c3e50;
            height: 100vh;
            padding-top: 20px;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 15px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        /* Content */
        .main-content {
            margin-left: 200px;
            padding: 20px;
            width: 100%;
        }

        h1 {
            color: #333;
        }

        .card {
            background-color: #f5f5f5;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <div class="sidebar">
        <a href="{{ url('/') }}">🏠 Dashboard</a>
        <a href="{{ route('barang.index') }}">📦 Barang</a>
        <a href="{{ route('transaksi.index') }}">🧾 Transaksi</a>
        <form action="{{ route('logout') }}" method="POST" style="margin-top: 10px;">
            @csrf
            <button type="submit" style="background: none; border: none; color: white; padding: 15px 20px; text-align: left; cursor: pointer;">
                🚪 Logout
            </button>
        </form>
    </div>

    <div class="main-content">
        <h1>Selamat Datang di Dashboard</h1>

        <div class="card">
            <h3>Total Barang: {{ \App\Models\Barang::count() }}</h3>
        </div>

        <div class="card">
            <h3>Total Transaksi: {{ \App\Models\Transaksi::count() }}</h3>
        </div>

        <div class="card">
            <h3>Stok Barang Tersedia:</h3>
            <ul>
                @foreach(\App\Models\Barang::all() as $barang)
                    <li>{{ $barang->nama }} - Stok: {{ $barang->stok }}</li>
                @endforeach
            </ul>
        </div>

        <div class="card">
            <h3>Grafik Penjualan Harian:</h3>
            <canvas id="penjualanChart" width="600" height="300"></canvas>
        </div>
    </div>

    <script>
        const labels = {!! json_encode($penjualanHarian->pluck('tanggal')) !!};
        const data = {!! json_encode($penjualanHarian->pluck('total')) !!};

        const ctx = document.getElementById('penjualanChart').getContext('2d');
        const penjualanChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Penjualan',
                    data: data,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>
</html>
