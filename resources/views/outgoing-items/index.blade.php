<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Barang Keluar</title>

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
            margin-bottom:30px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            background:#111;
            border-radius:15px;
            overflow:hidden;
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

        <a href="/outgoing-items" class="active">Riwayat Keluar</a>

        <a href="/reports">Laporan</a>

        @if(session('role') == 'superadmin')
            <a href="/admins">Kelola Admin</a>
        @endif

        <a href="/logout">Keluar</a>

    </div>

    <div class="main">

        <div class="title">
            Riwayat Barang Keluar
        </div>

        <form action="/outgoing-items" method="GET" style="margin-bottom:20px;">

            <input
                type="text"
                name="search"
                placeholder="Cari Produk..."
                style="
                    width:300px;
                    padding:12px;
                    background:#111;
                    border:1px solid #ff69b4;
                    color:white;
                    border-radius:8px;
                "
            >

            <button
                type="submit"
                style="
                    padding:12px 20px;
                    background:#ff69b4;
                    border:none;
                    color:white;
                    border-radius:8px;
                    cursor:pointer;
                "
            >
                Cari
            </button>

        </form>

        <table>

            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>

            @foreach($outgoingItems as $item)

            <tr>

                <td>{{ $item->product->name }}</td>

                <td>{{ $item->quantity }}</td>

                <td>{{ $item->date }}</td>

            </tr>

            @endforeach

        </table>

    </div>

</body>
</html>