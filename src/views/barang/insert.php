<div class="row">
    <div class="container col-50">
        <div class="header">Input Barang</div>

        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="errors">
                <ul>
                    <?php foreach ($errors as $field => $field_errors): ?>
                        <?php foreach ($field_errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo BASEURL . '/barang/insert_barang'?>" method="post">
            <div class="row">
                <div class="col-25">
                    <label for="nama_barang">Nama Barang</label>
                </div>
                <div class="col-50">
                    <input type="text" id="nama_barang" name="nama_barang" value="<?php echo htmlspecialchars($_POST['nama_barang'] ?? ''); ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="jumlah">Jumlah</label>
                </div>
                <div class="col-50">
                    <input type="number" id="jumlah" name="jumlah" value="<?php echo htmlspecialchars($_POST['jumlah'] ?? ''); ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="harga_satuan">Harga Satuan</label>
                </div>
                <div class="col-50">
                    <input type="number" id="harga_satuan" name="harga_satuan" value="<?php echo htmlspecialchars($_POST['harga_satuan'] ?? ''); ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="kadaluarsa">Tanggal Kadaluarsa</label>
                </div>
                <div class="col-50">
                    <input type="date" id="kadaluarsa" name="kadaluarsa" value="<?php echo htmlspecialchars($_POST['kadaluarsa'] ?? ''); ?>">
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
