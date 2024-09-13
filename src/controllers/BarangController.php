<?php
class BarangController extends BaseController
{
    private $barangModel;

    public function __construct()
    {
        $this->barangModel = $this->model('BarangModel');
    }

    public function index()
    {
        $data = [
            "title" => "Barang",
            "AllBarang" => $this->barangModel->getALL()
        ];
        $this->view("template/header", $data);
        $this->view("barang/index", $data);
        $this->view("template/footer");
    }

    public function insert()
    {
        $data = [
            'title' => 'Barang',
        ];
        $this->view("template/header", $data);
        $this->view("barang/insert");
        $this->view("template/footer");
    }

    public function insert_barang()
    {
        $fields = [
            'nama_barang' => 'string|required|alphanumeric',
            'jumlah' => 'int|required',
            'harga_satuan' => 'float|required',
            'kadaluarsa' => 'date'
        ];

        $message = [
            'nama_barang' => [
                'required' => 'Nama Barang harus diisi!',
                'alphanumeric' => 'Nama Barang harus berisi huruf dan angka',
                'between' => 'Nama Barang harus di antara 3 dan 25 karakter',
            ],


            'harga_satuan' => [
                'required' => 'Harga Satuan harus diisi!',
                // 'numeric' => 'Harga Satuan harus berupa angka',
            ],

            'jumlah' => [
                'integer' => 'Jumlah harus diisi!',
                // 'integer' => 'Jumlah harus berupa angka',
            ],
        ];

        [$inputs, $errors] = $this->filter($_POST, $fields, $message);

        if ($errors) {
            $errorMessages = implode(' ', $errors);
            Message::setFlash('error', 'Gagal!', $errorMessages, $inputs);
            $this->redirect('barang/insert');
        }

        if($inputs['kadaluarsa'] == ""){
            $inputs['kadaluarsa'] = "0000-00-00";
        }

        $proc = $this->barangModel->insert($inputs);
        if ($proc) {
            Message::setFlash('succsess', 'Berhasil !', 'Barang berhasil di tambahkan,');
            $this->redirect('barang');
        }  
    }
}
