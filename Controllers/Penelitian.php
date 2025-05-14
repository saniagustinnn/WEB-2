<?php
require_once 'Config/DB.php';

class Penelitian
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index() {
        $stmt = $this->pdo->query("
SELECT penelitian.*, bidang_ilmu.nama AS nama_bidang_ilmu 
FROM penelitian 
JOIN bidang_ilmu ON penelitian.bidang_ilmu_id = bidang_ilmu.id
");
        return $stmt->fetchAll();
    }

    public function show($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM penelitian WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO penelitian (judul, mulai, akhir, tahun_ajaran, bidang_ilmu_id) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['judul'],
            $data['mulai'],
            $data['akhir'],
            $data['tahun_ajaran'],
            $data['bidang_ilmu_id']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE penelitian SET judul = ?, mulai = ?, akhir = ?, tahun_ajaran = ?, bidang_ilmu_id = ? WHERE id = ?");
        return $stmt->execute([
            $data['judul'],
            $data['mulai'],
            $data['akhir'],
            $data['tahun_ajaran'],
            $data['bidang_ilmu_id'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM penelitian WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

$penelitian = new Penelitian($pdo);
