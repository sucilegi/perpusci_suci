<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1>Dashboard</h1>

<p>
    Selamat datang di
    <?= esc($namaAplikasi) ?>.
</p>


<div class="cards">

    <div class="card">
        <h3>Total Buku</h3>

        <p>
            <?= esc((string) $totalBuku) ?>
        </p>
    </div>


    <div class="card">
        <h3>Total Anggota</h3>

        <p>
            <?= esc((string) $totalAnggota) ?>
        </p>
    </div>

</div>

<?= $this->endSection() ?>
