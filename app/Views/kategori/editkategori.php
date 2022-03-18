<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Kategori</h1>
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
        foreach($kategori as $row):
          $kode_kategori = $row->kode_kategori;
          $nama_kategori = $row->nama_kategori;
        endforeach;
      ?>
        <div class="row">
        <?= form_open('kategori/editkategoriproses') ?>
            
            <input type="hidden" id="kode_kategori" name="kode_kategori" value="<?= $kode_kategori?>">
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <?php
                        //jika set value nama_kategori tidak kosong maka isi $nama_kategori diganti dengan isian dari user
                        if(strlen(set_value('nama_kategori'))>0){
                          $nama_kategori = set_value('nama_kategori');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= $nama_kategori?>" placeholder="Diisi dengan nama kategori">
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
