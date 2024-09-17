<?php
use MyApp\Core\Database;
class BarangModel extends Database
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('barang');
        $this->setColumn([
            'barang_id',
            'nama_barang',
            'jumlah',
            'harga_satuan',
            'expire_date',
        ]);
    }

    public function getALL()
    {
        // $query ="SELECT * FROM barang";
        // return $this->qry($query)->fetcAll();

        // Mengambil semua data dari tabel barang
        return $this->get()->fetchAll();
    }

    // Metode insert, update, delete, dan lainnya tetap sama



    public function insert($data)
    {
        // $query = "INSERT INTO barang (nama_barang, jumlah, harga_satuan, expire_date) VALUES (?, ?, ?, ?)";
        // return $this->qry($query, [
        //     $data['nama_barang'],
        //     $data['jumlah'],
        //     $data['harga_satuan'],
        //     $data['kadaluarsa']
        // ]);
        $table = [
            'nama_barang' => $data['nama_barang'],
            'jumlah' => $data['jumlah'],
            'harga_satuan' => $data['harga_satuan'],
            'expire_date' => $data['kadaluarsa']
        ];
        return $this->insertData($table);
    }

    public function getById($id)
    {
        // $query = 'SELECT * FROM barang WHERE barang_id = ?';
        // return $this->qry($query, [$id])->fetch();
        // return $this->get(['barang_id' => $id])->fetch();
        return $this->get(['barang_id' => $id])->fetch();
    }
    public function update($data)
    {
        // $query = "UPDATE barang SET nama_barang = ?, jumlah = ?, harga_satuan = ?, expire_date = ? WHERE barang_id = ?";
        // return $this->qry($query, [
        //     $data['nama_barang'],
        //     $data['jumlah'],
        //     $data['harga_satuan'],
        //     $data['kadaluarsa'],
        //     $data['id']
        // ]);

        $table = [
            'nama_barang' => $data ['nama_barang'],
            'jumlah' => $data['jumlah'],
            'harga_satuan' => $data ['harga_satuan'],
            'expire_date' => $data ['kadaluarsa'],
        ];
        $key = [
            'barang_id' => $data['id']
        ];
        return $this->updateData($table, $key);
    }

    public function delete($id)
    {
        // $query = "DELETE FROM barang WHERE barang_id = ?";
        // return $this->qry($query, [$id]);
        return $this->deleteData(['barang_id' => $id]);
    }
}