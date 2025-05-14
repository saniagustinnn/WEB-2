<?php
require_once 'Config/DB.php'; // Pastikan DB.php ada koneksi $pdo

class BidangIlmu
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Ambil semua data bidang ilmu
    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM bidang_ilmu");
        return $stmt->fetchAll();
    }

    // Ambil satu data bidang ilmu berdasarkan ID (kalau nanti butuh)
    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM bidang_ilmu WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Tambah data bidang ilmu baru
    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO bidang_ilmu (nama, deskripsi) VALUES (?, ?)");
        return $stmt->execute([
            $data['nama'],
            $data['deskripsi']
        ]);
    }

    // Update data bidang ilmu
    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE bidang_ilmu SET nama = ?, deskripsi = ? WHERE id = ?");
        return $stmt->execute([
            $data['nama'],
            $data['deskripsi'],
            $id
        ]);
    }

    // Hapus data bidang ilmu
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM bidang_ilmu WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

// Inisialisasi objek BidangIlmu
$bidangIlmu = new BidangIlmu($pdo);
