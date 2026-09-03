<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>

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

        form{
            width:450px;
            background:#111;
            padding:25px;
            border-radius:15px;
            border:1px solid #ff69b4;
            box-shadow:0 0 15px #ff69b4;
        }

        input{
            width:100%;
            padding:12px;
            margin-bottom:15px;
            background:black;
            border:1px solid #ff69b4;
            color:white;
            border-radius:8px;
        }

        input:focus{
            outline:none;
            box-shadow:0 0 10px #ff69b4;
        }

        button{
            width:100%;
            padding:12px;
            background:#ff69b4;
            border:none;
            color:white;
            border-radius:8px;
            cursor:pointer;
            transition:0.3s;
        }

        button:hover{
            box-shadow:0 0 15px #ff69b4;
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
            Edit Produk
        </div>

        <form action="/products/{{ $product->id }}" method="POST">

            @csrf
            @method('PUT')

            <input
                type="text"
                name="name"
                value="{{ $product->name }}"
            >

            <input
                type="text"
                name="type"
                value="{{ $product->type }}"
            >

            <input
                type="number"
                name="stock"
                value="{{ $product->stock }}"
            >

            <input
                type="number"
                name="price"
                value="{{ $product->price }}"
            >

            <input
                type="text"
                name="status"
                value="{{ $product->status }}"
            >

            <button type="submit">
                Update Produk
            </button>

        </form>

    </div>

</body>
</html>