    <?php

    use MyApp\Core\Message;

    $data = Message::getData();
    $namaBarang = "";
    $jumlah = "";
    $harga = "";
    $kadaluarsa = "";

    if ($data) {
        $namaBarang = $data['nama_barang'];
        $jumlah = $data['jumlah'];
        $harga = $data['harga_satuan'];
        $kadaluarsa = $data['kadaluarsa'];
    }

    Message::flash();
    ?>

    <div class="row">
        <div class="container col-50">
            <div class="header">Input Barang</div>
            <form action="<?php echo BASEURL . '/barang/insert_barang'; ?>" method="post">
                <div class="row">
                    <div class="col-25">
                        <label for="nama_barang">Nama Barang</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="nama_barang" name="nama_barang" value="<?php echo $namaBarang; ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="jumlah">Jumlah</label>
                    </div>
                    <div class="col-75">
                        <input type="number" id="jumlah" name="jumlah" value="<?php echo $jumlah; ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="harga_satuan">Harga Satuan</label>
                    </div>
                    <div class="col-75">
                        <input type="number" id="harga_satuan" name="harga_satuan" value="<?php echo htmlspecialchars($harga); ?>" step="0.01">
                    </div>
                </div>


                <div class="row">
                    <div class="col-25">
                        <label for="kadaluarsa">Tanggal Kadaluarsa</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="kadaluarsa" name="kadaluarsa" value="<?php echo $kadaluarsa; ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">&nbsp;</div>
                    <div class="col-75">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>

        </div>
    </div>