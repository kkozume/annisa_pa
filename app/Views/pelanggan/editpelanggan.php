<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit pelanggan</h1>
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
        foreach($pelanggan as $row):
            $id_pelanggan = $row->id_pelanggan;  
            $nama_pelanggan = $row->nama_pelanggan;
            $jenis_kelamin = $row->jenis_kelamin;
            $alamat = $row->alamat;
            $no_telp = $row->no_telp;
            $ktp = $row->ktp;
        endforeach;
      ?>
        <div class="row">
        <?= form_open_multipart('pelanggan/editpelangganproses') ?>
            
        <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $id_pelanggan?>">
            <div class="mb-3">
                   <label for="nama_pelanggan" class="form-label">Nama pelanggan</label>
                   <?php
                        //jika set value nama_pelanggan tidak kosong maka isi $nama_pelanggan diganti dengan isian dari user
                        if(strlen(set_value('nama_pelanggan'))>0){
                          $nama_pelanggan = set_value('nama_pelanggan');
                        }
                
                    ?>
                   <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= $nama_pelanggan?>" placeholder="Diisi dengan nama_pelanggan">
      
                <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <?php
                        //jika set value nama_pelanggan tidak kosong maka isi $nama_pelanggan diganti dengan isian dari user
                        if(strlen(set_value('jenis_kelamin'))>0){
                          $jenis_kelamin = set_value('jenis_kelamin');
                        }
                    ?>
                    <select class="form-select" aria-label="Default select example" name="jenis_kelamin">
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <?php
                        //jika set value alamat tidak kosong maka isi $alamat diganti dengan isian dari user
                        if(strlen(set_value('alamat'))>0){
                          $alamat = set_value('alamat');
                        }
                
                    ?>
                   <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $alamat?>" placeholder="Diisi dengan alamat">
                </div>

                <div class="mb-3">
                    <label for="no_telp" class="form-label">Nomor Telepon</label>
                    <?php
                        //jika set value no_telp tidak kosong maka isi $no_telp diganti dengan isian dari user
                        if(strlen(set_value('no_telp'))>0){
                          $no_telp = set_value('no_telp');
                        }
                
                    ?>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $no_telp?>" placeholder="Diisi dengan nomor telepon">
                </div>
                
                
                <div class="mb-3">
                    <label for="ktp">ktp</label>
                    <input type="file" class="form-control" id="ktp" name="ktp"  >
                    <br>
                    <a href="<?php echo base_url('images/upload/'.$ktp) ?>" target="_blank">
                    <img src="<?php echo base_url('images/upload/'.$ktp) ?>" class="img-thumbnail" width="100">
                    </a>
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
