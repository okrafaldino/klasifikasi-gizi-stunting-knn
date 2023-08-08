<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <h1 class="mb-3">Form Tambah Data Balita</h1>
            <!-- error data -->
            <?php if (session('validation')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        <?php foreach (session('validation')->getErrors() as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>
            <!-- error data -->
            <form action="/databalita/simpan" method="post">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" autofocus value="<?= old('nama'); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="umur" class="col-sm-2 col-form-label">Umur(bulan)</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="umur" name="umur" value="<?= old('umur'); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="beratbadan" class="col-sm-2 col-form-label">Berat Badan(kg)</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="beratbadan" name="beratbadan" value="<?= old('beratbadan') ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tinggibadan" class="col-sm-2 col-form-label">Tinggi Badan(cm)</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="tinggibadan" name="tinggibadan" value="<?= old('tinggibadan') ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status" class="col-sm-2 col-form-label form-floating">Status</label>
                    <div class="col-sm-10">
                        <select class="form-select form-select-sm col-form-label" aria-label=".form-select-sm example" id="status" name="status">
                            <option value="Stunting">Stunting</option>
                            <option value="Normal">Normal</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>