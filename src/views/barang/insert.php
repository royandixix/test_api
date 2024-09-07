<div class="container">
    <h2 class="header">Input Barang</h2>
    <form action="<?php echo BASEURL . '/barang/insert_barang' ?>" method="post">
        <div class="form-group row">
            <label for="nama_barang" class="col-sm-3 col-form-label">Nama Barang</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="jumlah" name="jumlah" min="0" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="harga_satuan" class="col-sm-3 col-form-label">Harga Satuan</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" step="0.01" min="0" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="expire_date" class="col-sm-3 col-form-label">Tanggal Kadaluarsa</label>
            <div class="col-sm-9">
                <input type="date" class="form-control" id="expire_date" name="expire_date">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-3">&nbsp;</div>
            <div class="col-sm-9 mt-3">
                <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i>&nbsp;Simpan</button>
            </div>
        </div>
    </form>
</div>
