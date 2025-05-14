<?php
require_once 'Config/DB.php';

class JenisKegiatan
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index() {
        $stmt = $this->pdo->query("SELECT * FROM jenis_kegiatan");
        return $stmt->fetchALL();
    }

    public function show($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM jenis_kegiatan WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO jenis_kegiatan (nama) VALUES (?)");
        return $stmt->execute([
            $data['nama']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE jenis_kegiatan SET nama = ? WHERE id=?");
        return $stmt->execute([
            $data['nama'],
            $id 
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM jenis_kegiatan WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

$jeniskegiatan = new JenisKegiatan($pdo);
