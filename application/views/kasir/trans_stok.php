<?php include (APPPATH.'views/kasir/components/header.php'); ?>

</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('kasir')?>">
        <div class="sidebar-brand-icon">
          <img src="<?= base_url() ?>assets/img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">KASIR</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('kasir/dashboard') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        MASTER
      </div>
      <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('kasir/daftar_produk') ?>">
          <i class="fas fa-fw fa-boxes"></i>
          <span>Produk</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('kasir/daftar_merk') ?>">
          <i class="fas fa-fw fa-regular fa-registered"></i>
          <span>Merk</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('kasir/daftar_kategori') ?>">
          <i class="fas fa-fw fa-solid fa-layer-group"></i>
          <span>Kategori</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        TRANSAKSI
      </div>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('kasir/transaksi') ?>">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Transaksi</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('kasir/daftar_invoice') ?>">
          <i class="fas fa-fw fa-file"></i>
          <span>Invoice</span></a>
      </li>
    </ul>
    <!-- Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">

        <!-- TopBar -->
        <?php include (APPPATH.'views/kasir/components/topbar.php'); ?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Halaman Transaksi Stok Produk</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Produk</li>
              <li class="breadcrumb-item active" aria-current="page">Trans Stock</li>
            </ol>
          </div>

          <!-- Main -->
          <div class="row">
            <div class="col-lg-12">

              <div class="card mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi Stok Produk Kode: <span class="text-dark fw-bold"><?= $data_produk[0]->kode_produk ?> -- <?= $data_produk[0]->nama_produk ?></span></h6>
                </div>
                <div class="table-responsive p-3">
                  <table id="daftarTransStock" class="table align-items-center table-flush table-hover">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th>ID</th>
                        <th>Kode Produk</th>
                        <th>Suplier</th>
                        <th>Jml Stok</th>
                        <th>Tipe Trans</th>
                        <th>No Faktur</th>
                        <th>Input by</th>
                        <th>Tgl Input</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php  foreach($trans_stok as $row): ?>
                        <tr class="text-center">
                          <td><?= $row->id_ts ?></td>
                          <td><?= $row->kode_produk ?></td>
                          <td><?= $row->suplier ?></td>
                          <td><?= $row->jml_stok ?></td>
                          <td><?= $row->tipe_trans ?></td>
                          <td><?= $row->no_faktur ?></td>
                          <td><?= $row->input_by ?></td>
                          <td><?= $row->tgl_input ?></td>
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


  <!-- Script JS --> 
  <?php include (APPPATH.'views/kasir/components/scripts.php'); ?>
  <!-- Script JS -->

  <script>
    $(document).ready(function () {
      $('#daftarTransStock').DataTable(); 
    });
  </script>

</body>

</html>