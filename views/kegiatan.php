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
                                    <label for="nama">Jenis Kegiatan</label>
                                    <select name="jenis_kegiatan_id" class="form-control" required>
                                        <option value="">-- Pilih Jenis Kegiatan --</option>
                                        <?php
                                        require_once("Controllers/JenisKegiatan.php");
                                        $datajeniskegiatan = $jeniskegiatan->index();
                                        foreach ($datajeniskegiatan as $item):
                                        ?>
                                            <option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tempat">Tempat</label>
                                    <input type="text" name="tempat" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_mulai">Tanggal Mulai</label>
                                    <input type="date" name="tanggal_mulai" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_selesai">Tanggal Selesai</label>
                                    <input type="date" name="tanggal_selesai" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control" required>
                                </div>
                                <input type="hidden" name="type" value="tambah">
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
                        <th>Jenis Kegiatan</th>
                        <th>Tempat</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once("Controllers/Kegiatan.php");
                    $row = $kegiatan->index();
                    $nomor = 1;
                    foreach ($row as $item):
                    ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <td><?= $item['nama_jenis_kegiatan'] ?></td>
                            <td><?= $item['tempat'] ?></td>
                            <td><?= $item['tanggal_mulai'] ?></td>
                            <td><?= $item['tanggal_selesai'] ?></td>
                            <td><?= $item['deskripsi'] ?></td>
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
                                                <label for="nama">Jenis Kegiatan</label>
                                                <select name="jenis_kegiatan_id" class="form-control" required>
                                                    <option value="">-- Pilih Jenis Kegiatan --</option>
                                                    <?php
                                                    require_once("Controllers/JenisKegiatan.php");
                                                    $datajeniskegiatan = $jeniskegiatan->index();
                                                    foreach ($datajeniskegiatan as $jk):
                                                    ?>
                                                        <option 
                                                            value="<?= $jk['id'] ?>" 
                                                            <?= ($item['nama_jenis_kegiatan'] == $jk['nama']) ? 'selected' : '' ?>>
                                                            <?= $jk['nama'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="tempat">Tempat</label>
                                                <input type="text" name="tempat" class="form-control" value="<?= $item['tempat'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                                <input type="date" name="tanggal_mulai" class="form-control" value="<?= $item['tanggal_mulai'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                                <input type="date" name="tanggal_selesai" class="form-control" value="<?= $item['tanggal_selesai'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="deskripsi">Deskripsi</label>
                                                <input type="text" name="deskripsi" class="form-control" value="<?= $item['deskripsi'] ?>" required>
                                            </div>
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            <input type="hidden" name="type" value="update">
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
                            $kegiatan->delete($_POST['id']);
                            echo '<script>alert("hapus berhasil")</script><meta http-equiv="refresh" content="0; url=?url=kegiatan">';
                        } elseif ($_POST['type'] == "tambah") {
                            $data = [
                                'tanggal_mulai' => $_POST['tanggal_mulai'],
                                'tanggal_selesai' => $_POST['tanggal_selesai'],
                                'tempat' => $_POST['tempat'],
                                'deskripsi' => $_POST['deskripsi'],
                                'jenis_kegiatan_id' => $_POST['jenis_kegiatan_id'],
                            ];
                            $kegiatan->create($data);
                            echo '<script>alert("tambah berhasil")</script><meta http-equiv="refresh" content="0; url=?url=kegiatan">';
                        } elseif ($_POST['type'] == "update") {
                            $data = [
                                'tanggal_mulai' => $_POST['tanggal_mulai'],
                                'tanggal_selesai' => $_POST['tanggal_selesai'],
                                'tempat' => $_POST['tempat'],
                                'deskripsi' => $_POST['deskripsi'],
                                'jenis_kegiatan_id' => $_POST['jenis_kegiatan_id'],
                            ];
                            $kegiatan->update($_POST['id'], $data);
                            echo '<script>alert("update berhasil")</script><meta http-equiv="refresh" content="0; url=?url=kegiatan">';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

