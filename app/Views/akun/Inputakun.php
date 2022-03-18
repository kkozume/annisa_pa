<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Akun</h1>
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
        <?= form_open('akun') ?>
                <div class="mb-3">
                   <label for="kode_akun" class="form-label">Kode Akun</label>
                   <input type="text" class="form-control" id="kode_akun" name="kode_akun" value="<?= set_value('kode_akun')?>" placeholder="Diisi dengan kode akun">
                </div>
                <div class="mb-3">
                    <label for="nama_akun" class="form-label">Nama Akun</label>
                    <input type="text" class="form-control" id="nama_akun" name="nama_akun" value="<?= set_value('nama_akun')?>" placeholder="Diisi dengan nama akun">
                </div>
                <div class="mb-3">
                    <label for="header_akun" class="form-label">Header Akun</label>
                    <input type="text" class="form-control" id="header_akun" name="header_akun" value="<?= set_value('header_akun')?>" placeholder="Diisi dengan header akun">
                </div>
                <div class="mb-3">
                <label for="posisi_d_c" class="form-label">Posisi Debet/Kredit</label>
                    <select class="form-select" aria-label="Default select example" name="posisi_d_c" value="<?set_value('posisi_d_c')?>">
                    <option selected>-isi pilihan-</option>
                        <option value="d">Debet</option>
                        <option value="c">Kredit</option>
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
  </body>
</html>
