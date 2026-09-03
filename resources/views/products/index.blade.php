<!DOCTYPE html>
<html>
<head>
    <title>Products</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: Arial;
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

        .top-bar{
            display:flex;
            justify-content:space-between;
            margin-bottom:20px;
        }

        .btn{
            background:#ff69b4;
            color:white;
            padding:12px 18px;
            border:none;
            border-radius:8px;
            cursor:pointer;
            text-decoration:none;
            transition:0.3s;
        }

        .btn:hover{
            box-shadow:0 0 15px #ff69b4;
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

        .pagination{
            margin-top:20px;
        }

        .pagination nav{
            display:flex;
            justify-content:center;
        }

        .pagination svg{
            width:18px;
            height:18px;
        }

        .pagination span,
        .pagination a{
            color:white;
            padding:8px 12px;
            margin:0 4px;
            text-decoration:none;
            border-radius:6px;
            background:#111;
            border:1px solid #ff69b4;
            font-size:14px;
        }

        .pagination a:hover{
            background:#ff69b4;
        }

        .edit{
            background:#ff69b4;
            color:white;
        }

        .delete{
            background:red;
            color:white;
        }

    </style>

</head>

<body>

    <div class="sidebar">

        <h2>TOKO BUNGA KARIM</h2>

        <a href="/dashboard">Beranda</a>

        <a href="/products" class="active">Produk</a>

        <a href="/incoming-items/create">Barang Masuk</a>

        <a href="/incoming-items">Riwayat Masuk</a>

        <a href="/outgoing-items/create">Barang Keluar</a>

        <a href="/outgoing-items">Riwayat Keluar</a>

        <a href="/reports">Laporan</a>

        @if(session('role') == 'superadmin')
            <a href="/admins">Kelola Admin</a>
        @endif
        
        <a href="/logout">Keluar</a>

    </div>

    <div class="main">

        <div class="title">
            Penyimpanan
        </div>

        <form action="/products" method="GET" style="margin-bottom:20px;">

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
                class="btn"
            >
                Cari
            </button>

        </form>

        <div class="top-bar">

            <a href="/products/create" class="btn">
                + Tambah Produk
            </a>

        </div>

        <table>

            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Stock</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            @foreach($products as $product)
            
            <tr>
                <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>

                <td>{{ $product->code }}</td>

                <td>{{ $product->name }}</td>
                
                <td>{{ $product->type }}</td>
                
                <td>{{ $product->stock }}</td>
                
                <td>{{ $product->price }}</td>
                
                <td>{{ $product->status }}</td>
                
                <td>
                    <a href="/products/{{ $product->id }}/edit">
                        
                        <button class="action-btn edit">
                            Edit
                        </button>
                    </a>

                <form action="/products/{{ $product->id }}" method="POST" style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="action-btn delete">
                        Delete
                    </button>

                </form>

                </td>

            </tr>

            @endforeach

                    </table>

        <div class="pagination">

            {{ $products->links() }}

        </div>

    </div>

</body>
</html>