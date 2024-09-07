<?php 
class BarangController extends BaseController{

    private $barangModel;
    public function __construct(){
        $this->barangModel = $this->model('BarangModel');
    }
    public function index(){
        $data = [
            'title' => 'Barang',
            'AllBarang' => $this->barangModel->getAll()
        ];  
        $this->view('template/header', $data);
        $this->view('barang/index', $data);
        $this->view('template/footer');
    }

    public function edit($id1 = 0, $id2 = ""){
        echo 'Edit from barang id1 = ' . $id1 . ' dan id2 = ' . $id2;
    }

    public function insert(){
        $data = [
            'title' => 'Barang',
        ];
        $this->view('template/header', $data);
        $this->view('barang/insert', );
        $this->view('template/footer');
    }

}
?>
