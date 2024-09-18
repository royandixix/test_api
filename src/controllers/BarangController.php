<?php

use MyApp\Core\BaseController;
use MyApp\Core\Message;

class BarangController extends BaseController
{
    private $barangModel;

    public function __construct()
    {
        $this->barangModel = $this->model('BarangModel');
    }

    public function index($id = null)
    {
        try {
            if ($id === null) {
                $data = $this->barangModel->getAll();
                $status = 200;
                $message = 'Data ditemukan';
            } else {
                $data = $this->barangModel->getById($id);
                if ($data) {
                    $status = 200;
                    $message = 'Data ditemukan';
                } else {
                    $status = 404;
                    $message = 'Data tidak ditemukan';
                }
            }

            $response = [
                'status' => $status,
                'error' => null,
                'message' => $message,
                'data' => $data
            ];
        } catch (\Exception $e) {
            $response = [
                'status' => 500,
                'error' => '500',
                'message' => 'Internal Server Error',
                'data' => null
            ];
            $status = 500;
        }

        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($response);
    }


    public function insert()
    {
        $data = json_decode(file_get_contents('php://input'), true);
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
            ],
            'jumlah' => [
                'integer' => 'Jumlah harus diisi!',
            ],
        ];

        [$inputs, $errors] = $this->filter($data, $fields, $message);

        if ($errors) {
            $errorMessages = implode(' ', $errors);
            Message::setFlash('error', 'Gagal!', $errorMessages, $inputs);
            $this->redirect('barang/insert');
        }

        if ($errors) {
            $data = [
                'status' => '400',
                'error' => '400',
                'message' => $errors,
                'data' => $inputs
            ];
            $this->view('template/header');
            header('HTTP/1.0 404 Bad Request');
            echo json_encode($data);
            exit();
        } else {
            $proc = $this->barangModel->insert($inputs);
            if ($proc->rowCount() > 0) {
                $data = [
                    'status' => '201',
                    'error' => null,
                    'message' => "Data di tambahkan" . $proc->rowCount() . "baris",
                    'data' => $inputs
                ];
                $this->view('template/header');
                header('HTTP/1.0 201 OK');
                echo json_encode($data);
            } else {
                $data = [
                    'status' => '500',
                    'error' => '500',
                    'message' => ''
                ];
            }
        }
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
            ],
            'jumlah' => [
                'integer' => 'Jumlah harus diisi!',
            ],
        ];

        [$inputs, $errors] = $this->filter($_POST, $fields, $message);

        if ($errors) {
            $errorMessages = implode(' ', $errors);
            Message::setFlash('error', 'Gagal!', $errorMessages, $inputs);
            $this->redirect('barang/insert');
        }

        // Mengonversi harga_satuan untuk memastikan format yang benar
        $inputs['harga_satuan'] = str_replace(',', '.', $inputs['harga_satuan']);

        if ($inputs['kadaluarsa'] == "") {
            $inputs['kadaluarsa'] = "0000-00-00";
        }

        $proc = $this->barangModel->insert($inputs);
        if ($proc) {
            Message::setFlash('success', 'Berhasil!', 'Barang berhasil ditambahkan.');
            $this->redirect('barang');
        }
    }


    public function edit($id = null)
    {
        $data = json_decode(file_get_contents('php://input'), true);
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
            ],
            'jumlah' => [
                'integer' => 'Jumlah harus diisi!',
            ],
        ];

        [$inputs, $errors] = $this->filter($data, $fields, $message);

        if ($errors) {
            $errorMessages = implode(' ', $errors);
            Message::setFlash('error', 'Gagal!', $errorMessages, $inputs);
            $this->redirect('barang/insert');
        }

        if ($errors) {
            $data = [
                'status' => '400',
                'error' => '400',
                'message' => $errors,
                'data' => $inputs
            ];
            $this->view('template/header');
            header('HTTP/1.0 404 Bad Request');
            echo json_encode($data);
            exit();
        } else {
        }
    }

    public function edit_barang()
    {
        $fields = [
            'nama_barang' => 'string|required|alphanumeric',
            'jumlah' => 'int|required',
            'harga_satuan' => 'float|required',
            'kadaluarsa' => 'date',
            'mode' => 'string',
            'id' => 'int',
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
            // $this->redirect('barang/edit/.$inputs');
            $this->redirect('barang/edit' . $inputs['id']);
        }

        if ($inputs['kadaluarsa'] == "") {
            $inputs['kadaluarsa'] = "0000-00-00";
        }

        if ($inputs['mode'] ==    'update') {
            $proc = $this->barangModel->update($inputs);
            if ($proc) {
                Message::setFlash('success', 'Berhasil !', ', Barang berhasil di ubah');
                $this->redirect('barang');
            } else {
                $proc = $this->barangModel->delete($inputs['id']);
                if ($proc) {
                    Message::setFlash('success', ' Berhasil', 'Barang berhasil di hapus');
                    $this->redirect('barang');
                }
            }
        }
    }
    public function delete($id = null) {
        if ($id === null) {  
            $data = [
                'status' => '404',
                'error' => '404',
                'message' => 'Data tidak ditemukan',
                'data' => null
            ];
            header('HTTP/1.0 404 Not Found');
            echo json_encode($data);
            exit();
        } else {
            $proc = $this->barangModel->delete($id);
            $data = [
                'status' => '200',
                'error' => null,
                'message' => 'Data berhasil dihapus',
                'data' => [
                    'barang_id' => $id
                ]
            ];
            header('HTTP/1.0 200 OK');
            echo json_encode($data);
            exit();
        }
    }
    
}
