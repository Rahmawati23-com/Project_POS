@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <x-adminlte-info-box title="Total Revenue" text="Rp 87.500.000" icon="fas fa-money-bill" icon-theme="success"/>
    </div>
    <div class="col-lg-3 col-6">
        <x-adminlte-info-box title="Total Order" text="920" icon="fas fa-shopping-cart" icon-theme="info"/>
    </div>
    <div class="col-lg-3 col-6">
        <x-adminlte-info-box title="Rata-rata Pembelian" text="Rp 95.000" icon="fas fa-chart-line" icon-theme="primary"/>
    </div>
    <div class="col-lg-3 col-6">
        <x-adminlte-info-box title="Total Diskon" text="Rp 5.250.000" icon="fas fa-percent" icon-theme="danger"/>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <x-adminlte-card title="Penjualan Bulanan" theme="light" icon="fas fa-chart-area">
            <canvas id="salesChart" height="120"></canvas>
        </x-adminlte-card>
    </div>
    <div class="col-md-4">
        <x-adminlte-card title="Metode Pembayaran" theme="light" icon="fas fa-coins">
            <canvas id="paymentChart" height="120"></canvas>
        </x-adminlte-card>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <x-adminlte-card title="Produk Mainan Terlaris" theme="light" icon="fas fa-star">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mainan</th>
                        <th>Harga</th>
                        <th>Terjual</th>
                        <th>Diskon</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>1</td><td>Robot Transformer</td><td>Rp120.000</td><td>520</td><td>10%</td><td>Rp56.160.000</td></tr>
                    <tr><td>2</td><td>Boneka Elsa</td><td>Rp85.000</td><td>430</td><td>5%</td><td>Rp34.647.500</td></tr>
                    <tr><td>3</td><td>Puzzle 3D</td><td>Rp60.000</td><td>390</td><td>7%</td><td>Rp21.762.000</td></tr>
                </tbody>
            </table>
        </x-adminlte-card>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const salesChart = new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
            datasets: [{
                label: 'Penjualan',
                data: [12000, 15000, 18000, 16000, 21000, 19000, 23000],
                borderColor: '#00a8ff',
                backgroundColor: 'rgba(0,168,255,0.1)',
                fill: true,
                tension: 0.4
            }]
        }
    });

    const paymentChart = new Chart(document.getElementById('paymentChart'), {
        type: 'doughnut',
        data: {
            labels: ['Cash', 'Debit/Kredit', 'QRIS'],
            datasets: [{
                data: [40, 45, 15],
                backgroundColor: ['#00a8ff', '#e1b12c', '#9c88ff'],
            }]
        }
    });
</script>
@endsection
