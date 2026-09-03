<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

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
            margin-bottom:40px;
            text-align:center;
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

        .cards{
            display:flex;
            gap:20px;
            flex-wrap:wrap;
        }

        .card{
            background:#111;
            width:220px;
            padding:25px;
            border-radius:15px;
            border:1px solid #ff69b4;
            box-shadow:0 0 15px #ff69b4;
        }

        .card h3{
            color:#ff69b4;
            margin-bottom:10px;
        }

        .card p{
            font-size:28px;
            font-weight:bold;
        }

        .chart-container{
            margin-top:40px;
            display:flex;
            gap:30px;
            flex-wrap:wrap;
        }

        .chart-box{
            background:#111;
            padding:25px;
            border-radius:15px;
            border:1px solid #ff69b4;
            box-shadow:0 0 15px #ff69b4;
            width:500px;
        }

        .chart-box h3{
            color:#ff69b4;
            margin-bottom:20px;
        }

    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="sidebar">

        <h2>TOKO BUNGA KARIM</h2>

        <a href="/dashboard" class="active">Beranda</a>

        <a href="/products">Produk</a>

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
            Beranda Penyimpanan Barang
        </div>

        <div class="cards">

            <div class="card">
                <h3>Total Produk</h3>
                <p>{{ $totalProducts }}</p>
            </div>

            <div class="card">
                <h3>Barang Masuk</h3>
                <p>{{ $totalIncoming }}</p>
            </div>

            <div class="card">
                <h3>Stok Tersedia</h3>
                <p>{{ $totalStock }}</p>
            </div>

            <div class="card">
                <h3>Barang Keluar</h3>
                <p>{{ $totalOutgoing }}</p>
            </div>

        <div class="chart-container">

            <div class="chart-box">
                <h3>Grafik Barang Masuk</h3>
                <canvas id="incomingChart"></canvas>
            </div>

            <div class="chart-box">
                <h3>Grafik Barang Keluar</h3>
                <canvas id="outgoingChart"></canvas>
            </div>

        </div>

    </div>

</body>

<script>

const incomingLabels = @json($incomingChart->pluck('date'));

const incomingTotals = @json($incomingChart->pluck('total'));

const outgoingLabels = @json($outgoingChart->pluck('date'));

const outgoingTotals = @json($outgoingChart->pluck('total'));

new Chart(document.getElementById('incomingChart'), {
    type: 'line',
    data: {
        labels: incomingLabels,
        datasets: [{
            label: 'Barang Masuk',
            data: incomingTotals,
            borderColor: '#ff69b4',
            backgroundColor: 'rgba(255,105,180,0.2)',
            tension: 0.4,
            fill: true
        }]
    }
});

new Chart(document.getElementById('outgoingChart'), {
    type: 'bar',
    data: {
        labels: outgoingLabels,
        datasets: [{
            label: 'Barang Keluar',
            data: outgoingTotals,
            backgroundColor: '#ff69b4'
        }]
    }
});

</script>

</html>