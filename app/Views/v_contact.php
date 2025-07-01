<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h2 class="mb-4">Hubungi Kami</h2>
    <p>Hai, <strong><?= esc($username) ?></strong>. Jika kamu memiliki pertanyaan, keluhan, atau saran, silakan hubungi kami melalui informasi di bawah ini:</p>

    <ul class="list-unstyled mt-4">
        <li><strong>Email:</strong> support@voltcell.com</li>
        <li><strong>WhatsApp:</strong> 0812-3456-7890</li>
        <li><strong>Alamat:</strong> Jl. Teknologi No.123, Jakarta</li>
    </ul>

    <p class="mt-4">Kami akan merespon pesan Anda dalam waktu 1x24 jam.</p>
</div>

<?= $this->endSection() ?>
