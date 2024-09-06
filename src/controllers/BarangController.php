<?php
class BarangController extends BaseController 
{
    public function index()
    {
        $data = [
            "title" => "Barang",
        ];
        $this->view("template/header", $data);
        $this->view("barang/index");
        $this->view("template/footer");
    }

    public function edit($id1 = 0, $id2 = "")
    {
        echo "Hello word Barang Index";
        echo "id1 = $id1, id2 = $id2";
    }
}


