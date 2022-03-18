<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Pembelian</h1>
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
        <?= form_open('pembelian') ?>
              <div class="mb-3">
                    <label for="id_supplier" class="form-label">Supplier</label>
                    <select class="form-select" aria-label="Default select example" name="id_supplier">
                        <?php
                            foreach($supplier as $row):
                                $id_supplier=$row['id_supplier'];
                                // $nama_suplier=$row['nama_suplier'];
                              ?>
                                  <option value="<?=$id_supplier?>"><?=$id_supplier?></option>
                              <?php
                            endforeach;
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kode_pembelian" class="form-label">Kode Pembelian</label>
                    <?php
                        if(isset($validation)){
                            //untuk mengecek apakah ada error pada elemen field namakosan
                            if ( $validation->hasError('kode_pembelian') )
                            { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error: <?=$validation->getError('kode_pembelian')?> </strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            <?php
                            }
                        }
                    ?>
                    <input type="text" class="form-control" id="kode_pembelian" name="kode_pembelian" value="<?= set_value('kode_pembelian')?>" placeholder="Diisi dengan kode pembelian">
                </div>

                <div class="mb-3">
                    <label for="tgl_pembelian" class="form-label">Tgl Pembelian</label>
                    <?php
                        if(isset($validation)){
                            //untuk mengecek apakah ada error pada elemen field namakosan
                            if ( $validation->hasError('tgl_pembelian') )
                            { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error: <?=$validation->getError('tgl_pembelian')?> </strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            <?php
                            }
                        }
                    ?>
                    <input type="date" class="form-control" id="tgl_pembelian" name="tgl_pembelian" value="<?= set_value('tgl_pembelian')?>" placeholder="Diisi dengan tgl">
                </div>

                
                <div class="mb-3">
                    <label for="nama_pembelian" class="form-label">Nama Pembelian</label>
                    <?php
                        if(isset($validation)){
                            //untuk mengecek apakah ada error pada elemen field namakosan
                            if ( $validation->hasError('nama_pembelian') )
                            { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error: <?=$validation->getError('nama_pembelian')?> </strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            <?php
                            }
                        }
                    ?>
                    <input type="text" class="form-control" id="nama_pembelian" name="nama_pembelian" value="<?= set_value('nama_pembelian')?>" placeholder="Diisi dengan nama pembelian">
                </div>

                
                
                <div class="mb-3">
                    <label for="jumlah_pembelian" class="form-label">jumlah_pembelian</label>
                    <?php
                        if(isset($validation)){
                            //untuk mengecek apakah ada error pada elemen field namakosan
                            if ( $validation->hasError('jumlah_pembelian') )
                            { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error: <?=$validation->getError('jumlah_pembelian')?> </strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            <?php
                            }
                        }
                    ?>
                    <input type="text" class="form-control" id="jumlah_pembelian" name="jumlah_pembelian" value="<?= set_value('jumlah_pembelian')?>" placeholder="Diisi dengan jumlah pembelian">
                </div>

                <div class="mb-3">
                    <label for="total_pembelian" class="form-label"> Total Pembelian</label>
                    <?php
                        if(isset($validation)){
                            //untuk mengecek apakah ada error pada elemen field namakosan
                            if ( $validation->hasError('total_pembelian') )
                            { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error: <?=$validation->getError('total_pembelian')?> </strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            <?php
                            }
                        }
                    ?>
                    <input type="text" class="form-control" id="total_pembelian" name="total_pembelian" value="<?= set_value('total_pembelian')?>" placeholder="Diisi dengan total pembelian">
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
			$('#total_pembelian').mask('0,000,000,000,000,000,000,000', {reverse: true});			
			
		})
	 </script> 
  
  </body>
</html>
