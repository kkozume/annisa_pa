<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Form Produk</h1>
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
        foreach($produk as $row):
            $id             = $row->id;
            $kode_produk    = $row->kode_produk;
            $nama_produk    = $row->nama_produk;
            $stok           = $row->stok;
            $harga_jual_produk   = $row->harga_jual_produk;
            $gambar         = $row->gambar;
            $kode_kategori  = $row->kode_kategori;
        endforeach;
      ?>
        <div class="row">
        <?= form_open_multipart('produk/editprodukproses') ?>
            <input type="hidden" id="id" name="id" value="<?= $id?>">
            <div class="mb-3">
                    <label for="kode_produk" class="form-label">Kode Produk</label>
                    <?php
                        //jika set value kode_produk tidak kosong maka isi $kode_produk diganti dengan isian dari user
                        if(strlen(set_value('kode_produk'))>0){
                          $kode_produk = set_value('kode_produk');
                        }
                    ?>
                    <input type="text" class="form-control" id="kode_produk" name="kode_produk" value="<?= $kode_produk?>" >
                </div>
                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <?php
                        //jika set value nama_produk tidak kosong maka isi $kode_produk diganti dengan isian dari user
                        if(strlen(set_value('nama_produk'))>0){
                          $kode_produk = set_value('nama_produk');
                        }
                    ?>
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?=$nama_produk?>" >
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="text" class="form-control" id="stok" name="stok" value="<?=$stok?>" placeholder="Diisi dengan stok">
                </div>
                <div class="mb-3">
                    <label for="harga_jual_produk" class="form-label">Harga Produk</label>
                    <input type="text" class="form-control" id="harga_jual_produk" name="harga_jual_produk" value="<?=$harga_jual_produk?>" >
                </div>
                <div class="mb-3">
                    <label for="kode_kategori" class="form-label">Kode Kategori</label>
                    <?php
                        //jika set value kode_kategori tidak kosong maka isi $kode_produk diganti dengan isian dari user
                        if(strlen(set_value('kode_kategori'))>0){
                          $kode_produk = set_value('kode_kategori');
                        }
                    ?>
                     <input type="text" class="form-control" id="kode_kategori" name="kode_kategori" value="<?=$kode_kategori?>" >
                    </div>
                
                <div class="mb-3">
                    <label for="gambar">Gambar</label>
                    <?php
                        //jika set value gambar tidak kosong maka isi $kode_produk diganti dengan isian dari user
                        if(strlen(set_value('gambar'))>0){
                          $kode_produk = set_value('gambar');
                        }
                    ?>
                    <input type="file" class="form-control" id="gambar" name="gambar" value="<?= set_value('gambar') ?>" >
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
