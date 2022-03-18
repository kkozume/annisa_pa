<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Pencatatan Harian</h1>
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
        <?= form_open('pencatatan_harian') ?>
        <div class="mb-3">
                   <label for="kode_barang" class="form-label">Kode Barang</label>
                   <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= set_value('kode_barang')?>" placeholder="Diisi dengan kode_barang">
        </div>
        <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= set_value('tanggal')?>" placeholder="Diisi dengan tanggal">
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <?php
                        //jika set value keterangan tidak kosong maka isi $keterangan diganti dengan isian dari user
                        if(strlen(set_value('keterangan'))>0){
                          $keterangan = set_value('keterangan');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= set_value('keterangan')?>" placeholder="Diisi dengan keterangan">
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <?php
                        //jika set value jumlah tidak kosong maka isi $jumlah diganti dengan isian dari user
                        if(strlen(set_value('jumlah'))>0){
                          $jumlah = set_value('jumlah');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= set_value('jumlah')?>" placeholder="Diisi dengan jumlah">
                </div>
                <div class="mb-3">
                <label for="posisi_db_kd" class="form-label">Posisi Db Kd</label>
                    <select class="form-select" aria-label="Default select example" name="posisi_db_kd">
                    <option selected>Posisi Db Kd</option>
                        <option value="Debet">Debet</option>
                        <option value="Kredit">Kredit</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="saldo" class="form-label">Saldo</label>
                    <?php
                        //jika set value saldo tidak kosong maka isi $saldo diganti dengan isian dari user
                        if(strlen(set_value('saldo'))>0){
                          $saldo = set_value('saldo');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="saldo" name="saldo" value="<?= set_value('saldo')?>" placeholder="Diisi dengan saldo">
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
