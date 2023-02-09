<?php include (APPPATH.'views/admin/components/header.php'); ?>
<link rel="stylesheet" href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/vendor/datatables/buttons.bootstrap4.min.css') ?>">

<style>
    #cardTotal {
      width: 280px !important;
    }
    #detail_unit {
      line-height: 10pt;
    }
    @media print {
      body,
      html {
        width: 100%;
        margin: 0px;
        padding: 0px;
      }

      body, body #accordionSidebar, body .static-top {
        visibility: hidden;
        height: 0;
        width: 0;
        margin: 0;
        padding: 0;
      }

      #section-to-print {
        visibility: visible !important;
      }

      .cm4 {
        width: 40% !important;
      }
      .cm8 {
        width: 60% !important;
      }

      #header-inv {
        display: flex;
        justify-content: space-between;
      }
      
      #section-to-print {
        zoom: 1;
        width: 100% !important;
        position: absolute;
        left: 0 !important;
        top: 0 !important;
        shadow: none !important;
      }
    }
  </style>

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
      <li class="nav-item active">
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
            <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Laporan</li>
              <li class="breadcrumb-item active" aria-current="page">Penjualan</li>
            </ol>
          </div>

          <!-- Main -->
          <div class="row">
            <div class="col-lg-12">

              <!-- <div class="pb-3">
                <button class="btn btn-success" onclick="window.print()"><i class="fa fa-print"></i> Print Laporan</button>
              </div> -->

              <div id="section-to-print" class="card mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
                </div>
                <div class="table-responsive p-3">
                  <table id="example" class="table align-items-center table-flush table-hover">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th>No.</th>
                        <th>ID Trans</th>
                        <th>Invoice</th>
                        <th>Kode</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Terjual</th>
                        <th>Pajak</th>
                        <th>Sub Total</th>
                        <th>Periode</th>
                        <th>Tgl Trans</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; foreach($laporan as $row): ?>
                        <tr>
                          <td class="text-center"><?= $no++ ?></td>
                          <td class="text-center"><?= $row->id_trans ?></td>
                          <td class="text-center"><?= $row->invoice ?></td>
                          <td class="text-center"><?= $row->kd_produk ?></td>
                          <td class="text-center"><?= $row->nama_produk ?></td>
                          <td class="text-center"><?= number_format($row->harga_modal,2,",",".") ?></td>
                          <td class="text-center"><?= $row->jml_stock ?></td>
                          <td class="text-center"><?= $row->satuan_jual ?></td>
                          <td class="text-center"><?= $row->jumlah ?></td>
                          <td class="text-center"><?= number_format($row->pajak,2,",",".") ?></td>
                          <td class="subtotal text-center"><?= number_format($row->subtotal,2,",",".") ?></td>
                          <td class="text-center"><?= $row->periode_trans ?></td>
                          <td class="text-center"><?= $row->tgl_input ?></td>
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
  <?php include (APPPATH.'views/admin/components/scripts.php'); ?>
  <!-- Script JS -->
  <script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/datatables/dataTables.buttons.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/datatables/buttons.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/datatables/jszip.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/datatables/pdfmake.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/datatables/vfs_fonts.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/datatables/buttons.html5.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/datatables/buttons.print.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/datatables/buttons.colVis.min.js') ?>"></script>

  <script>
    $(document).ready(function() {
      var table = $('#example').DataTable( {
        lengthChange: true,
        buttons: [ 
          'copy', 
          'excel',
          {
            extend: 'pdf',
            orientation: 'landscape',
            pageSize: 'A4'
          }, 
          'colvis'
        ]
      } );
  
      table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
  </script>

</body>

</html>