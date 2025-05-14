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
                                    <label for="dosen_id">Nama Dosen</label>
                                    <select name="dosen_id" class="form-control" required>
                                        <option value="">-- Pilih Dosen --</option>
                                        <?php
                                        require_once("Controllers/Dosen.php");
                                        $dosen = new Dosen($pdo);
                                        $datadosen = $dosen->index();
                                        foreach ($datadosen as $item) {
                                            echo '<option value="'.$item['id'].'">'.$item['nama'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="penelitian_id">Penelitian</label>
                                    <select name="penelitian_id" class="form-control" required>
                                        <option value="">-- Pilih Penelitian --</option>
                                            <?php
                                            require_once("Controllers/Penelitian.php");
                                            $penelitian = new Penelitian($pdo);
                                            $datapenelitian = $penelitian->index();
                                            foreach ($datapenelitian as $item) {
                                                echo '<option value="'.$item['id'].'">'.$item['judul'].'</option>';
                                            }
                                            ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="peran">Peran</label>
                                    <input type="text" name="peran" class="form-control" required>
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
                        <th>Nama Dosen</th>
                        <th>Penelitian</th>
                        <th>Peran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once("Controllers/TimPenelitian.php");
                    $row = $tim_penelitian->index();
                    $nomor = 1;
                    foreach ($row as $item):
                    ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <td><?= $item['nama_dosen'] ?></td>
                            <td><?= $item['judul_penelitian'] ?></td>
                            <td><?= $item['peran'] ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="dosen_id" value="<?= $item['dosen_id'] ?>">
<input type="hidden" name="penelitian_id" value="<?= $item['penelitian_id'] ?>">
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
                                            <label for="dosen_id">Nama Dosen</label>
                                            <select name="dosen_id" class="form-control" required>
                                                <option value="">-- Pilih Dosen --</option>
                                                <?php
                                                require_once("Controllers/Dosen.php");
                                                $dosen = new Dosen($pdo);
                                                $datadosen = $dosen->index();
                                                foreach ($datadosen as $itemdosen) {
                                                    echo '<option value="'.$itemdosen['id'].'" '.($item['dosen_id'] == $itemdosen['id'] ? 'selected' : '').'>'.$itemdosen['nama'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="penelitian_id">Penelitian</label>
                                            <select name="penelitian_id" class="form-control" required>
                                                <option value="">-- Pilih Penelitian --</option>
                                                <?php
                                                require_once("Controllers/Penelitian.php");
                                                $penelitian = new Penelitian($pdo);
                                                $datapenelitian = $penelitian->index();
                                                foreach ($datapenelitian as $itempenelitian) {
                                                    echo '<option value="'.$itempenelitian['id'].'" '.($item['penelitian_id'] == $itempenelitian['id'] ? 'selected' : '').'>'.$itempenelitian['judul'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="peran">Peran</label>
                                            <input type="text" name="peran" class="form-control" value="<?= $item['peran'] ?>" required>
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
                            $tim_penelitian->delete($_POST['dosen_id'], $_POST['penelitian_id']);
                            echo '<script>alert("hapus berhasil")</script><meta http-equiv="refresh" content="0; url=?url=timpenelitian">';
                        } elseif ($_POST['type'] == "tambah") {
                            $data = [
                                'dosen_id' => $_POST['dosen_id'],
                                'penelitian_id' => $_POST['penelitian_id'],
                                'peran' => $_POST['peran'],
                            ];
                            $tim_penelitian->create($data);
                            echo '<script>alert("tambah berhasil")</script><meta http-equiv="refresh" content="0; url=?url=timpenelitian">';
                        } elseif ($_POST['type'] == "update") {
                            $data = [
                                'dosen_id' => $_POST['dosen_id'],
                                'penelitian_id' => $_POST['penelitian_id'],
                                'peran' => $_POST['peran'],
                            ];
                            $tim_penelitian->update($_POST['dosen_id'], $_POST['penelitian_id'], [
                                'peran' => $_POST['peran']
                            ]);
                            echo '<script>alert("update berhasil")</script><meta http-equiv="refresh" content="0; url=?url=timpenelitian">';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

