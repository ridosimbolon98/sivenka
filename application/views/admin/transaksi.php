<?php include (APPPATH.'views/admin/components/header.php'); ?>

  <style>
    .dataTotalTax {
      width: 270px !important;
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
      <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('admin/transaksi') ?>">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Transaksi</span></a>
      </li>
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
            <h1 class="h3 mb-0 text-gray-800">Halaman Transaksi</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Transaksi</li>
              <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
            </ol>
          </div>

          <!-- Main -->
          <div class="row">
            <div class="col-lg-4">
              <div class="card mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Form Input</h6>
                </div>
                <div class="card-body">
                  <form action="./tambah_keranjang" method="POST">
                    <div class="form-group row">
                      <label for="inputProduk" class="col-sm-3 col-form-label">Produk</label>
                      <div class="col-sm-9">
                        <input name="produk" list="produk" class="form-control" id="inputProduk" placeholder="--Pilih produk--" required autofocus>
                        <datalist id="produk">
                          <?php foreach($produk as $row): ?>
                            <option value="<?= $row->kode_produk ?>"><?= $row->nama_produk ?></option>
                          <?php endforeach ?>
                        </datalist>
                        <input name="nama_produk" type="text" class="form-control mt-2" id="namaProduk">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputMerk" class="col-sm-3 col-form-label">Merk</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputMerk">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputMerk" class="col-sm-3 col-form-label">Kategori</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputKategori">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputHarga" class="col-sm-3 col-form-label">Stok</label>
                      <div class="col-sm-9">
                        <input type="hidden" name="stock" class="form-control" id="inputStok1">
                        <input type="number" disabled class="form-control" id="inputStok">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputHarga" class="col-sm-3 col-form-label">Harga</label>
                      <div class="col-sm-9">
                        <input name="harga_jual" type="hidden" class="form-control" id="inputHarga">
                        <input name="harga_modal" type="hidden" class="form-control" id="inputHargaModal">
                        <input type="text" class="form-control" id="inputHarga1">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputJumlah" class="col-sm-3 col-form-label">Jumlah</label>
                      <div class="col-sm-9">
                        <input name="jumlah_order" type="number" step="1" min="0" class="form-control" id="inputJumlah" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSubTotal" class="col-sm-3 col-form-label">Sub Total</label>
                      <div class="col-sm-9">
                        <input name="sub_total" type="hidden" class="form-control" id="inputSubTotal">
                        <input type="text" class="form-control" id="inputSubTotal1" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSubTotal" class="col-sm-3 col-form-label"></label>
                      <div class="col-sm-9">
                        <button id="btnTambah" type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-lg-8">
              <div class="card mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Keranjang Belanja</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th>No.</th>
                        <th>Kode</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub Total</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; foreach($keranjang as $row): ?>
                        <tr>
                          <td class="text-center"><?= $no++; ?></td>
                          <td class="text-center"><?= $row->kd_produk ?></td>
                          <td class="text-center"><?= $row->nama_produk ?></td>
                          <td class="text-center"><?= $row->harga_jual ?></td>
                          <td class="text-center"><?= $row->jumlah ?></td>
                          <td class="subtotal text-center"><?= $row->subtotal ?></td>
                          <td class="text-center">
                            <a class="btn btn-sm btn-danger" href="<?= base_url() ?>admin/hapus_produk_keranjang/<?= $row->id_keranjang ?>" onclick="return confirm('Apakah anda yakin hapus produk ini dari keranjang belanja?');"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
                <hr>
                <div class="py-3 px-4">
                  <div class="float-lg-right">
                    <p class="font-weight-bold row dataTotalTax">
                      <span class="col-md-5">Sub Total</span>
                      <span class="col-md-2">:</span>
                      <span class="col-md-5" id="total"></span>
                    </p>
                    <p class="font-weight-bold row dataTotalTax">
                      <span class="col-md-5">PPN *11%</span>
                      <span class="col-md-2">:</span>
                      <span class="col-md-5" id="ppn"></span>
                    </p>
                    <p class="font-weight-bold row dataTotalTax">
                      <span class="col-md-5">Total</span>
                      <span class="col-md-2">:</span>
                      <span class="col-md-5" id="total_ppn"></span>
                    </p>
                  </div>
                </div>

                <!-- pembayaran -->
                <div class="card mb-3 mx-3">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pembayaran</h6>
                  </div>
                  <div class="card-body">
                    <form action="./pembayaran" method="POST">
                      <div class="form-group row">
                        <label for="inputJmlCash" class="col-sm-3 col-form-label">Jumlah Cash</label>
                        <div class="col-sm-9">
                          <input name="jml_cash" type="number" step="1" min="0" class="form-control" id="inputJmlCash" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputKembalian" class="col-sm-3 col-form-label">Kembalian</label>
                        <div class="col-sm-9">
                          <input name="jml_kembalian" type="hidden" class="form-control" id="inputKembalian1">
                          <input type="number" disabled class="form-control" id="inputKembalian" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSubTotal" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                          <button type="submit" class="btn btn-success" onclick="return confirm('Apakah anda yakin proses transaksi?')"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
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

  <script>
    let b_url = window.location.origin + "/sivenka/";
    let kd_prd = document.getElementById("inputProduk");
    let inp_jml = document.getElementById("inputJumlah");
    let inp_pmb = document.getElementById("inputJmlCash");

    // hitung ppn dan total tagihan
    $( document ).ready(function() {
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

    // hitung jumlah tagihan
    inp_jml.addEventListener("input", () => {
      let sub_total = $("#inputHarga").val() * $("#inputJumlah").val();
      $("#inputSubTotal").val(sub_total);
      $("#inputSubTotal1").val(parseInt(sub_total).toLocaleString("id-ID", {style:"currency", currency:"IDR"}));
    });

    // ambil data produk
    kd_prd.addEventListener("input", () => {
      $("#namaProduk").val("");
      $("#inputMerk").val("");
      console.log(kd_prd.value);
      $.ajax({
        type: "GET",
        url: b_url + "admin/get_data_produk/"+kd_prd.value,
        async: false,
        success: function (result) {
          var iter = 0;
          var prd = JSON.parse(result);
          console.log(prd);
          while (iter < prd.length) {
            
            $("#namaProduk").val(prd[iter].nama_produk);
            $("#inputMerk").val(prd[iter].merk_produk);
            $("#inputKategori").val(prd[iter].kategori_produk);
            $("#inputStok").val(prd[iter].jml_stock);
            $("#inputStok1").val(prd[iter].jml_stock);
            $("#inputHarga1").val(parseInt(prd[iter].harga_jual).toLocaleString("id-ID", {style:"currency", currency:"IDR"}));
            $("#inputHarga").val(prd[iter].harga_jual);
            $("#inputHargaModal").val(prd[iter].harga_beli);
            iter++;
          }
        },
      });
    });

    // hitung kembalian pembayaran
    inp_pmb.addEventListener("input", () => {
      let kembalian = inp_pmb.value - $("#total_ppn").text();
      $("#inputKembalian").val(kembalian);
      $("#inputKembalian1").val(kembalian);
    });
    
    // cek apakah jumlah permintaan lebh bersar dari stok
    inp_jml.addEventListener("input", () => {
      let stok = $("#inputStok").val();

      if (inp_jml.value > stok) {
        toastr.warning("Jumlah permintaan tidak boleh lebih besar dari jumlah stok produk");
        $("#inputJumlah").val("");
      }
    });
  </script>

</body>

</html>