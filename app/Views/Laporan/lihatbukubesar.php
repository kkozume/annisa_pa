<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     
        <h1 class="h2">Buku Besar</h1>
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
                       
                        <div class="text-center"><b>Buku Besar <?=$nama_akun;?></b></div>
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
              <th colspan="3"><?=$nama_akun?></th>
              <th colspan="4" style="text-align:right"><?=$kode_akun?></th>
            </tr>
            <tr class="table-secondary"> 
              <th rowspan="2" >Tanggal</th>
              <th rowspan="2" >Keterangan</th>
              <th rowspan="2" style="text-align:center">Ref</th>
              <th rowspan="2" style="text-align:center">Debet</th>
              <th rowspan="2" style="text-align:center">Kredit</th>
              <th colspan="2" style="text-align:center">Saldo</th>
            </tr>
            <tr class="table-secondary"> 
              <th style="text-align:center">Debet</th>
              <th style="text-align:center">Kredit</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                    $waktu = $tahun."-".$bulan."-01"; //tgl 1 di awal bulan untuk saldo awal
                    $db = 0; $kr = 0;
                ?>
                <td><?=$waktu?></td>
                <td style='background-color: #eee'>Saldo Awal</td>
                <td style="text-align:right">-</td>
                <?php
                    if(strcmp($PosisiSaldoNormal,'d')==0){
                        echo "<td style='text-align:right'>-</td>";
                        echo "<td style='text-align:right'>-</td>";
                        echo "<td style='text-align:right;background-color: #eee'>".rupiah($SaldoAwal)."</td>";
                        echo "<td style='text-align:right'>-</td>";
                        $saldo_debet = $SaldoAwal;
                        $saldo_kredit = 0;
                        
                    }else
                    {
                        echo "<td style='text-align:right'>-</td>";
                        echo "<td style='text-align:right'>-</td>";
                        echo "<td style='text-align:right'>-</td>";
                        echo "<td style='text-align:right;background-color: #eee'>".rupiah($SaldoAwal)."</td>";
                        $saldo_kredit = $SaldoAwal;
                        $saldo_debet = 0;
                    }
		        ?>
            </tr>
            <?php
                    //saldoawal
                    foreach($bukubesar as $row):
                        ?>
                             <tr> 
                                <td><?=$row->tgl_jurnal?></td>
                                <td><?=$row->nama_akun?></td>
                                <td style="text-align:right"><?=$row->kode_akun?></td>
                                <?php
                                    if($row->posisi_d_c=='d'){
                                            $db = $db +$row->nominal;
                                        ?>
                                            <td style="text-align:right"><?=rupiah($row->nominal)?></td>
                                            <td style="text-align:right">-</td>
                                        <?php
                                            //jika posisi saldo normal ada di debet, maka di tambah dan ditampilkan ke posisi debet
                                            if($PosisiSaldoNormal=='d'){
                                                $saldo_debet = $saldo_debet + $row->nominal;
                                                echo "<td style='text-align:right'>".rupiah($saldo_debet)."</td>";
                                                echo "<td style='text-align:right'>".rupiah($saldo_kredit)."</td>";
                                            }
                                            else{
                                              $saldo_kredit = $saldo_kredit - $row->nominal;
                                              echo "<td style='text-align:right'>".rupiah($saldo_debet)."</td>";
                                              echo "<td style='text-align:right'>".rupiah($saldo_kredit)."</td>";
                                             
                                             
                                            }
                                    }else{
                                            $kr = $kr+$row->nominal;
                                        ?>
                                            <td style="text-align:right">-</td>
                                            <td style="text-align:right"><?=rupiah($row->nominal)?></td>
                                        <?php
                                            if($PosisiSaldoNormal=='d'){
                                              $saldo_debet = $saldo_debet - $row->nominal;
                                              echo "<td style='text-align:right'>".rupiah($saldo_debet)."</td>";
                                              echo "<td style='text-align:right'>".rupiah($saldo_kredit)."</td>";  
                                            }
                                            else{
                                              $saldo_kredit = $saldo_kredit + $row->nominal;
                                              echo "<td style='text-align:right'>".rupiah($saldo_debet)."</td>";
                                              echo "<td style='text-align:right'>".rupiah($saldo_kredit)."</td>";
                                            }
                                    }
                                ?>
                            </tr>
                        <?php
                    endforeach;
            ?>       
            <tr>
                <td colspan="3" style='background-color: #eee'><b>Total</b></td>
                <td style='text-align:right;background-color: #eee'><b><?=rupiah($db)?></b></td>
                <td style='text-align:right;background-color: #eee'><b><?=rupiah($kr)?></b></td>
                <td style='text-align:right;background-color: #eee'><b><?=rupiah($saldo_debet)?></b></td>
                <td style='text-align:right;background-color: #eee'><b><?=rupiah($saldo_kredit)?></b></td>
                
            </tr>     
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
