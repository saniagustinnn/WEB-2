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
                                    <label for="judul">Judul Penelitian</label>
                                    <input type="text" name="judul" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="mulai">Tanggal Mulai</label>
                                    <input type="date" name="mulai" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="akhir">Tanggal Selesai</label>
                                    <input type="date" name="akhir" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="tahun_ajaran">Tahun Ajaran</label>
                                    <input type="text" name="tahun_ajaran" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="bidang_ilmu_id">Bidang Ilmu</label>
                                    <select name="bidang_ilmu_id" class="form-control" required>
                                        <option value="">-- Pilih Bidang Ilmu --</option>
                                        <?php
                                        require_once("Controllers/BidangIlmu.php");
                                        $bidangIlmuList = $bidangIlmu->index();
                                        foreach ($bidangIlmuList as $bidang):
                                        ?>
                                            <option value="<?= $bidang['id'] ?>"><?= $bidang['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
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
                        <th>Judul Penelitian</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Tahun Ajaran</th>
                        <th>Bidang Ilmu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once("Controllers/Penelitian.php");
                    $row = $penelitian->index();
                    $nomor = 1;
                    foreach ($row as $item):
                    ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <td><?= $item['judul'] ?></td>
                            <td><?= $item['mulai'] ?></td>
                            <td><?= $item['akhir'] ?></td>
                            <td><?= $item['tahun_ajaran'] ?></td>
                            <td><?= $item['bidang_ilmu_id'] ?></td>
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
                                                <label for="judul">Judul Penelitian</label>
                                                <input type="text" name="judul" class="form-control" value="<?= $item['judul'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="mulai">Tanggal Mulai</label>
                                                <input type="date" name="mulai" class="form-control" value="<?= $item['mulai'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="akhir">Tanggal Selesai</label>
                                                <input type="date" name="akhir" class="form-control" value="<?= $item['akhir'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                                <input type="text" name="tahun_ajaran" class="form-control" value="<?= $item['tahun_ajaran'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="bidang_ilmu_id">Bidang Ilmu</label>
                                                <select name="bidang_ilmu_id" class="form-control" required>
                                                    <option value="">-- Pilih Bidang Ilmu --</option>
                                                    <?php
                                                    require_once("Controllers/BidangIlmu.php");
                                                    $bidangIlmuList = $bidangIlmu->index();
                                                    foreach ($bidangIlmuList as $bidang):
                                                    ?>
                                                        <option value="<?= $bidang['id'] ?>" <?= $item['bidang_ilmu_id'] == $bidang['id'] ? 'selected' : '' ?>><?= $bidang['nama'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
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
                            $penelitian->delete($_POST['id']);
                            echo '<script>alert("hapus berhasil")</script><meta http-equiv="refresh" content="0; url=?url=penelitian">';
                        } elseif ($_POST['type'] == "tambah") {
                            $data = [
                                'judul' => $_POST['judul'],
                                'mulai' => $_POST['mulai'],
                                'akhir' => $_POST['akhir'],
                                'tahun_ajaran' => $_POST['tahun_ajaran'],
                                'bidang_ilmu_id' => $_POST['bidang_ilmu_id'],
                            ];
                            $penelitian->create($data);
                            echo '<script>alert("tambah berhasil")</script><meta http-equiv="refresh" content="0; url=?url=penelitian">';
                        } elseif ($_POST['type'] == "update") {
                            $data = [
                                'judul' => $_POST['judul'],
                                'mulai' => $_POST['mulai'],
                                'akhir' => $_POST['akhir'],
                                'tahun_ajaran' => $_POST['tahun_ajaran'],
                                'bidang_ilmu_id' => $_POST['bidang_ilmu_id'],
                            ];
                            $penelitian->update($_POST['id'], $data);
                            echo '<script>alert("update berhasil")</script><meta http-equiv="refresh" content="0; url=?url=penelitian">';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

