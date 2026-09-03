<!DOCTYPE html>
<html>
<head>
    <title>Kelola Admin</title>

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

        .card{
            background:#111;
            padding:25px;
            border-radius:15px;
            border:1px solid #ff69b4;
            box-shadow:0 0 15px #ff69b4;
            margin-bottom:25px;
            width:700px;
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

        .btn{
            background:#ff69b4;
            color:white;
            padding:10px 15px;
            border:none;
            border-radius:8px;
            cursor:pointer;
            text-decoration:none;
            display:inline-block;
        }

        .delete-btn{
            background:red;
            color:white;
            padding:10px 15px;
            border:none;
            border-radius:8px;
            cursor:pointer;
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
            Kelola Admin
        </div>

        <div class="card">
            <p>
                Halaman ini digunakan oleh Super Admin untuk menambah, mengedit, dan menghapus akun admin yang memiliki akses ke sistem inventory toko bunga.
            </p>
        </div>

        @if(session('error'))
            <div style="
                background:red;
                padding:12px;
                border-radius:8px;
                margin-bottom:20px;
            ">
                {{ session('error') }}
            </div>
        @endif

        <a href="/admins/create" class="btn">
            + Tambah Admin
        </a>

        <br><br>

        <table>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            @foreach($admins as $admin)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $admin->username }}</td>

                    <td>{{ $admin->password }}</td>

                    <td>{{ $admin->role }}</td>

                    <td>{{ $admin->status }}</td>

                    <td>
                        <a href="/admins/{{ $admin->id }}/edit" class="btn">
                            Edit
                        </a>

                        <form action="/admins/{{ $admin->id }}" method="POST" style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="delete-btn">
                                Hapus
                            </button>

                        </form>
                    </td>
                </tr>

            @endforeach

        </table>

    </div>

</body>
</html>