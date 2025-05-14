<?php
require_once 'Config/DB.php';

class Kegiatan
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index() {
        $stmt = $this->pdo->query("
SELECT kegiatan.*, jenis_kegiatan.nama AS nama_jenis_kegiatan 
FROM kegiatan 
JOIN jenis_kegiatan ON kegiatan.jenis_kegiatan_id = jenis_kegiatan.id
");
        return $stmt->fetchALL();
    }

    public function show($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM kegiatan WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO kegiatan (tanggal_mulai, tanggal_selesai, tempat, deskripsi, jenis_kegiatan_id) VALUES (?,?,?,?,?)");
        return $stmt->execute([
            $data['tanggal_mulai'],
            $data['tanggal_selesai'],
            $data['tempat'],
            $data['deskripsi'],
            $data['jenis_kegiatan_id']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE kegiatan SET tanggal_mulai = ?, tanggal_selesai = ?, tempat = ?, deskripsi = ?, jenis_kegiatan_id = ? WHERE id = ?");
        return $stmt->execute([
            $data['tanggal_mulai'],
            $data['tanggal_selesai'],
            $data['tempat'],
            $data['deskripsi'],
            $data['jenis_kegiatan_id'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM kegiatan WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

$kegiatan = new Kegiatan($pdo);