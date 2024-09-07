<?php
class Database
{
    private $conn; 

    public function __construct(){
        $this->conn = $this->setConnection();
    }

    protected function setConnection() {
        try {
            // Gantilah nilai berikut dengan konfigurasi yang benar
            $host = "localhost"; // Nama host (localhost jika menggunakan server lokal)
            $user = "root";      // Username database Anda (misalnya, root)
            $pass = "";          // Password database Anda (biarkan kosong jika tidak ada)
            $db = "latihan"; // Nama database Anda
            $port = "3306";      // Port MySQL (default 3306)

            // Membuat koneksi ke database
            $conn = new PDO("mysql:host=$host;dbname=$db;port=$port;", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;

        } catch (PDOException $e) {
            die($e->getMessage()); // Tampilkan pesan error jika gagal
        }
    }

    public function query($query, $params = array()) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }
}
?>
