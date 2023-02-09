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
      <li class="nav-item active">
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
            <h1 class="h3 mb-0 text-gray-800">Halaman Daftar Users</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Users</li>
              <li class="breadcrumb-item active" aria-current="page">Daftar</li>
            </ol>
          </div>

          <!-- Main -->
          <div class="row">
            <div class="col-lg-12">

              <div class="pb-3">
                <button class="btn btn-success" data-toggle="modal" data-target="#tambahUserBaru"><i class="fa fa-plus-square"></i> Tambah User Baru</button>
              </div>

              <div class="card mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Daftar Users</h6>
                </div>
                <div class="table-responsive p-3">
                  <table id="daftarUsers" class="table align-items-center table-flush table-hover">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th>No.</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Input By</th>
                        <th>Tgl Input</th>
                        <th>Tgl Update</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php $no=1; foreach ($user as $row): ?>
                      <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $row->username ?></td>
                        <td><?= $row->role ?></td>
                        <td><?php ($row->status == '1') ? 'ENABLE' : 'DISABLED' ?></td>
                        <td><?= $row->created_by ?></td>
                        <td><?= $row->created_at ?></td>
                        <td><?= $row->updated_at ?></td>
                        <td>
                          <a href="<?= base_url() ?>admin/user/<?= $row->id ?>" class="btn btn-sm btn-info"><i class="fa fa-list"></i> Detail</a>
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
  <div class="modal fade" id="tambahUserBaru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Tambah User Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="./tambah_user" method="POST">
          <div class="modal-body">
            <div class="form-group row">
              <label for="inputUsername" class="col-sm-3 col-form-label">Username</label>
              <div class="col-sm-9">
                <input name="username" type="text" class="form-control" id="inputUsername" placeholder="Input username" required autofocus>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
              <div class="col-sm-9">
                <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Input password" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputKonfPassword" class="col-sm-3 col-form-label">Konfirmasi Password</label>
              <div class="col-sm-9">
                <input name="konf_password" type="password" class="form-control" id="inputKonfPassword" placeholder="Input konfirmasi password" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputRole" class="col-sm-3 col-form-label">Role User</label>
              <div class="col-sm-9">
                <select class="form-control" name="role" id="inputRole" required>
                  <option value="" disabled-selected hidden>--Pilih Role User--</option>
                  <option value="ADMIN">ADMIN</option>
                  <option value="KASIR">KASIR</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin simpan user abru ini?')">Simpan</button>
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