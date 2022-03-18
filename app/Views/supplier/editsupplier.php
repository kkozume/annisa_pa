<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Supplier</h1>
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

        //dapatkan data dari database untuk tabel form_input
        foreach($supplier as $row):
            $id_supplier = $row->id_supplier;
            $tanggal    = $row->tanggal;
            $nama_suplier = $row->nama_suplier;
            $nama_cv = $row->nama_cv;
            $alamat_supplier = $row->alamat_supplier;
            $no_telp_supplier = $row->no_telp_supplier;
            $ktp = $row->ktp;

        endforeach;
      ?>
        <div class="row">
        <?= form_open_multipart('supplier/editsupplierproses') ?>
            <input type="hidden" id="id_supplier" name="id_supplier" value="<?= $id_supplier?>">
            
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <?php
                        //jika set value tanggal tidak kosong maka isi $tanggal diganti dengan isian dari user
                        if(strlen(set_value('tanggal'))>0){
                          $tanggal = set_value('tanggal');
                        }
                
                    ?>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $tanggal?>" placeholder="Diisi dengan tanggal">
                </div>
                <div class="mb-3">
                    <label for="nama_suplier" class="form-label">Nama Supplier</label>
                    <?php
                        //jika set value nama_suplier tidak kosong maka isi $nama_suplier diganti dengan isian dari user
                        if(strlen(set_value('nama_suplier'))>0){
                          $nama_suplier = set_value('nama_suplier');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="nama_suplier" name="nama_suplier" value="<?= $nama_suplier?>" placeholder="Diisi dengan nama supplier">
                </div>
                <div class="mb-3">
                    <label for="nama_cv" class="form-label">Nama Toko</label>
                    <?php
                        //jika set value nama_cv tidak kosong maka isi $nama_cv diganti dengan isian dari user
                        if(strlen(set_value('nama_cv'))>0){
                          $nama_cv = set_value('nama_cv');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="nama_cv" name="nama_cv" value="<?= $nama_cv?>" placeholder="Diisi dengan nama toko">
                </div>
                <div class="mb-3">
                    <label for="alamat_supplier" class="form-label">Alamat Supplier</label>
                    <?php
                        //jika set value alamat_supplier tidak kosong maka isi $alamat_supplier diganti dengan isian dari user
                        if(strlen(set_value('alamat_supplier'))>0){
                          $alamat_supplier = set_value('alamat_supplier');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="alamat_supplier" name="alamat_supplier" value="<?= $alamat_supplier?>" placeholder="Diisi dengan alamat supplier">
                </div>
                <div class="mb-3">
                    <label for="no_telp_supplier" class="form-label">No telp Supplier</label>
                    <?php
                        //jika set value no_telp_supplier tidak kosong maka isi $no_telp_supplier diganti dengan isian dari user
                        if(strlen(set_value('no_telp_supplier'))>0){
                          $no_telp_supplier = set_value('no_telp_supplier');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="no_telp_supplier" name="no_telp_supplier" value="<?= $no_telp_supplier?>" placeholder="Diisi dengan no telp ">
                </div>
                <div class="mb-3">
                    <label for="ktp">KTP</label>
                    <input type="file" class="form-control" id="ktp" name="ktp"  >
                    <br>
                    <a href="<?php echo base_url('images/upload/'.$ktp) ?>" target="_blank">
                    <img src="<?php echo base_url('images/upload/'.$ktp) ?>" class="img-thumbnail" width="100">
                    </a>
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
