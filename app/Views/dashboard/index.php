<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Voltcell</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
            min-height: 100vh;
        }
        .dashboard-header {
            background: #6366f1;
            color: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 24px rgba(99,102,241,0.15);
            padding: 2rem 1rem 1rem 1rem;
            margin-bottom: 2rem;
        }
        .dashboard-header h1 {
            font-weight: 700;
            letter-spacing: 2px;
        }
        .dashboard-header p {
            font-size: 1.2rem;
        }
        .dashboard-cards {
            margin-bottom: 2rem;
        }
        .dashboard-cards .card {
            border-radius: 1rem;
            box-shadow: 0 2px 16px rgba(99,102,241,0.08);
            background: #fff;
            border: none;
            transition: transform 0.15s;
        }
        .dashboard-cards .card:hover {
            transform: translateY(-4px) scale(1.03);
        }
        .dashboard-cards .card .card-body {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .dashboard-cards .icon {
            font-size: 2.2rem;
            padding: 0.7rem 1rem;
            border-radius: 0.7rem;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .dashboard-cards .icon-users { background: #6366f1; }
        .dashboard-cards .icon-transaksi { background: #fbbf24; }
        .dashboard-cards .icon-pendapatan { background: #22c55e; }
        .dashboard-cards .card-title {
            font-size: 1.1rem;
            color: #64748b;
            margin-bottom: 0.2rem;
        }
        .dashboard-cards .card-text {
            font-size: 1.5rem;
            font-weight: 700;
        }
        .card.table-card {
            border-radius: 1rem;
            box-shadow: 0 2px 16px rgba(99,102,241,0.08);
            background: #fff;
        }
        .table thead {
            background: #6366f1;
            color: #fff;
        }
        .table tbody tr:hover {
            background: #f1f5f9;
        }
        .btn-export {
            background: #ef4444;
            color: #fff;
            font-weight: 600;
            border-radius: 2rem;
            padding: 0.5rem 2rem;
            transition: background 0.2s;
        }
        .btn-export:hover {
            background: #dc2626;
            color: #fff;
        }
        .form-select {
            border-radius: 1rem;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="dashboard-header text-center mx-auto mb-4 p-4 rounded shadow" style="background: linear-gradient(135deg, #1e293b, #0f172a); color: #f8fafc;">
            <h1 class="display-4 fw-bold mb-2">
                <i class="fa-solid fa-mobile-screen-button" style="color: #ffffff;"></i> 
                <span style="color: #ffffff;">Voltcell</span> Dashboard
            </h1>
            <p class="lead mb-0" style="font-size: 1.2rem;">
                <i class="fa-regular fa-calendar-days me-1"></i> <?= date("l, d-m-Y") ?>
            </p>
            <p id="clock" class="mt-1" style="font-size: 1.5rem; font-weight: 500;">
                <i class="fa-regular fa-clock me-1"></i> 
                <span id="jam"></span>:<span id="menit"></span>:<span id="detik"></span>
            </p>
        </div>

        <!-- Dashboard Cards -->
        <div class="row dashboard-cards justify-content-center mb-4">
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <span class="icon icon-users icon-shadow"><i class="fa-solid fa-user-group"></i></span>
                        <div>
                            <div class="card-title">Total User</div>
                            <div class="card-text">
                                <?= isset($totalUser) ? number_format($totalUser, 0, ',', '.') : '0' ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <span class="icon icon-transaksi icon-shadow"><i class="fa-solid fa-file-invoice"></i></span>
                        <div>
                            <div class="card-title">Total Transaksi</div>
                            <div class="card-text">
                                <?= isset($totalTransaksi) ? number_format($totalTransaksi, 0, ',', '.') : '0' ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <span class="icon icon-pendapatan icon-shadow"><i class="fa-solid fa-money-bill-trend-up"></i></span>
                        <div>
                            <div class="card-title">Total Pendapatan</div>
                            <div class="card-text text-success">
                                Rp <?= isset($totalPendapatan) ? number_format($totalPendapatan, 0, ',', '.') : '0' ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive card table-card p-4">
            <table class="table align-middle text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Alamat</th>
                    <th>Total Harga</th>
                    <th>Ongkir</th>
                    <th>Status</th>
                    <th>Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($transactions)) :
                    $i = 1;
                    $statusOptions = [
                        'belum_selesai' => 'Belum Selesai',
                        'dikemas' => 'Dikemas',
                        'dikirim' => 'Dikirim',
                        'selesai' => 'Selesai'
                    ];
                    foreach ($transactions as $item1) :
                ?>
                        <tr>
                            <td><span class="badge rounded-circle bg-primary text-white d-inline-flex justify-content-center align-items-center" style="width: 36px; height: 36px; font-size: 1rem;"><?= $i++ ?></span></td>
                            <td><i class="fa-solid fa-user"></i> <?= $item1['username']; ?></td>
                            <td><i class="fa-solid fa-location-dot"></i> <?= $item1['alamat']; ?></td>
                            <td><span class="text-success">Rp <?= number_format($item1['total_harga'], 0, ',', '.') ?></span></td>
                            <td><span class="text-info">Rp <?= number_format($item1['ongkir'], 0, ',', '.') ?></span></td>
                            <td>
                                <form action="<?= base_url('transaksi/updateStatus') ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $item1['id'] ?>">
                                    <select name="status" class="form-select" onchange="this.form.submit()">
                                        <?php foreach ($statusOptions as $value => $label) : ?>
                                            <option value="<?= $value ?>" <?= $item1['status'] == $value ? 'selected' : '' ?>>
                                                <?= $label ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </form>
                            </td>
                            <td><i class="fa-regular fa-calendar"></i> <?= $item1['created_at']; ?></td>
                        </tr>
                <?php endforeach;
                else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada transaksi.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="text-center">
            <a href="<?= base_url('dashboard/cetak') ?>" class="btn btn-export mb-3 mt-2" target="_blank" id="btn-cetak">
                <i class="fa-solid fa-file-pdf"></i> Export PDF
            </a>
        </div>
    </div>
    </div>

    <script>
        function waktu() {
            const now = new Date();
            document.getElementById("jam").innerHTML = now.getHours().toString().padStart(2, '0');
            document.getElementById("menit").innerHTML = now.getMinutes().toString().padStart(2, '0');
            document.getElementById("detik").innerHTML = now.getSeconds().toString().padStart(2, '0');
        }
        setInterval(waktu, 1000); // panggil setiap 1000 ms (1 detik)
        waktu(); // panggil sekali saat pertama kali halaman dibuka
    </script>
</body>

</html>
<?= $this->endSection() ?>