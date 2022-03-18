<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Produk</h1>
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
        <?= form_open_multipart('produk/index') ?>
                <div class="mb-3">
                    <label for="kode_produk" class="form-label">Kode Produk</label>
                    <input type="text" class="form-control" id="kode_produk" name="kode_produk" value="<?= set_value('kode_produk')?>" placeholder="Diisi dengan kode produk">
                </div>
                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= set_value('nama_produk')?>" placeholder="Diisi dengan nama produk">
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="text" class="form-control" id="stok" name="stok" value="<?= set_value('stok')?>" placeholder="Diisi dengan stok">
                </div>
                <div class="mb-3">
                    <label for="harga_jual_produk" class="form-label">Harga Produk</label>
                    <input type="text" class="form-control" id="harga_jual_produk" name="harga_jual_produk" value="<?= set_value('harga_jual_produk')?>" placeholder="Diisi dengan harga produk">
                </div>
                <div class="mb-3">
                    <label for="kode_kategori" class="form-label">Kode Kategori</label>
                    <select class="form-select" name="kode_kategori" id="kode_kategori">
                    <option value="G01">Gamis</option>
                    <option value="KK01">Mukena</option>
                    <option value="T01">Tunik</option>
                    <option value="B01">Batik</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="gambar">Gambar</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" value="<?= set_value('gambar') ?>" >
                </div>
                          
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
            // Format mata uang.
            $('#harga_jual_produk').mask('0,000,000,000,000,000,000,000', {reverse: true});         
            
        })
    </script> 

  </body>
</html>
