<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Supplier</h1>
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

      <?php
        if(isset($validation)){
          echo $validation->listErrors();
        }
      ?>
        <div class="row">
        <?= form_open_multipart('supplier/index') ?>
                
                 <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= set_value('tanggal')?>" placeholder="Diisi dengan tanggal">
                </div>
              <div class="mb-3">
                    <label for="nama_suplier" class="form-label">nama_suplier</label>
                    <input type="text" class="form-control" id="nama_suplier" name="nama_suplier" value="<?= set_value('nama_suplier')?>" placeholder="Diisi dengan nama supplier">
                </div>
                <div class="mb-3">
                    <label for="nama_cv" class="form-label">nama_toko</label>
                    <input type="text" class="form-control" id="nama_cv" name="nama_cv" value="<?= set_value('nama_cv')?>" placeholder="Diisi dengan nama toko">
                </div>
                 <div class="mb-3">
                    <label for="alamat_supplier" class="form-label">alamat_supplier</label>
                    <input type="text" class="form-control" id="alamat_supplier" name="alamat_supplier" value="<?= set_value('alamat_supplier')?>" placeholder="Diisi dengan alamat supplier"></p>
                </div>
                <div class="mb-3">
                    <label for="no_telp_supplier" class="form-label">no_telp_supplier</label>
                    <input type="text" class="form-control" id="no_telp_supplier" name="no_telp_supplier" value="<?= set_value('no_telp_supplier')?>" placeholder="Diisi dengan Nomor Telepon (082144067745)">
                </div>
                <div class="mb-3">
                    <label for="ktp" class="form-label">KTP</label>
                    <input type="file" class="form-control" id="ktp" name="ktp" value="<?= set_value('ktp')?>" >
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
			// Format telepon.
			$('#no_telp_supplier').mask('000-000-000-000-000', {reverse: true});			
			
		})
	 </script> 

  </body>
</html>
