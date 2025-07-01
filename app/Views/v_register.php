<?= $this->extend('layout_clear') ?>
<?= $this->section('content') ?>

<?php
$username = [
    'name' => 'username',
    'id' => 'username',
    'class' => 'form-control',
    'value' => old('username')
];

$email = [
    'name' => 'email',
    'id' => 'email',
    'class' => 'form-control',
    'value' => old('email')
];

$password = [
    'name' => 'password',
    'id' => 'password',
    'class' => 'form-control'
];

$pass_confirm = [
    'name' => 'pass_confirm',
    'id' => 'pass_confirm',
    'class' => 'form-control'
];
?>

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="https://www.vivo.com/id/products" class="logo d-flex align-items-center w-auto">
                        <img src="<?= base_url() ?>NiceAdmin/assets/img/logo-toko.png" alt="" style="height: 100px !important; max-height: none !important;">
                    </a>
                </div><!-- End Logo -->

                <div class="card mb-3">
                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                            <p class="text-center small">Enter your personal details to create account</p>
                        </div>

                        <!-- Flashdata Alerts -->
                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-start" role="alert" style="font-size: 14px; border-left: 4px solid #dc3545; padding: 0.75rem 1rem;">
                                <i class="bi bi-exclamation-circle-fill mr-2" style="font-size: 1.2rem; color: #dc3545;"></i>
                                <div class="flex-grow-1 ml-2">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                                <button type="button" class="btn-close ml-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>



                        <?php if (session()->getFlashdata('success')) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('success') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <?= form_open('register', ['class' => 'row g-3 needs-validation', 'novalidate' => true]) ?>

                        <div class="col-12">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">@</span>
                                <?= form_input($username) ?>
                                <div class="invalid-feedback">Please choose a username.</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <?= form_input($email) ?>
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>

                        <div class="col-12">
                            <label for="password" class="form-label">Password</label>
                            <?= form_password($password) ?>
                            <div class="invalid-feedback">Please enter your password!</div>
                        </div>

                        <div class="col-12">
                            <label for="pass_confirm" class="form-label">Confirm Password</label>
                            <?= form_password($pass_confirm) ?>
                            <div class="invalid-feedback">Please confirm your password!</div>
                        </div>

                        <div class="col-12">
                            <?= form_submit('submit', 'Register', ['class' => 'btn btn-primary w-100']) ?>
                        </div>

                        <div class="col-12 text-center">
                            <p class="small mb-0">Already have an account? <a href="<?= base_url('login') ?>">Login</a></p>
                        </div>

                        <?= form_close() ?>

                    </div>
                </div>

                <div class="credits">
                    Designed by <a href="https://bootstrapmade.com/">VioletaChaitra</a>
                </div>

            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>