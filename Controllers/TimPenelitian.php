<?php
require_once 'Config/DB.php';

class TimPenelitian
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index() {
        $stmt = $this->pdo->query("
SELECT tim_penelitian.*, dosen.nama AS nama_dosen, penelitian.judul AS judul_penelitian
FROM tim_penelitian 
JOIN dosen ON tim_penelitian.dosen_id = dosen.id
JOIN penelitian ON tim_penelitian.penelitian_id = penelitian.id
");
        return $stmt->fetchAll();
    }

    public function show($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tim_penelitian WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO tim_penelitian (dosen_id, penelitian_id, peran) VALUES (?, ?, ?)");
        return $stmt->execute([
            $data['dosen_id'],
            $data['penelitian_id'],
            $data['peran']
        ]);
    }

    public function update($dosen_id, $penelitian_id, $data) {
        $stmt = $this->pdo->prepare("UPDATE tim_penelitian SET peran = ? WHERE dosen_id = ? AND penelitian_id = ?");
        return $stmt->execute([
            $data['peran'],
            $dosen_id,
            $penelitian_id
        ]);
    }


    public function delete($dosen_id, $penelitian_id) {
        $stmt = $this->pdo->prepare("DELETE FROM tim_penelitian WHERE dosen_id = ? AND penelitian_id = ?");
        return $stmt->execute([$dosen_id, $penelitian_id]);
    }

}

$tim_penelitian = new TimPenelitian($pdo);
