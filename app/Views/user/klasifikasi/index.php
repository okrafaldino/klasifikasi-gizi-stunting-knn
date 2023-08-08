<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Klasifikasi</h1>
    <p class="mb-4">Halaman klasifikasi pada website stunting balita ini membantu dalam mengidentifikasi apakah seorang anak mengalami stunting atau tidak, dengan memberikan data status gizi balita yang mau diukur.</p>

    <!-- Form input  -->
    <div class="row">

        <!-- Input Data -->
        <div class="col col-lg">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Masukan Data Balita</h5>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle btn btn-info" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Import Data</i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">File</div>
                            <a class="dropdown-item" href="<?= base_url('contohdatauji.xlsx') ?>">Download Example</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">Upload File</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="/klasifikasi/input" method="POST" class="row gx-3 gy-2 align-items-center mb-3">
                        <div class="col-sm-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="col-sm-3">
                            <label for="umur" class="form-label">Umur (bulan)</label>
                            <input type="number" class="form-control" id="umur" name="umur">
                        </div>
                        <div class="col-sm-3">
                            <label for="beratbadan" class="form-label">Berat Badan(kg)</label>
                            <input type="number" class="form-control" id="beratbadan" name="beratbadan">
                        </div>
                        <div class="col-sm-3">
                            <label for="tinggibadan" class="form-label">Tinggi Badan(cm)</label>
                            <input type="number" class="form-control" id="tinggibadan" name="tinggibadan">
                        </div>
                        <div class="col-auto mt-3">
                            <button type="submit" class="btn btn-primary">Tambah data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- Tabel Data Balita -->
    <div class="row">
        <div class="col col-lg">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Data Balita</h5>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success alert-dismissible fade show mb-3 mt-3" role="alert">
                            <strong><?= session()->getFlashdata('pesan') ?></strong> Anda Bisa Cek di bawah ini.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class=" text-center" scope="col">No</th>
                                    <th class=" text-center" scope="col">Nama</th>
                                    <th class=" text-center" scope="col">Umur(bulan)</th>
                                    <th class=" text-center" scope="col">Berat Badan(kg)</th>
                                    <th class=" text-center" scope="col">Tinggi Badan(cm)</th>
                                    <th class=" text-center" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($uji as $u) : ?>
                                    <tr>
                                        <th class=" text-center" scope="row"><?= $i++ ?></th>
                                        <td class=" text-center"><?= $u['nama']; ?></td>
                                        <td class=" text-center"><?= $u['umur']; ?></td>
                                        <td class=" text-center"><?= $u['beratbadan']; ?></td>
                                        <td class=" text-center"><?= $u['tinggibadan']; ?></td>
                                        <td class=" text-center">
                                            <a href="/klasifikasi/update/<?= $u['id'] ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                            <a href="/klasifikasi/delete/<?= $u['id']; ?>" class="btn btn-icon btn-danger" onclick="return confirm('Apakah Anda Yakin ?');"><i class="fas fa-times"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col col-lg">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Masukan Nilai K</h5>
                </div>
                <div class="card-body">
                    <form action="/klasifikasi/proses" method="post">
                        <div class="row mb-3">
                            <label for="k" class="col-sm-1 col-form-label">Nilai K</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="k" name="k" value="3">
                            </div>
                        </div>
                        <div class="mb-3 ">
                            <button type="submit" class="btn btn-primary">Uji Keseluruhan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import File Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/klasifikasi/import" method="post" enctype="multipart/form-data">
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