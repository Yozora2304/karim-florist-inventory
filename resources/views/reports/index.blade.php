<!DOCTYPE html>
<html>
<head>
    <title>Laporan Bulanan</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{
            display:flex;
            background:#0d0d0d;
            color:white;
        }

        .sidebar{
            width:250px;
            height:100vh;
            background:#111;
            padding:30px;
            border-right:2px solid #ff69b4;
            box-shadow:0 0 15px #ff69b4;
        }

        .sidebar h2{
            color:#ff69b4;
            text-align:center;
            margin-bottom:40px;
        }

        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            margin-bottom:20px;
            padding:12px;
            border-radius:8px;
            transition:all 0.3s ease;
        }

        .sidebar a:hover{
            background:#ff69b4;
            color:white;
            transform:translateX(5px);
            box-shadow:0 0 15px #ff69b4;
        }

        .sidebar a.active{
            border-left:4px solid #ff69b4;
            color:#ff69b4;
            background:#1a1a1a;
            box-shadow:0 0 15px #ff69b4;
        }

        .main{
            flex:1;
            padding:30px;
        }

        .title{
            font-size:30px;
            color:#ff69b4;
            margin-bottom:25px;
        }

        .filter-box{
            background:#111;
            border:1px solid #ff69b4;
            box-shadow:0 0 15px #ff69b4;
            padding:20px;
            border-radius:15px;
            margin-bottom:25px;
        }

        input, select{
            padding:12px;
            background:black;
            border:1px solid #ff69b4;
            color:white;
            border-radius:8px;
            margin-right:10px;
        }

        button, .btn{
            background:#ff69b4;
            color:white;
            padding:12px 18px;
            border:none;
            border-radius:8px;
            cursor:pointer;
            text-decoration:none;
        }

        .cards{
            display:flex;
            gap:20px;
            flex-wrap:wrap;
            margin-bottom:25px;
        }

        .card{
            background:#111;
            width:250px;
            padding:20px;
            border-radius:15px;
            border:1px solid #ff69b4;
            box-shadow:0 0 15px #ff69b4;
        }

        .card h3{
            color:#ff69b4;
            margin-bottom:10px;
        }

        .card p{
            font-size:24px;
            font-weight:bold;
        }

        table{
            width:100%;
            border-collapse:collapse;
            background:#111;
            border-radius:15px;
            overflow:hidden;
            margin-bottom:30px;
        }

        th{
            background:#ff69b4;
            padding:15px;
        }

        td{
            padding:15px;
            text-align:center;
            border-bottom:1px solid #333;
        }

        tr:hover{
            background:#1a1a1a;
        }

        .section-title{
            color:#ff69b4;
            margin:25px 0 15px;
        }

        @media print{

        .sidebar{
            display:none;
        }

        .filter-box{
            display:none;
        }

        body{
            background:white;
            color:black;
        }

        .main{
            width:100%;
            padding:0;
        }

        table{
            border:1px solid black;
            color:black;
        }

        th{
            background:#ddd !important;
            color:black;
        }

    }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2>TOKO BUNGA KARIM</h2>

        <a href="/dashboard">Beranda</a>
        <a href="/products">Produk</a>
        <a href="/incoming-items/create">Barang Masuk</a>
        <a href="/incoming-items">Riwayat Masuk</a>
        <a href="/outgoing-items/create">Barang Keluar</a>
        <a href="/outgoing-items">Riwayat Keluar</a>
        <a href="/reports" class="active">Laporan</a>
        @if(session('role') == 'superadmin')
            <a href="/admins">Kelola Admin</a>
        @endif
        <a href="/logout">Keluar</a>
    </div>

    <div class="main">

        <div class="title">
            Laporan Bulanan Inventory
        </div>

        <div class="filter-box">
            <form action="/reports" method="GET">
                <input type="month" name="month" value="{{ $month }}" required>

                <select name="product_id">
                    <option value="">Semua Produk</option>

                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $productId == $product->id ? 'selected' : '' }}>
                            {{ $product->code }} - {{ $product->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit">Tampilkan Laporan</button>

                <a href="/reports" class="btn">Reset</a>

                <button
                    type="button"
                    class="btn"
                    onclick="window.print()"
                >   
                    Cetak PDF
                </button>
            </form>
        </div>

        @if(!$month)

            <div class="card" style="width:100%;">
                <h3>Pilih bulan terlebih dahulu</h3>
                <p style="font-size:16px; font-weight:normal;">
                    Silakan pilih bulan dan produk untuk menampilkan laporan transaksi barang masuk dan keluar.
                </p>
            </div>

        @else

        <div class="cards">
            <div class="card">
                <h3>Total Barang Masuk</h3>
                <p>{{ $totalIncoming }}</p>
            </div>

            <div class="card">
                <h3>Total Barang Keluar</h3>
                <p>{{ $totalOutgoing }}</p>
            </div>

            <div class="card">
                <h3>Paling Banyak Keluar</h3>
                <p>
                    @if($mostOutgoing)
                        {{ $mostOutgoing['name'] }} ({{ $mostOutgoing['total'] }})
                    @else
                        -
                    @endif
                </p>
            </div>
        </div>

        <h2 class="section-title">Riwayat Barang Masuk</h2>

        <table>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Produk</th>
                <th>Jumlah Masuk</th>
                <th>Tanggal</th>
            </tr>

            @forelse($incomingItems as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->code }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Data barang masuk tidak ditemukan.</td>
                </tr>
            @endforelse
        </table>

        <h2 class="section-title">Riwayat Barang Keluar</h2>

        <table>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Produk</th>
                <th>Jumlah Keluar</th>
                <th>Tanggal</th>
            </tr>

            @forelse($outgoingItems as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->code }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Data barang keluar tidak ditemukan.</td>
                </tr>
            @endforelse
        </table>
        @endif
    </div>

</body>
</html>