<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h2>Frequently Asked Questions (F.A.Q)</h2>
    
    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                    Bagaimana cara melakukan pemesanan?
                </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    Kamu bisa melakukan pemesanan melalui halaman produk dan menambahkan ke keranjang.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                    Metode pembayaran apa saja yang tersedia?
                </button>
            </h2>
            <div id="collapse2" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Kami menerima pembayaran melalui transfer bank dan QRIS.
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
