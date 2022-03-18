<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input pelanggan</h1>
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
        <?= form_open_multipart('pelanggan/index') ?>
        <div class="mb-3">
                   <label for="nama_pelanggan" class="form-label">Nama pelanggan</label>
                   <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= set_value('nama_pelanggan')?>" placeholder="Diisi dengan nama pelanggan">
        </div>

                <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" aria-label="Default select example" name="jenis_kelamin">
                    <option selected>-Jenis Kelamin-</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= set_value('alamat')?>" placeholder="Diisi dengan alamat">
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= set_value('no_telp')?>" placeholder="Diisi dengan nomor telepon">
                </div>
                
                
                <div class="mb-3">
                    <label for="ktp" class="form-label">KTP pelanggan</label>
                    <input type="file" class="form-control" id="ktp" name="ktp" value="<?= set_value('ktp')?>" placeholder="Diisi dengan ktp">
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
			$('#no_telp').mask('000-000-000-000-000', {reverse: true});			
			
		})
	 </script> 
  

  </body>
</html>
