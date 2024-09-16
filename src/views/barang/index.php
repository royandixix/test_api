<?php
Message::flash();
?>
<div class="container">
    <div class="header">
        <h2>Data Barang</h2>
    </div>
    <div class="row">
        <div>
            <button onclick="location.href='<?php echo BASEURL . '/barang/insert' ?>'" type="button" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </div>
        <table id="example" class="stripe" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Kadaluwarsa</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($AllBarang as $row) :
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['nama_barang'] ?></td>
                        <td><?php echo $row['jumlah'] ?></td>
                        <td><?php echo $row['harga_satuan'] ?></td>
                        <td><?php echo $row['expire_date'] ?></td>
                        <td>
                            <a href="<?php echo BASEURL . '/barang/edit/' . $row['barang_id']; ?>"><i class="fas fa-edit"></i> Edit</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>