<div class="container">
    <div class="header">
        <h2>Data Barang</h2>
    </div>
    <div class="row">
        <div>
            <button onclick="location.href='<?php echo BASEURL . '/barang/insert'; ?>'" type="button" class="btn btn-primary">
                <i class="fas fa-plus"></i>&nbsp;Tambah
            </button>

        </div>
        <table id="example" class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Kadaluarsa</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($AllBarang as $row) :
                ?>
                    <tr>
                        <!-- <td><?php echo $no++; ?></td> -->

                        <td><?php echo $row['nama_barang'] ?></td>
                        <td><?php echo $row['jumlah'] ?></td>
                        <td><?php echo $row['harga_satuan'] ?></td>
                        <td><?php echo $row['expire_date'] ?></td>
                        <td><?php echo $row['tanggal_dibuat'] ?></td>
                        <td>
                            <a href="Edit"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>