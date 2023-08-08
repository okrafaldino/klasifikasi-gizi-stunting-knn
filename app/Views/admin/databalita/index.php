<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Balita</h1>
    <p class="mb-4">Halaman ini merupakan halaman input data balita pada website klasifikasi stunting balita, yang mana merupakan sarana yang penting dalam mengumpulkan data latih untuk meningkatkan akurasi sistem klasifikasi tersebut.</p>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="dropdown d-inline mr-2">
                <a href="/databalita/input" class="btn btn-primary">Tambah Data</a>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Import Data
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= base_url('contohdatalatih.xlsx') ?>"><i class="fas fa-file-excel"></i> Download Example</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-file-import"></i> Upload File</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?= session()->getFlashdata('pesan') ?></strong> Anda Bisa Cek di bawah ini.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class=" text-center" scope="col">No</th>
                            <th class=" text-center" scope="col">Nama</th>
                            <th class=" text-center" scope="col">Umur (bulan)</th>
                            <th class=" text-center" scope="col">Berat Badan (kg)</th>
                            <th class=" text-center" scope="col">Tinggi Badan (cm)</th>
                            <th class=" text-center" scope="col">Status</th>
                            <th class=" text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($balita as $b) { ?>
                            <tr>
                                <td class=" text-center"><?= $i++ ?></td>
                                <td class=" text-center"><?php echo $b['nama']; ?></td>
                                <td class=" text-center"><?php echo $b['umur']; ?></td>
                                <td class=" text-center"><?php echo $b['beratbadan']; ?></td>
                                <td class=" text-center"><?php echo $b['tinggibadan']; ?></td>
                                <td class=" text-center"><?php echo $b['status']; ?></td>
                                <td class=" text-center">
                                    <a href="/databalita/update/<?php echo $b['id']; ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                    <a href="/databalita/delete/<?php echo $b['id']; ?>" class="btn btn-icon btn-danger" onclick="return confirm('Apakah Anda Yakin?');\"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Import File Excel</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/databalita/import" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div>
                        <div class="input-group">
                            <input type="file" name="file_excel" id="file_excel" class="form-control" id="input-file" aria-describedby="input-file-addon" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
</div>


<?= $this->endSection(); ?>