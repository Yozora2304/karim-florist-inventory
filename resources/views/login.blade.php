<!DOCTYPE html>

<html>
<head>
    <title>Login Penyimpanan Barang</title>

```
<style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family: Arial;
    }

    body{
        height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        background:black;
    }

    .login-box{
        width:350px;
        padding:40px;
        background:#111;
        border:1px solid #ff69b4;
        box-shadow:0 0 20px #ff69b4;
        border-radius:15px;
    }

    h1{
        text-align:center;
        color:#ff69b4;
        margin-bottom:30px;
    }

    input{
        width:100%;
        padding:12px;
        margin-bottom:20px;
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
        color:black;
        font-weight:bold;
        border-radius:8px;
        cursor:pointer;
        transition:0.3s;
    }

    button:hover{
        box-shadow:0 0 20px #ff69b4;
    }

    .text{
        text-align:center;
        color:white;
        margin-top:15px;
        font-size:14px;
    }

    .error{
        background:red;
        color:white;
        padding:10px;
        margin-bottom:20px;
        border-radius:8px;
        text-align:center;
    }

</style>
```

</head>

<body>

```
<div class="login-box">

    <h1>LOGIN PENYIMPANAN BARANG</h1>

    @if(session('error'))

        <div class="error">
            {{ session('error') }}
        </div>

    @endif

    <form action="/login" method="POST">

        @csrf

        <input
            type="text"
            name="username"
            placeholder="Username"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Password"
            required
        >

        <button type="submit">
            Masuk
        </button>

    </form>

    <div class="text">

        Sistem Penyimpanan Barang
        <br>
        Toko Bunga Karim

    </div>

</div>
```

</body>
</html>
