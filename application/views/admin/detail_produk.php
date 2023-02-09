<?php include (APPPATH.'views/admin/components/header.php'); ?>

</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="<?= base_url() ?>assets/img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3"><?= $this->session->userdata('role') ?></div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        MASTER
      </div>
      <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('admin/daftar_produk') ?>">
          <i class="fas fa-fw fa-boxes"></i>
          <span>Produk</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/daftar_merk') ?>">
          <i class="fas fa-fw fa-regular fa-registered"></i>
          <span>Merk</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/daftar_kategori') ?>">
          <i class="fas fa-fw fa-solid fa-layer-group"></i>
          <span>Kategori</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/daftar_suplier') ?>">
          <i class="fas fa-fw fa-regular fa-handshake"></i>
          <span>Suplier</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/user') ?>">
          <i class="fas fa-fw fa-regular fa-users"></i>
          <span>Users</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        TRANSAKSI
      </div>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/daftar_invoice') ?>">
          <i class="fas fa-fw fa-file"></i>
          <span>Invoice</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/stok_produk') ?>">
          <i class="fas fa-fw fa-box"></i>
          <span>Stok Produk</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        PENGATURAN
      </div>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/info') ?>">
          <i class="fas fa-fw fa-info"></i>
          <span>Info</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        LAPORAN
      </div>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/laporan') ?>">
          <i class="fas fa-fw fa-solid fa-chart-pie"></i>
          <span>Penjualan</span></a>
      </li>
    </ul>
    <!-- Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">

        <!-- TopBar -->
        <?php include (APPPATH.'views/admin/components/topbar.php'); ?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item"><a href="../daftar_produk">Produk</a></li>
              <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
          </div>

          <!-- Main -->
          <div class="row">
            <div class="col-lg-12">

              <div class="card mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Detail Produk dengan Kode: <?= $kode_produk ?></h6>
                </div>
                <div class="table-responsive p-3">

                <?php foreach ($produk as $row): ?>
                  <form action="<?= base_url('admin/ubah_produk') ?>" method="post">
                    <div class="form-group row">
                      <label for="inputKode" class="col-sm-3 col-form-label">Kode Produk</label>
                      <div class="col-sm-9">
                        <input name="kode_produk" type="hidden" class="form-control" value="<?= $row->kode_produk ?>">
                        <input name="kode_produk" type="text" disabled class="form-control" id="inputKode" value="<?= $row->kode_produk ?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputNamaProduk" class="col-sm-3 col-form-label">Nama Produk</label>
                      <div class="col-sm-9">
                        <input name="nama_produk" type="text" class="form-control" id="inputNamaProduk" value="<?= $row->nama_produk ?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputMerk" class="col-sm-3 col-form-label">Merk</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="merk" id="inputMerk">
                          <?php foreach($merk as $mrk): ?>
                            <option value="<?= $mrk->id_merk ?>" <?= trim($row->merk) == trim($mrk->id_merk) ? 'selected' : '' ?>><?= $mrk->deskripsi ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputKategori" class="col-sm-3 col-form-label">Kategori</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="kategori" id="inputKategori">
                          <?php foreach($kategori as $ktg): ?>
                            <option value="<?= $ktg->id_kategori ?>" <?= trim($row->kategori_produk) == trim($ktg->id_kategori) ? 'selected' : '' ?>><?= $ktg->deskripsi ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSatuan" class="col-sm-3 col-form-label">Satuan Jual</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="satuan" id="inputSatuan">
                          <?php foreach($satuan as $st): ?>
                            <option value="<?= $st->nama_satuan ?>" <?= $row->satuan_jual == $st->nama_satuan ? 'selected' : '' ?>><?= $st->nama_satuan ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputHargaBeli" class="col-sm-3 col-form-label">Harga Beli</label>
                      <div class="col-sm-9">
                        <input name="harga_beli" type="text" class="form-control" id="inputHargaBeli" value="<?= $row->harga_beli ?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputHargaJual" class="col-sm-3 col-form-label">Harga Jual</label>
                      <div class="col-sm-9">
                        <input name="harga_jual" type="text" class="form-control" id="inputHargaJual" value="<?= $row->harga_jual ?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSuplier" class="col-sm-3 col-form-label">Suplier</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="suplier" id="inputSuplier">
                          <?php foreach($suplier as $spl): ?>
                            <option value="<?= $spl->id_suplier ?>" <?= trim($row->suplier) == trim($spl->id_suplier) ? 'selected' : '' ?>><?= $spl->nama_suplier ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputBy" class="col-sm-3 col-form-label">Diinput Oleh</label>
                      <div class="col-sm-9">
                        <input name="input_by" type="text" disabled class="form-control" id="inputBy" value="<?= $row->input_by ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputByTgl" class="col-sm-3 col-form-label">Tanggal Input</label>
                      <div class="col-sm-9">
                        <input name="tgl_input" type="text" disabled class="form-control" id="inputByTgl" value="<?= $row->tgl_input ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputUpdate" class="col-sm-3 col-form-label">Tanggal Update</label>
                      <div class="col-sm-9">
                        <input name="tgl_update" type="text" disabled class="form-control" id="inputUpdate" value="<?= $row->tgl_update ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputStatus" class="col-sm-3 col-form-label">Status</label>
                      <div class="col-sm-9">
                        <input type="text" id="inputStatus" name="status" disabled class="form-control" value="<?= $row->status ? 'Enabled' : 'Disabled' ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="btnUpdate" class="col-sm-3 col-form-label"></label>
                      <div class="col-sm-9">
                        <button class="btn btn-primary" onclick="return confirm('Apakah anda yakin ubah data info perusahaan?')"> Simpan Perubahan</button>
                      </div>
                    </div>
                  </form>
                <?php endforeach ?>

                </div>
              </div>
            </div>
          </div>
          <!-- End Main -->

          <!-- Modal Logout -->
          <?php include (APPPATH.'views/footer/modal_logout.php'); ?>
          <!-- Modal Logout -->

        </div>
        <!---Container Fluid-->
      </div>

      <!-- Footer -->
      <?php include (APPPATH.'views/footer/footer.php'); ?>
      <!-- Footer -->

    </div>
  </div>



  <!-- Modal Tambah Kategori Baru -->
  <div class="modal fade" id="tambahMerkBaru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Tambah Kategori Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="./tambah_kategori" method="POST">
          <div class="modal-body">
            <div class="form-group row">
              <label for="inputKategoriProduk" class="col-sm-3 col-form-label">Kategori Produk</label>
              <div class="col-sm-9">
                <input name="kategori_produk" type="text" class="form-control" id="inputKategoriProduk" placeholder="Kategori porduk baru" required autofocus>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal Tambah Kateogri Baru -->



  <!-- Script JS -->
  <?php include (APPPATH.'views/admin/components/scripts.php'); ?>
  <!-- Script JS -->

  <script>
    $(document).ready(function () {
      $('#daftarInvoice').DataTable(); 
    });
  </script>

  <script>
    let b_url = window.location.origin + "/sivenka/";
    let inp_jml = document.getElementById("inputJumlah");
    let inp_pmb = document.getElementById("inputJmlCash");

    // hitung jumlah tagihan
    inp_jml.addEventListener("input", () => {
      let sub_total = $("#inputHarga").val() * $("#inputJumlah").val();
      $("#inputSubTotal").val(sub_total);

      // hitung sub total
      var sum = 0;
      $(".subtotal").each(function(){
        sum += parseFloat($(this).text());
      });
      $('#total').text(sum);
      
      // hitung ppn
      let ppn = (parseFloat($('#total').text()) * 0.11);
      $('#ppn').text(ppn);

      // hitung total
      let ttl = (parseFloat($('#total').text()) + ppn);
      $('#total_ppn').text(ttl);
    });

    // input ke temporary keranjang
    $("#btnTambah").click(function(){
      $.ajax({
        type: "POST",
        url: base_url + "trans/simpan_keranjang",
        data: {data: ns.value},
        async: false,
        success: function (result) {
          return;
        },
      });
    });

    // hitung kembalian pembayaran
    inp_pmb.addEventListener("input", () => {
      let kembalian = inp_pmb.value - $("#total_ppn").text();
      $("#inputKembalian").val(kembalian);
    });
  </script>
</body>

</html>