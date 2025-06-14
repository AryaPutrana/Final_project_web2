<!-- resources/views/layouts/main.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Dashboard')</title>
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
            width: calc(100% - 200px);
        }

        h1 {
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
        }

        .btn-green { background-color: green; }
        .btn-orange { background-color: orange; }
        .btn-red { background-color: red; }
    </style>
</head>
<body>

    <div class="sidebar">
        <a href="{{ url('/') }}">🏠 Dashboard</a>
        <a href="{{ route('barang.index') }}">📦 Barang</a>
        <a href="{{ route('transaksi.index') }}">🧾 Transaksi</a>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

</body>
</html>
