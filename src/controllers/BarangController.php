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
        'nama_barang' => 'required|string|alphanumeric', // Fixed rule name
        'jumlah' => 'required|integer',
        'harga_satuan' => 'required|numeric',
        'kadaluarsa' => 'nullable|string',  // Assuming kadaluarsa is optional
    ];

    $message = [
        'nama_barang' => [
            'required' => 'Nama Barang harus diisi!',
            'alphanumeric' => 'Masukan huruf dan angka', // Corrected rule name
            'between' => 'Nama Barang harus di antara 3 dan 25 karakter',
        ],
        'jumlah' => [
            'required' => 'Jumlah harus diisi',
        ],
        'harga_satuan' => [
            'required' => 'Harga Satuan harus diisi!',
        ],
    ];

    [$inputs, $errors] = $this->filter($_POST, $fields, $message);

    echo '<pre>';
    var_dump($inputs);
    echo '</pre>';

    if (!empty($errors)) {
        echo '<pre>';
        var_dump($errors);
        echo '</pre>';
    }
}

}
