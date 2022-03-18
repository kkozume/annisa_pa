<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Chanel Penjualan</h1>
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

        //dapatkan data dari umkm_puri_utami dan simpan ke variabel lokal
        foreach($chanel_penjualan as $row):
          $id_chanel = $row->id_chanel;
          $nama_chanel = $row->nama_chanel;
        endforeach;
      ?>
        <div class="row">
        <?= form_open('chanel_penjualan/editchanelproses') ?>
            
            <input type="hidden" id="id_chanel" name="id_chanel" value="<?= $id_chanel?>">
                <div class="mb-3">
                    <label for="nama_chanel" class="form-label">Nama Chanel Penjualan</label>
                    <?php
                        //jika set value nama_chanel tidak kosong maka isi $nama_chanel diganti dengan isian dari user
                        if(strlen(set_value('nama_chanel'))>0){
                          $nama_chanel = set_value('nama_chanel');
                        }
                
                    ?>
                    <input type="url" class="form-control" id="nama_chanel" name="nama_chanel" value="<?= $nama_chanel?>" placeholder="Diisi dengan nama chanel penjualan">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </main>
  </div>
</div>

    <!-- Bootstrap JS -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
  </body>
</html>
