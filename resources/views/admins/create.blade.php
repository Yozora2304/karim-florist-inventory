<!DOCTYPE html>
<html>
<head>
    <title>Tambah Admin</title>

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
            width:500px;
            background:#111;
            padding:25px;
            border-radius:15px;
            border:1px solid #ff69b4;
            box-shadow:0 0 15px #ff69b4;
        }

        input, select{
            width:100%;
            padding:12px;
            margin-bottom:15px;
            background:black;
            border:1px solid #ff69b4;
            color:white;
            border-radius:8px;
        }

        input:focus,
        select:focus{
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
        <a href="/products">Produk</a>
        <a href="/incoming-items/create">Barang Masuk</a>
        <a href="/incoming-items">Riwayat Masuk</a>
        <a href="/outgoing-items/create">Barang Keluar</a>
        <a href="/outgoing-items">Riwayat Keluar</a>
        <a href="/reports">Laporan</a>

        @if(session('role') == 'superadmin')
            <a href="/admins" class="active">Kelola Admin</a>
        @endif

        <a href="/logout">Keluar</a>

    </div>

    <div class="main">

        <div class="title">
            Tambah Admin
        </div>

        <form action="/admins" method="POST">

            @csrf

            <input
                type="text"
                name="username"
                placeholder="Username Admin"
                required
            >

            <input
                type="text"
                name="password"
                placeholder="Password"
                required
            >

            <select name="role">
                <option value="admin">Admin</option>
                <option value="superadmin">Super Admin</option>
            </select>

            <select name="status">
                <option value="Aktif">Aktif</option>
                <option value="Nonaktif">Nonaktif</option>
            </select>

            <button type="submit">
                Simpan Admin
            </button>

        </form>

    </div>

</body>
</html>