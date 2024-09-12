<?php
class BarangModel extends Database {
    public function __construct(){
        parent::__construct();
    }

    public function getALL(){
        $query = "SELECT * FROM barang";
        return $this->qry($query)->fetchAll();
    }

    public function insert_barang(){
        var_dump($_POST );
    }
}
?>
