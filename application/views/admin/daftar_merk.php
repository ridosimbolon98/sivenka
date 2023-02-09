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
      <li class="nav-item active">
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
            <h1 class="h3 mb-0 text-gray-800">Halaman Daftar Merk</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Merk</li>
              <li class="breadcrumb-item active" aria-current="page">Daftar</li>
            </ol>
          </div>

          <!-- Main -->
          <div class="row">
            <div class="col-lg-12">

              <div class="pb-3">
                <button class="btn btn-success" data-toggle="modal" data-target="#tambahMerkBaru"><i class="fa fa-plus-square"></i> Tambah Merk Baru</button>
              </div>

              <div class="card mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
                </div>
                <div class="table-responsive p-3">
                  <table id="daftarMerk" class="table align-items-center table-flush table-hover">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th>Kode</th>
                        <th>Merk</th>
                        <th>Input By</th>
                        <th>Tgl Input</th>
                        <th>Tgl Update</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($merk as $row): ?>
                      <tr class="text-center">
                        <td><?= $row->id_merk ?></td>
                        <td><?= $row->deskripsi ?></td>
                        <td><?= $row->input_by ?></td>
                        <td><?= $row->tgl_input ?></td>
                        <td><?= $row->tgl_update ?></td>
                        <td>
                          <a id="btnUbah" class="btn btn-sm btn-info text-white" data-toggle="modal" data-target="#modal-ubah-merk" data-id_merk="<?= $row->id_merk ?>" data-deskripsi="<?= $row->deskripsi ?>"><i class="fa fa-pen-square text-white"></i> Ubah</a>
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



  <!-- Modal Tambah Merk Baru -->
  <div class="modal fade" id="tambahMerkBaru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Tambah Merk Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="./tambah_merk" method="POST">
          <div class="modal-body">
            <div class="form-group row">
              <label for="inputMerkProduk" class="col-sm-3 col-form-label">Merk Produk</label>
              <div class="col-sm-9">
                <input name="merk_produk" type="text" class="form-control" id="inputMerkProduk" placeholder="Merk porduk baru" required autofocus>
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
  <!-- End Modal Tambah Merk Baru -->
  
  <!-- Modal Ubah Merk Baru -->
  <div class="modal fade" id="modal-ubah-merk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Ubah Data Merk <span class="fontweight-bold" id="merk_id"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="./ubah_merk" method="POST">
          <div class="modal-body">
            <div class="form-group row">
              <label for="updateMerkProduk" class="col-sm-3 col-form-label">Merk Produk</label>
              <div class="col-sm-9">
                <input name="id_merk" type="hidden" class="form-control" id="id_merk_produk" required>
                <input name="desk_merk" type="text" class="form-control" id="updateMerkProduk" required autofocus>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-outline-primary" data-dismiss="modal"> Batal</button>
            <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin update data merk ini?')"><i class="fa fa-save"></i> Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal Ubah Merk Baru -->



  <!-- Script JS -->
  <?php include (APPPATH.'views/admin/components/scripts.php'); ?>
  <!-- Script JS -->

  <script>
    $(document).ready(function () {
      $('#daftarMerk').DataTable(); 
    });
  </script>

  <script>
    let b_url = window.location.origin + "/sivenka/";

    // input ke temporary keranjang
    $(document).on("click", "#btnUbah", function () {
      let id_merk = $(this).data("id_merk");
      let deskripsi = $(this).data("deskripsi");

      $("#id_merk_produk").val(id_merk);
      $("#updateMerkProduk").val(deskripsi);
    });

  </script>
</body>

</html>