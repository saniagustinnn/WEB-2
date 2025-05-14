<?php
require_once("Controllers/Prodi.php");
$dataprodi = $prodi->index();
?>

<div class="container">
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modal-default">
                Tambah Data
            </button>
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Tambah Data </h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nidn">NIDN</label>
                                    <input type="text" name="nidn" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="prodi_id">Program Studi</label>
                                    <select name="prodi_id" class="form-control" required>
                                        <option value="">-- Pilih Program Studi --</option>
                                        <?php foreach ($dataprodi as $item): ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>  
                                </div>
                                <div class="form-group">
                                    <label for="gelar_depan">Gelar Depan</label>
                                    <input type="text" name="gelar_depan" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="gelar_belakang">Gelar Belakang</label>
                                    <input type="text" name="gelar_belakang" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="tahun_masuk">Tahun Masuk</label>
                                    <input type="text" name="tahun_masuk" class="form-control" required>
                                </div>
                                <input type="hidden" name="type" value="tambah">
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> 
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIDN</th>
                        <th>Nama & Gelar</th>
                        <th>Program Studi</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat & Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Tahun Masuk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once("Controllers/Dosen.php");
                    $row = $dosen->index();
                    $nomor = 1;
                    foreach ($row as $item):
                    ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <td><?= $item['nidn'] ?></td>
                            <td><?= $item['gelar_depan'] ?> <?= $item['nama'] ?> <?= $item['gelar_belakang'] ?></td>
                            <td><?= $item['prodi_id'] ?></td>
                            <td><?= $item['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                            <td><?= $item['tempat_lahir'] ?>, <?= $item['tanggal_lahir'] ?></td>
                            <td><?= $item['alamat'] ?></td>
                            <td><?= $item['email'] ?></td>
                            <td><?= $item['tahun_masuk'] ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <input type="hidden" name="type" value="delete">
                                    <input type="submit" value="delete" class="btn btn-danger btn-sm">
                                </form>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-edit-<?= $item['id'] ?>">Edit</button>
                            </td>
                        </tr>
                        <div class="modal fade" id="modal-edit-<?= $item['id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Form Edit Data </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nidn">NIDN</label>
                                                <input type="text" name="nidn" class="form-control" value="<?= $item['nidn'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" name="nama" class="form-control" value="<?= $item['nama'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="prodi_id">Program Studi</label>
                                                <select name="prodi_id" class="form-control" required>
                                                    <?php foreach ($dataprodi as $p): ?>
                                                    <option value="<?= $p['id'] ?>" <?= $item['prodi_id'] == $p['id'] ? 'selected' : '' ?>><?= $p['nama'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="gelar_depan">Gelar Depan</label>
                                                <input type="text" name="gelar_depan" class="form-control" value="<?= $item['gelar_depan'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="gelar_belakang">Gelar Belakang</label>
                                                <input type="text" name="gelar_belakang" class="form-control" value="<?= $item['gelar_belakang'] ?>" required">
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                <select name="jenis_kelamin" class="form-control" required>
                                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                                    <option value="L" <?= $item['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                                    <option value="P" <?= $item['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir" class="form-control" value="<?= $item['tempat_lahir'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir" class="form-control" value="<?= $item['tanggal_lahir'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" name="alamat" class="form-control" value="<?= $item['alamat'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control" value="<?= $item['email'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tahun_masuk">Tahun Masuk</label>
                                                <input type="text" name="tahun_masuk" class="form-control" value="<?= $item['tahun_masuk'] ?>" required>
                                            </div>
                                        
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            <input type="hidden" name="type" value="update">
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    <?php
                    endforeach;
                    if (isset($_POST['type'])) {
                        if ($_POST['type'] == "delete") {
                            $dosen->delete($_POST['id']);
                            echo '<script>alert("hapus berhasil")</script><meta http-equiv="refresh" content="0; url=?url=dosen">';
                        } elseif ($_POST['type'] == "tambah") {
                            $data = [
                                'nidn' => $_POST['nidn'],
                                'nama' => $_POST['nama'],
                                'gelar_depan' => $_POST['gelar_depan'],
                                'gelar_belakang' => $_POST['gelar_belakang'],
                                'prodi_id' => $_POST['prodi_id'],
                                'jenis_kelamin' => $_POST['jenis_kelamin'],
                                'tempat_lahir' => $_POST['tempat_lahir'],
                                'tanggal_lahir' => $_POST['tanggal_lahir'],
                                'alamat' => $_POST['alamat'],
                                'email' => $_POST['email'],
                                'tahun_masuk' => $_POST['tahun_masuk'],
                            ];
                            $dosen->create($data);
                            echo '<script>alert("tambah berhasil")</script><meta http-equiv="refresh" content="0; url=?url=dosen">';
                        } elseif ($_POST['type'] == "update") {
                            $data = [
                                'nidn' => $_POST['nidn'],
                                'nama' => $_POST['nama'],
                                'gelar_depan' => $_POST['gelar_depan'],
                                'gelar_belakang' => $_POST['gelar_belakang'],
                                'prodi_id' => $_POST['prodi_id'],
                                'jenis_kelamin' => $_POST['jenis_kelamin'],
                                'tempat_lahir' => $_POST['tempat_lahir'],
                                'tanggal_lahir' => $_POST['tanggal_lahir'],
                                'alamat' => $_POST['alamat'],
                                'email' => $_POST['email'],
                                'tahun_masuk' => $_POST['tahun_masuk'],
                            ];
                            $dosen->update($_POST['id'], $data);
                            echo '<script>alert("update berhasil")</script><meta http-equiv="refresh" content="0; url=?url=dosen">';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

