<h2 align= "center">Data Beban UMKM Puri Utami</h2>
 
        <table border=1 align="center">
            <tr>
              <th>#IdBeban</th>
              <th>Nama Beban</th>
              <th>Tanggal Transaksi</th>
              <th>Nominal</th>
            </tr>
                <?php
                    foreach($pembebanan as $row):
                        ?>
                            <tr>
                                <td><?= $row->id_transaksi?></td>
                                <td><?= $row->nama?></td>
                                <td><?= substr($row->waktu,0,10)?></td>
                                <td><?= rupiah($row->biaya)?></td>
                            </tr>
                        <?php
                    endforeach;    
                ?>
        </table>


<!-- Modals -->     

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>


<!-- Bootstrap JS -->
<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
<!-- <script>
    $(document).ready(function() {
      $('#example').DataTable();
    } );
</script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			window.print();
		});
	</script>
  </body>
</html>
