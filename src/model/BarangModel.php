<?php

class BarangModel extends Database {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $query = "SELECT * FROM barang";
        // $stmt = $this->conn->prepare($query); // Properti conn sudah bisa diakses karena protected
        // $stmt->execute();
        // return $stmt;
        return $this->query($query)->fetchAll();
    }
}



?>