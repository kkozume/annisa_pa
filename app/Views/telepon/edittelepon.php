<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Telepon</h1>
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
        foreach($telepon as $row):
          $id_karyawan = $row->id_karyawan;
          $no_telepon = $row->no_telepon;
        endforeach;
      ?>
        <div class="row">
        <?= form_open('telepon/editteleponproses') ?>
            
            <input type="hidden" id="id_karyawan" name="id_karyawan" value="<?= $id_karyawan?>">
                <div class="mb-3">
                    <label for="no_telepon" class="form-label">Nomor Telepon</label>
                    <?php
                        //jika set value no_telepon tidak kosong maka isi $no_telepon diganti dengan isian dari user
                        if(strlen(set_value('no_telepon'))>0){
                          $no_telepon = set_value('no_telepon');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="<?= $no_telepon?>" placeholder="Diisi dengan nomor telepon">
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
