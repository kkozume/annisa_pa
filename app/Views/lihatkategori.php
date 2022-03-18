<h1 align="center"> Data Kategori </h1>
    <table border=1 align="center">
        <tr>
            <td>Kode Kategori</td>
            <td>Nama Kategori</td>
        </tr>
<?php
            foreach($umkm_puri_utami as $row):
                ?>
                    <tr>
                        <td><?= $row['kode_kategori'];?></td>
                        <td><?= $row['nama_kategori'];?></td>
                    </tr>
                <?php
            endforeach;    
        ?>
    </table>