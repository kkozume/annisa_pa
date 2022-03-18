<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Laba Rugi</h1>
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
                        <div class="text-center"><b>Laporan Laba Rugi</b></div>
                        <div class="text-center">Periode <b><?=getNamaBulanIndo($bulan);?> <?=$tahun;?></b></div>
                    </div>
                  </div>
              </div>
            </div> 
      <p>

      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr> 
              <th colspan="7">Penjualan</th>
            </tr>
          </thead>
          <tbody>  
            <?php
                $total = 0;
                $harga =0;
            ?>
             <?php
                    foreach($penjualan as $row):
                      ?>
            <tr> 
              <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Penjualan</td>
              <td style='text-align:right'><?=rupiah($harga);?></td> <?php $harga = $harga + $row->harga; ?>
            </tr>
            <?php
                    endforeach;    
                ?>
            </tbody>

          <thead>
            <tr> 
              <th colspan="7">Harga Pokok Penjualan</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Harga Pokok Penjualan</td>
            <td style='text-align:right'><?=rupiah($total);?></td>
            </tr>    
            <tr>
              <td colspan="7"><br></td>
            </tr>
            <tr> 
              <th colspan="7">Beban</th>
            </tr>
            <?php
              //looping untuk beban
              foreach($pembebanan as $row):
                //jika panjang = 2 maka beri tab 1 x
                if(strlen($row->kode_akun)==2){
                        //kode 51
                        $i=0;
                  ?>
                    <tr> 
                        <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;<?=$row->nama_akun?></td>
                        <td></td>
                        <td style='text-align:right'>(<?=rupiah($row->total);?>)</td> <?php $total = $total - $row->total; ?>
                        <td></td>
                    </tr>
                  <?php
                        //cari kodenya yang memenuhi kriteria kepala atasnya 51 cth 511
                        foreach($pembebanan as $row2):
                            if( (substr($row2->kode_akun,0,2)==substr($row->kode_akun,0,2)) and (strlen($row2->kode_akun)>2)){
                                $i++;
                              ?>
                                <tr> 
                                    <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row2->nama_akun?></td>
                                    <td></td>
                                    <td style='text-align:right'><?=rupiah(0);?></td> <?php $total = $total - 0; ?>
                                    <td></td>
                                </tr>
                              <?php
                            }
                            if( ($i==0) and (strlen($row2->kode_akun)>2) ){
                              //tampilkan jumlahnya
                              ?>
                                <tr> 
                                    <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total</td>
                                    <td></td>
                                    <td style='text-align:right'><?=rupiah(0);?></td> <?php $total = $total - 0; ?>
                                    <td></td>
                                </tr>
                              <?php
                            }
                        endforeach; 
                }
              endforeach;
            ?>
            <tr>
              <td colspan="7"><br></td>
            </tr>
            <tr>
              <th colspan="4">Total</th>
              <th></th>
              <th></th>
              <th style='text-align:right'>
                <?=rupiah($total);?>
              </th>
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
  </body>
</html>
