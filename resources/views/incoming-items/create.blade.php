<!DOCTYPE html>
<html>
<head>
    <title>Barang Masuk</title>

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
            width:400px;
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
        <a href="/products">Produk</a>
        <a href="/incoming-items/create" class="active">Barang Masuk</a>
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
            Barang Masuk
        </div>

        <form action="/incoming-items" method="POST">
            @csrf

            <input
                type="text"
                id="productSearch"
                list="productList"
                placeholder="Cari Nama Bunga..."
                autocomplete="off"
                required
            >

            <datalist id="productList">
                @foreach($products as $product)
                    <option
                        value="{{ $product->name }}"
                        data-id="{{ $product->id }}"
                        data-price="{{ $product->price }}">
                    </option>
                @endforeach
            </datalist>

            <input type="hidden" name="product_id" id="productId">

            <input
                type="number"
                name="price"
                id="priceInput"
                placeholder="Harga"
                readonly
            >

            <input type="number" name="quantity" placeholder="Jumlah Masuk" required>

            <input type="date" name="date" required>

            <button type="submit">
                Simpan
            </button>
        </form>

    </div>

    <script>
        const products = @json($products);

        const productSearch = document.getElementById('productSearch');
        const productId = document.getElementById('productId');
        const priceInput = document.getElementById('priceInput');

        productSearch.addEventListener('input', function(){
            const selectedProduct = products.find(product => product.name === productSearch.value);

            if(selectedProduct){
                productId.value = selectedProduct.id;
                priceInput.value = selectedProduct.price;
            } else {
                productId.value = '';
                priceInput.value = '';
            }
        });
    </script>

</body>
</html>