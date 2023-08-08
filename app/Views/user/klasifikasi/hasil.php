<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid" id="hasilKlasifikasi">
    <!-- Tabel Hasil Klasifikasi -->
    <h1 class="h3 mb-3 text-gray-800">Tabel Hasil Klasifikasi</h1>

    <div class="row">
        <!-- Input Data -->
        <div class="col col-lg">
            <div class="container-hasil card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Data Balita</h5>
                    <div class="dropdown no-arrow tombol-hasil">
                        <button class="btn btn-info" onclick="cetakElement('hasilKlasifikasi')">Cetak</button>
                        <button class="btn btn-primary" onclick="window.history.back()">Kembali</button>

                    </div>
                </div>
                <!-- Card Body -->
                <?php $no = 1; ?>
                <?php foreach ($hasil_klasifikasi as $hasil) : ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Tabel muncul -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Balita</th>
                                        <th>Umur</th>
                                        <th>Berat Badan</th>
                                        <th>Tinggi Badan</th>
                                        <th>Status Uji</th>
                                        <th class="detail-tombol">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $hasil['data_uji']['nama']; ?></td>
                                        <td><?= $hasil['data_uji']['umur']; ?></td>
                                        <td><?= $hasil['data_uji']['beratbadan']; ?></td>
                                        <td><?= $hasil['data_uji']['tinggibadan']; ?></td>
                                        <td><?= $hasil['status_uji']; ?></td>
                                        <td class="detail-tombol"><button class="btn btn-secondary btn-detail" data-id="<?= $no; ?>">Detail</button></td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Tabel Tersembunyi -->
                            <div class="detail-container" id="detail-container-<?= $no; ?>" style="display: none;">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h5 class="m-0 font-weight-bold text-grey">Detail Klasifikasi - <?= $hasil['data_uji']['nama']; ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="h3 mb-2 text-gray-800">Tabel Jarak</h5>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nama Balita</th>
                                                    <th>Umur</th>
                                                    <th>Berat Badan</th>
                                                    <th>Tinggi Badan</th>
                                                    <th>Jarak</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($hasil['jarak'] as $jarak) : ?>
                                                    <tr>
                                                        <td><?= $jarak['nama']; ?></td>
                                                        <td><?= $jarak['umur']; ?></td>
                                                        <td><?= $jarak['beratbadan']; ?></td>
                                                        <td><?= $jarak['tinggibadan']; ?></td>
                                                        <td><?= $jarak['jarak']; ?></td>
                                                        <td><?= $jarak['status']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>

                                        <!-- Tabel Balita Terdekat -->
                                        <h5 class="h3 mb-2 text-gray-800">Tabel Balita Terdekat</h5>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nama Balita</th>
                                                    <th>Umur</th>
                                                    <th>Berat Badan</th>
                                                    <th>Tinggi Badan</th>
                                                    <th>Jarak</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($hasil['balita_terdekat'] as $balita) : ?>
                                                    <tr>
                                                        <td><?= $balita['nama']; ?></td>
                                                        <td><?= $balita['umur']; ?></td>
                                                        <td><?= $balita['beratbadan']; ?></td>
                                                        <td><?= $balita['tinggibadan']; ?></td>
                                                        <td><?= $balita['jarak']; ?></td>
                                                        <td><?= $balita['status']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>

                                        <!-- Tabel Hasil Klasifikasi -->

                                        <h5 class="h3 mb-2 text-gray-800">Hasil Klasifikasi</h5>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Data Uji</th>
                                                    <th>Status Klasifikasi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Nama: <?= $hasil['data_uji']['nama']; ?><br>
                                                        Umur: <?= $hasil['data_uji']['umur']; ?><br>
                                                        Berat Badan: <?= $hasil['data_uji']['beratbadan']; ?><br>
                                                        Tinggi Badan: <?= $hasil['data_uji']['tinggibadan']; ?>
                                                    </td>
                                                    <td><?= $hasil['status_uji']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

        </div>


    </div>







    <?= $this->endSection(); ?>