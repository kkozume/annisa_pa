<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Penjualan Produk</h1>
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
        <?= form_open('Penjualan') ?>
                <div class="mb-3">
                    <label for="waktu" class="form-label">Tanggal</label>
                    <?php
                        if(isset($validation)){
                            //untuk mengecek apakah ada error pada elemen field nama_produk
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
                
               <div class="mb-3">
                    <label for="kode_produk" class="form-label">Kode Produk</label>
                    <select class="form-select" aria-label="Default select example" name="id">
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
                    <label for="nama_produk" class="form-label">Produk</label>
                    <?php
                        if(isset($validation)){
                            //untuk mengecek apakah ada error pada elemen field nama_produk
                            if ( $validation->hasError('nama_produk') )
                            { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error: <?=$validation->getError('nama_produk')?> </strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            <?php
                            }
                        }
                    ?>
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= set_value('nama_produk')?>" placeholder="Diisi dengan produk yang dijual">
                </div>

                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label">Nama Pembeli</label>
                    <?php
                        if(isset($validation)){
                            //untuk mengecek apakah ada error pada elemen field nama_produk
                            if ( $validation->hasError('nama_pelanggan') )
                            { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error: <?=$validation->getError('nama_pelanggan')?> </strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            <?php
                            }
                        }
                    ?>
                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= set_value('nama_pelanggan')?>" placeholder="Diisi dengan nama pembeli produk">
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <?php
                        if(isset($validation)){
                            //untuk mengecek apakah ada error pada elemen field nama_produk
                            if ( $validation->hasError('jumlah') )
                            { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error: <?=$validation->getError('jumlah')?> </strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            <?php
                            }
                        }
                    ?>
                    <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= set_value('jumlah')?>" placeholder="Diisi dengan jumlah yang dijual" onkeyup="sum();">
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <?php
                        if(isset($validation)){
                            //untuk mengecek apakah ada error pada elemen field nama_produk
                            if ( $validation->hasError('harga') )
                            { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error: <?=$validation->getError('harga')?> </strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            <?php
                            }
                        }
                    ?>
                    <input type="text" class="form-control" id="harga" name="harga" value="<?= set_value('harga')?>" placeholder="Diisi dengan harga produk yang djual" onkeyup="sum();">
                </div>

                <div class="mb-3">
                    <label for="hpp" class="form-label">HPP</label>
                    <?php
                        if(isset($validation)){
                            //untuk mengecek apakah ada error pada elemen field nama_produk
                            if ( $validation->hasError('hpp') )
                            { //untuk mendapatkan label error yang diset bisa menggunakan getError(namfield)
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error: <?=$validation->getError('hpp')?> </strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            <?php
                            }
                        }
                    ?>
                    <input type="text" class="form-control" id="hpp" name="hpp" value="<?= set_value('hpp')?>" placeholder="Diisi dengan HPP Produk" onkeyup="sum();">
                </div>

                <div class="mb-3">
                    <label for="total" class="form-label">Harga Total</label>
                    <input type="text" class="form-control" id="total" name="total" value="<?= set_value('total')?>" placeholder="Jumlah HPP dan Harga Produk" onkeyup="sum();">
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
			$('#harga,#hpp,#total').mask('0,000,000,000,000,000,000,000', {reverse: true});			
			
		})
	</script> 
    <script>
    function number_format (number, decimals, decPoint, thousandsSep) { 
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
            var n = !isFinite(+number) ? 0 : +number
            var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
            var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
            var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
            var s = ''
            var toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec)
            return '' + (Math.round(n * k) / k)
                .toFixed(prec)
            }
            // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
            if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
            }
            if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
            }

            return s.join(dec)
        }
        //fungsi ini akan terpicu jika ada perubahan nilai pada elemen combo box 
        function myFunction(){
            var var_harga = document.getElementById('harga');
            var jumlah = document.getElementById("jumlah").value;
            var  total = document.getElementById("total");
            total.value = number_format(jumlah*myarr[1]); //jumlah dikali harga
            //document.getElementById("x").innerHTML = myarr[0];
        }
        </script>
  </body>
</html>
