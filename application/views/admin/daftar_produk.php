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
            <h1 class="h3 mb-0 text-gray-800">Halaman Daftar Produk</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Produk</li>
              <li class="breadcrumb-item active" aria-current="page">Daftar</li>
            </ol>
          </div>

          <!-- Main -->
          <div class="row">
            <div class="col-lg-12">

              <div class="pb-3">
                <button class="btn btn-success" data-toggle="modal" data-target="#tambahProdukBaru"><i class="fa fa-plus-square"></i> Tambah Produk Baru</button>
              </div>

              <div class="card mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
                </div>
                <div class="table-responsive p-3">
                  <table id="daftarInvoice" class="table align-items-center table-flush table-hover">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Merk</th>
                        <th>Kategori</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php  foreach($produk as $row): ?>
                        <tr class="text-center">
                          <td><?= $row->kode_produk ?></td>
                          <td><?= $row->nama_produk ?></td>
                          <td><?= $row->merk_produk ?></td>
                          <td><?= $row->kategori_produk ?></td>
                          <td><?= $row->satuan_jual ?></td>
                          <td><?= $row->jml_stock ?></td>
                          <td>
                            <a href="<?= base_url() ?>admin/detail_produk/<?= $row->kode_produk ?>" class="btn btn-sm btn-info"><i class="fa fa-list"></i> Detail</a>
                            <a href="<?= base_url() ?>admin/status_produk/<?= $row->kode_produk ?>" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i> <?= $row->status ? 'Disabled' : 'Enabled' ?></a>
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



  <!-- Modal Tambah Produk Baru -->
  <div class="modal fade" id="tambahProdukBaru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Tambah Produk Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="./tambah_produk" method="POST">
          <div class="modal-body">
            <div class="form-group row">
              <label for="inputNamaProduk" class="col-sm-3 col-form-label">Nama Produk</label>
              <div class="col-sm-9">
                <input name="nama_produk" type="text" class="form-control" id="inputNamaProduk" placeholder="Nama porduk" required autofocus>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputMerkProduk" class="col-sm-3 col-form-label">Merk Produk</label>
              <div class="col-sm-9">
                <select class="form-control" name="merk_produk" id="inputMerkProduk" required>
                  <option value="" disabled-selected hidden>--Pilih Merk Produk--</option>
                  <?php foreach($merk as $row): ?>
                    <option value="<?= $row->id_merk ?>"><?= $row->deskripsi ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputKategoriProduk" class="col-sm-3 col-form-label">Kategori Produk</label>
              <div class="col-sm-9">
                <select class="form-control" name="kategori_produk" id="inputKategoriProduk" required>
                  <option value="" disabled-selected hidden>--Pilih Kategori Produk--</option>
                  <?php foreach($kategori as $row): ?>
                    <option value="<?= $row->id_kategori ?>"><?= $row->deskripsi ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputSatuanJual" class="col-sm-3 col-form-label">Satuan Jual</label>
              <div class="col-sm-9">
                <select name="satuan_jual" id="inputSatuanJual" class="form-control">
                  <option value="" disabled-selected hidden>--Pilih Satuan--</option>
                  <?php foreach($satuan as $row): ?>
                    <option value="<?= $row->nama_satuan ?>"><?= $row->keterangan ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputHargaBeliProduk" class="col-sm-3 col-form-label">Harga Beli</label>
              <div class="col-sm-9">
                <input name="harga_beli" type="number" step="1" min="0" class="form-control" id="inputHargaBeliProduk" placeholder="Rp." required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputHargaJualProduk" class="col-sm-3 col-form-label">Harga Jual</label>
              <div class="col-sm-9">
                <input name="harga_jual" type="number" step="1" min="0" class="form-control" id="inputHargaJualProduk" placeholder="Rp." required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputSuplierProduk" class="col-sm-3 col-form-label">Suplier Produk</label>
              <div class="col-sm-9">
                <input name="suplier_produk" list="suplier_produk" class="form-control" id="inputSuplierProduk" placeholder="Pilih Suplier" required>
                <datalist id="suplier_produk">
                  <?php foreach($suplier as $row): ?>
                    <option value="<?= $row->id_suplier ?>"><?= $row->nama_suplier   ?></option>
                  <?php endforeach ?>
                </datalist>
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
  <!-- End Modal Tambah Produk Baru -->



  <!-- Script JS --> 
  <?php include (APPPATH.'views/admin/components/scripts.php'); ?>
  <!-- Script JS -->

  <script>
    $(document).ready(function () {
      $('#daftarInvoice').DataTable(); 
    });
  </script>

 
</body>

</html>