<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1>Manajemen Buku</h1>

<p> 
    Total buku:
    <strong><?= esc((string) $totalBooks) ?></strong>
</p>

<table class="data-table">

    <thead>
        <tr>
            <th>No.</th>
            <th>Kode</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Kategori</th>
            <th>Tahun</th>
            <th>Stok</th>
        </tr>
    </thead>

    <tbody>

        <?php foreach ($books as $index => $book): ?>

            <tr>

                <td>
                    <?= $index + 1 ?>
                </td>

                <td>
                    <?= esc($book['book_code']) ?>
                </td>

                <td>
                    <?= esc($book['title']) ?>
                </td>

                <td>
                    <?= esc($book['author']) ?>
                </td>

                <td>
                    <?= esc($book['publisher']) ?>
                </td>

                <td>
                    <?= esc($book['category']) ?>
                </td>

                <td>
                    <?= esc((string) $book['publication_year']) ?>
                </td>

                <td>
                    <?= esc((string) $book['stock_available']) ?>/
                     <?= esc((string) $book['stock_total']) ?>
                </td>

            </tr>

        <?php endforeach; ?>

    </tbody>

</table>

<?= $this->endSection() ?>


