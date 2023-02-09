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
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/daftar_produk') ?>">
          <i class="fas fa-fw fa-boxes"></i>
          <span>Produk</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/daftar_merk') ?>">
          <i class="fas fa-fw fa-regular fa-registered"></i>
          <span>Merk</span></a>
      </li>
      <li class="nav-item active">
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
            <h1 class="h3 mb-0 text-gray-800">Halaman Daftar Kategori Produk</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Kategori</li>
              <li class="breadcrumb-item active" aria-current="page">Daftar</li>
            </ol>
          </div>

          <!-- Main -->
          <div class="row">
            <div class="col-lg-12">

              <div class="pb-3">
                <button class="btn btn-success" data-toggle="modal" data-target="#tambahKategoriBaru"><i class="fa fa-plus-square"></i> Tambah Kategori Baru</button>
              </div>

              <div class="card mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori Produk</h6>
                </div>
                <div class="table-responsive p-3">
                  <table id="daftarKategori" class="table align-items-center table-flush table-hover">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th>Kode</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Input By</th>
                        <th>Tgl Input</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($kategori as $row): ?>
                      <tr class="text-center">
                        <td><?= $row->id_kategori ?></td>
                        <td><?= $row->deskripsi ?></td>
                        <td><?= $row->status ? 'ENABLED' : 'DISABLED' ?></td>
                        <td><?= $row->input_by ?></td>
                        <td><?= $row->tgl_input ?></td>
                        <td>
                          <a id="btn_ubah" href="" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalUbahKategori" data-id_kat="<?= $row->id_kategori ?>" data-deskripsi="<?= $row->deskripsi ?>" data-status="<?= $row->status ?>"><i class="fa fa-pen-square"></i> Ubah</a>
                          <a href="<?= base_url() ?>admin/status_kategori/<?= $row->id_kategori ?>" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i> <?= $row->status ? 'Disabled' : 'Enabled' ?></a>
                        </td>
                      </tr>
                    <?php endforeach ?>

                    </tbody>
                  </table>
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
  <div class="modal fade" id="tambahKategoriBaru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

  <!-- Modal Ubah Kategori Baru -->
  <div class="modal fade" id="modalUbahKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Ubah Data Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="./ubah_kategori" method="POST">
          <div class="modal-body">
            <div class="form-group row">
              <label for="ubahKategoriProduk" class="col-sm-3 col-form-label">Kategori Produk</label>
              <div class="col-sm-9">
                <input name="id_kat" type="hidden" class="form-control" id="idKategoriPrd" required>
                <input name="kategori_produk" type="text" class="form-control" id="ubahKategoriProduk" required autofocus>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ubah data kategori ini?')"><i class="fa fa-save"></i> Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal Ubah Kateogri Baru -->



  <!-- Script JS -->
  <?php include (APPPATH.'views/admin/components/scripts.php'); ?>
  <!-- Script JS -->

  <script>
    $(document).ready(function () {
      $('#daftarKategori').DataTable(); 
    });
  </script>

  <script>
    let b_url = window.location.origin + "/sivenka/";

    // input ke temporary keranjang
    $(document).on("click", "#btn_ubah", function () {
      let id_kategori = $(this).data("id_kat");
      let deskripsi = $(this).data("deskripsi");

      $("#idKategoriPrd").val(id_kategori);
      $("#ubahKategoriProduk").val(deskripsi);
    });
  </script>
</body>

</html>