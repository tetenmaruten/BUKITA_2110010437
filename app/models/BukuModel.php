<?php
class bukuModel
{
    private $table = 'buku';
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllbuku()
    {
        $this->db->query("SELECT buku.*, kategori.nama_kategori FROM " . $this->table . " LEFT JOIN kategori ON
            kategori.id = buku.kategori_id");
        return $this->db->resultSet();
    }
    public function getbukuById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function tambahbuku($data)
    {
        $query = "INSERT INTO buku (judul, penerbit, pengarang, tahun, kategori_id, harga) VALUES (:judul, :penerbit,
            :pengarang, :tahun, :kategori_id, :harga)";
        $this->db->query($query);
        $this->db->bind('judul', $data['judul']);
        $this->db->bind('penerbit', $data['penerbit']);
        $this->db->bind('pengarang', $data['pengarang']);
        $this->db->bind('tahun', $data['tahun']);
        $this->db->bind('kategori_id', $data['kategori_id']);
        $this->db->bind('harga', $data['harga']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function updateDatabuku($data)
    {
        $query = "UPDATE buku SET judul=:judul, penerbit=:penerbit, pengarang=:pengarang, tahun=:tahun, 
            kategori_id=:kategori_id, harga=:harga WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('judul', $data['judul']);
        $this->db->bind('penerbit', $data['penerbit']);
        $this->db->bind('pengarang', $data['pengarang']);
        $this->db->bind('tahun', $data['tahun']);
        $this->db->bind('kategori_id', $data['kategori_id']);
        $this->db->bind('harga', $data['harga']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function deletebuku($id)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function caribuku()
    {
        $key = $_POST['key'];
        $this->db->query("SELECT buku.*, kategori.nama_kategori FROM " . $this->table . " LEFT JOIN kategori ON
            kategori.id = buku.kategori_id WHERE judul LIKE :key");
        $this->db->bind('key', "%$key%");
        return $this->db->resultSet();
    }
}
