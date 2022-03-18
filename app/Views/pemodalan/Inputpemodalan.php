<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Modal</h1>
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
        <?= form_open('pemodalan/setorModal') ?>
              <div class="mb-3">
                    <label for="kode_produk" class="form-label">Kode Produk</label>
                    <select class="form-select" aria-label="Default select example" name="kode_produk">
                        <?php
                            foreach($produk as $row):
                              ?>
                                  <option value="<?=$row['kode_produk']?>"><?=$row['kode_produk']?></option>
                              <?php
                            endforeach;
                        ?>
                    </select>
            
                </div>

                <div class="mb-3">
                    <label for="besar" class="form-label">Besar Modal</label>
                    <?php
                        if(isset($validation)){
                            //untuk mengecek apakah ada error pada elemen field kode_produk
                            if ( $validation->hasError('besar') )
                            { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error: <?=$validation->getError('besar')?> </strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            <?php
                            }
                        }
                    ?>
                    <input type="text" class="form-control" id="besar" name="besar" value="<?= set_value('besar')?>" placeholder="Diisi dengan besar modal yang disetorkan">
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Keterangan</label>
                    <?php
                        if(isset($validation)){
                            //untuk mengecek apakah ada error pada elemen field kode_produk
                            if ( $validation->hasError('nama') )
                            { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error: <?=$validation->getError('nama')?> </strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            <?php
                            }
                        }
                    ?>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama')?>" placeholder="Diisi dengan nama / keterangan modal yang disetorkan">
                </div>
                
                <div class="mb-3">
                    <label for="waktu" class="form-label">Tanggal</label>
                    <?php
                        if(isset($validation)){
                            //untuk mengecek apakah ada error pada elemen field kode_produk
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
                    <input type="date" class="form-control" id="waktu" name="waktu" value="<?= set_value('waktu')?>" placeholder="Diisi dengan waktu">
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
