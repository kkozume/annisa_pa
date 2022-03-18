<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
       
        <h1 class="h2">Jurnal Umum</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

      <canvas class="my-4 w-100" id="myChart" width="900" height="380" hidden></canvas>

     

      <div class="row">
              <div class="col">
                  <div class="card">
                    <div class="card-body">
                        
                        <div class="text-center"><b>Jurnal Umum</b></div>
                        <div class="text-center">Periode <b><?=getNamaBulanIndo($bulan);?> <?=$tahun;?></b></div>
                    </div>
                  </div>
              </div>
            </div> 
      <p>

      <div class="table-responsive">
        <table class="table table-bordered" table-sm">
          <thead>
            <tr class="table-secondary"> 
              <th>#Id</th>
              <th>Tanggal</th>
              <th>Keterangan</th>
              <th>Ref</th>
              <th>Debet</th>
              <th>Kredit</th>
            </tr>
          </thead>
          <tbody>
                <?php
                    foreach($jurnal as $row):
                        ?>
                            <tr>
                                <td><?= $row->id_transaksi;?></td>
                                <td><?= $row->tgl_jurnal; ?></td>
                                <?php
                                    //kalau debet tidak perlu pakai spasi
                                    if($row->posisi_d_c=='d'){
                                        ?>
                                            <td><?= $row->nama_akun;?></td>
                                        <?php
                                    }else{
                                        ?>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<?= $row->nama_akun;?></td>
                                        <?php
                                    }
                                ?>
                                
                                <td style="text-align:right"><?= $row->kode_akun;?></td>
                                <?php
                                    //kalau debet tidak perlu pakai spasi
                                    if($row->posisi_d_c=='d'){
                                        ?>
                                            <td style="text-align:right"><?= rupiah($row->nominal);?></td>
                                            <td style="text-align:right">-</td>
                                        <?php
                                    }else{
                                        ?>
                                            <td style="text-align:right">-</td>
                                            <td style="text-align:right"><?= rupiah($row->nominal);?></td>                                            
                                        <?php
                                    }
                                ?>
                            </tr>
                        <?php
                    endforeach;    
                ?>
          </tbody>
        </table>
      </div>

      <p>
           

    </main>
  </div>
</div>


    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			window.print();
		});
	</script>
  </body>
</html>
