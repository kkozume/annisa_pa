<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Pembayaran Gaji</h1>
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

      <?php
        if(isset($validation)){
          echo $validation->listErrors();
        }
      ?>
        <div class="row">
        <?= form_open('Pembayaran') ?>
               <div class="mb-3">
                    <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                    <select class="form-select" aria-label="Default select example" name="nama_karyawan">
                        <?php
                            foreach($karyawan as $row):
                              ?>
                                  <option value="<?=$row['nama_karyawan']?>"><?=$row['nama_karyawan']?></option>
                              <?php
                            endforeach;
                        ?>
                    </select>
            
                </div> 

                <div class="mb-3">
                    <label for="waktu" class="form-label">Tanggal</label>
                    <?php
                        if(isset($validation)){
                            //untuk mengecek apakah ada error pada elemen field namakosan
                            if ( $validation->hasError('waktu') )
                            { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error: <?=$validation->getError('waktu')?> </strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            <?php
                            }
                        }
                    ?>
                    <input type="date" class="form-control" id="waktu" name="waktu" value="<?= set_value('waktu')?>" placeholder="Diisi dengan tanggal disetorkannya gaji">
                </div>

                <div class="mb-3">
                    <label for="kehadiran" class="form-label">Posisi</label>
                    <select class="form-select" name="kehadiran" id="kehadiran">
                    <option value="Kasir">Kasir</option>
                    <option value="Penjahit">Penjahit</option>
                    <option value="Kurir">Kurir</option>
                    <option value="Packing">Packing</option>
                    <option value="Penjahit 2 ">Penjahit 2</option>
                    
                    </select>
                </div>

                <div class="mb-3">
                    <label for="gaji" class="form-label">Gaji</label>
                    <select class="form-select" name="gaji" id="gaji">
                    <option value="2700000">Kasir</option>
                    <option value="3200000">Penjahit </option>
                    <option value="2500000">Kurir</option>
                    <option value="2450000">Packing</option>
                    <option value="3200000">Penjahit 2 </option>
                    
                    </select>
                </div>

                
                

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

     
    </main>
  </div>
</div>

    <!-- Bootstrap JS -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
  
    <script>
		$(document).ready(function(){
			// Format mata uang.
			$('#besar').mask('0,000,000,000,000,000,000,000', {reverse: true});			
			
		})
	 </script> 
      


  </body>
</html>
