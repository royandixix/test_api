<?php

namespace MyApp\Controllers;

use MyApp\Core\BaseController;
use MyApp\Core\Message;

class AutentikasiController extends BaseController
{
    private $authModel;

    private const MESSAGE = [
        'email' => [
            'required' => 'Email harus diisi',
            'email' => 'Email tidak valid'
        ],
        'password' => [
            'required' => 'Password harus diisi',
            'secure' => 'Password minimal 8 karakter, kombinasi huruf besar, huruf kecil, dan karakter khusus!'
        ]
    ];

    public function __construct()
    {
        $this->authModel = $this->model('MyApp\Models\AutentikasiModel');
    }

    public function register()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data) {
            $response = [
                'status' => '400',
                'error' => '400',
                'message' => 'Bad Request',
                'data' => null
            ];
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($response);
            exit();
        }

        $field = [
            'email' => 'string | required | email | unique : autentikasi, email',
            'password' => 'string | required | secure'
        ];

        [$inputs, $errors] = $this->filter($data, $field, self::MESSAGE);
        if ($errors) {
            $response = [
                'status' => '400',
                'error' => '400',
                'message' => 'Bad Request',
                'data' => $inputs
            ];
            header('HTTP/1.1 400 Bad Request');
            echo json_encode($response);
            exit();
        }

        $proc = $this->authModel->insert($inputs);
        if ($proc->rowCount() > 0) {
            $response = [
                'status' => '201',
                'error' => '201',
                'message' => "Data ditambahkan " . $proc->rowCount() . " baris",
            ];
            header('HTTP/1.1 201 Created');
        } else {
            $response = [
                'status' => '400',
                'error' => '400',
                'message' => 'Data gagal di tambahkan',
                'data' => null
            ];
            header('HTTP/1.1 400 Bad Request');
        }
        echo json_encode($response);
        exit();
    }
}
