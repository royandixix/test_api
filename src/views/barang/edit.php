<?php
 use MyApp\Core\Message;
    // Mendapatkan data dari Message::getData()
    $data = Message::getData();

    // Memastikan bahwa $data adalah array dan memiliki data yang benar
    if (is_array($data)) {
        $barang = [
            'barang_id' => $data['barang_id'] ?? '',
            'nama_barang' => $data['nama_barang'] ?? '',
            'jumlah' => $data['jumlah'] ?? '',
            'harga_satuan' => $data['harga_satuan'] ?? '',
            'kadaluarsa' => $data['kadaluarsa'] ?? '',
        ];
    } else {
        // Mengatur $barang menjadi array kosong jika $data tidak valid
        $barang = [
            'barang_id' => '',
            'nama_barang' => '',
            'jumlah' => '',
            'harga_satuan' => '',
            'kadaluarsa' => '',
        ];
    }

    Message::flash();
?>

<div class="row">
    <div class="container col-50">
        <div class="header">Input Barang</div>
        <form id="form" action="<?php echo BASEURL . '/barang/edit_barang'; ?>" method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($barang['barang_id']) ?>">
            <input type="hidden" id="mode" name="mode" value="update">
            <div class="row">
                <div class="col-25">
                    <label for="nama_barang">Nama Barang</label>
                </div>
                <div class="col-75">
                    <input type="text" id="nama_barang" name="nama_barang" value="<?= htmlspecialchars($barang['nama_barang']) ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="jumlah">Jumlah</label>
                </div>
                <div class="col-75">
                    <input type="number" id="jumlah" name="jumlah" value="<?= htmlspecialchars($barang['jumlah']) ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="harga_satuan">Harga Satuan</label>
                </div>
                <div class="col-75">
                    <input type="number" id="harga_satuan" name="harga_satuan" value="<?= htmlspecialchars($barang['harga_satuan']) ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="kadaluarsa">Tanggal Kadaluarsa</label>
                </div>
                <div class="col-75">
                    <input type="date" id="kadaluarsa" name="kadaluarsa" value="<?= htmlspecialchars($barang['kadaluarsa']) ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-25">&nbsp;</div>
                <div class="col-75">
                    <button onclick="edit('update')" type="button" class="btn btn-primary">Edit</button>
                    <button onclick="edit('delete')" type="button" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
