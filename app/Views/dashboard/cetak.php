<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Voltcell</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 40px;
            color: #000;
        }

        h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 0;
        }

        p.date {
            text-align: center;
            margin-top: 0;
            font-size: 14px;
            color: #555;
        }

        hr {
            margin: 20px 0;
        }

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        th,
        td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f1f1f1;
        }

        tr:nth-child(even) {
            background-color: #fbfbfb;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }

        .text-left {
            text-align: left;
        }
    </style>
</head>

<body>

    <h1>Dashboard - Voltcell</h1>
    <p class="date"><?= date("l, d-m-Y") ?> ::</p>
    <hr>

    <div class="table-container">
        <table>
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
                <?php if (!empty($transactions)): ?>
                    <?php $i = 1;
                    foreach ($transactions as $row): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= esc($row['username']) ?></td>
                            <td class="text-left"><?= esc($row['alamat']) ?></td>
                            <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($row['ongkir'], 0, ',', '.') ?></td>
                            <td>
                                <?php
                                $statusList = [
                                    '0' => 'Belum Selesai',
                                    '1' => 'Dikemas',
                                    '2' => 'Dikirim',
                                    '3' => 'Selesai',
                                    'belum_selesai' => 'Belum Selesai',
                                    'dikemas' => 'Dikemas',
                                    'dikirim' => 'Dikirim',
                                    'selesai' => 'Selesai'
                                ];
                                $statusKey = $row['status'];
                                echo isset($statusList[$statusKey]) ? $statusList[$statusKey] : $statusKey;
                                ?>
                            </td>
                            <td><?= date('d-m-Y H:i', strtotime($row['created_at'])) ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Tidak ada data transaksi.</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        Download on <?= date('Y-m-d H:i:s') ?>
    </div>

</body>

</html>

<script>
    window.print();
    window.setTimeout(() => {
        window.close();
    }, 1000);
</script>