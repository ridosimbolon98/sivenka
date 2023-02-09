<?php include (APPPATH.'views/kasir/components/header.php'); ?>

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
      <li class="nav-item">
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
      <li class="nav-item active">
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
            <h1 class="h3 mb-0 text-gray-800">Halaman Detail Invoice</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Invoice</li>
              <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
          </div>

          <!-- Main -->
          <div class="row">
            <div class="col-lg-12">

              <div class="pb-3">
                <button class="btn btn-success" onclick="window.print()"><i class="fa fa-print"></i> Cetak</button>
              </div>

              <div id="section-to-print" class="card mb-3">
                <div class="table-responsive p-3">
                  <div id="detail_unit" class="py-2 text-center">
                    <?php foreach($data_pt as $row): ?>
                      <p class="text-lead font-weight-bold"><?= $row->nama ?></p>
                      <span class="">Alamat: <?= $row->alamat ?>, Email: <?= $row->email ?>, Fax/Telp:<?= $row->fax ?>, No HP: <?= $row->no_hp ?> </span>
                    <?php endforeach ?>
                  </div>
                  <hr>
                  <div id="header-inv" class="bg-primary p-2 my-1 ">
                    <span class="text-white">No Invoice: <?= $no_inv ?></span>
                    <span class="text-white float-lg-right">Tanggal: <?= $invoice[0]->tgl_input ?></span>
                  </div>
                  <table class="table align-items-center table-flush table-hover">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th>No.</th>
                        <th>Invoice</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; foreach($transaksi as $row): ?>
                        <tr>
                          <td class="text-center"><?= $no++ ?></td>
                          <td class="text-center"><?= $row->invoice ?></td>
                          <td class="text-center"><?= $row->nama_produk ?></td>
                          <td class="text-center"><?= number_format($row->harga_jual,2,",",".") ?></td>
                          <td class="text-center"><?= $row->jumlah ?></td>
                          <td class="subtotal text-center"><?= number_format($row->subtotal,2,",",".") ?></td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
                <hr>
                <div id="cardTotal" class="card p-2 m-3 bg-primary text-light">
                  <div class="row">
                    <div class="col-md-4 cm4">Sub Total</div>
                    <div class="col-md-8 cm8">:
                      <span hidden id="total"></span><span id="total1"></span>
                    </div>
  
                    <div class="col-md-4 cm4">PPN 11%</div>
                    <div class="col-md-8 cm8">:
                      <span hidden id="ppn"></span><span id="ppn1"></span>
                    </div>
                    
                    <div class="col-md-4 cm4">Total</div>
                    <div class="col-md-8 cm8">:
                      <span hidden id="total_ppn"></span><span id="total_ppn1"></span>
                    </div>
                  </div>
                </div>
                <!-- <div class="py-3 px-4 foot card">
                  <div class="float-lg-right">
                    <p class="font-weight-bold row dataTotalTax">
                      <span class="col-md-5">Sub Total</span>
                      <span class="col-md-2">:</span>
                      <span class="col-md-5" id="total1"></span>
                      <span hidden id="total"></span>
                    </p>
                    <p class="font-weight-bold row dataTotalTax">
                      <span class="col-md-5">PPN *11%</span>
                      <span class="col-md-2">:</span>
                      <span class="col-md-5" id="ppn1"></span>
                      <span hidden id="ppn"></span>
                    </p>
                    <p class="font-weight-bold row dataTotalTax">
                      <span class="col-md-5">Total</span>
                      <span class="col-md-2">:</span>
                      <span class="col-md-5" id="total_ppn1"></span>
                      <span hidden id="total_ppn"></span>
                    </p>
                  </div>
                </div> -->

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
      $('#daftarInvoice').DataTable(); 
    });
  </script>

  <script>
    let b_url = window.location.origin + "/sivenka/";

    // hitung jumlah tagihan
    $(document).ready(function () {
      let sub_total = $("#inputHarga").val() * $("#inputJumlah").val();
      $("#inputSubTotal").val(sub_total);

      // hitung sub total
      var sum = 0;
      $(".subtotal").each(function(){
        sum += parseFloat($(this).text());
      });
      $('#total1').text(parseInt(sum).toLocaleString("id-ID", {style:"currency", currency:"IDR"}));
      $('#total').text(sum);
      
      // hitung ppn
      let ppn = (parseFloat($('#total').text()) * 0.11);
      $('#ppn1').text(parseInt(ppn).toLocaleString("id-ID", {style:"currency", currency:"IDR"}));
      $('#ppn').text(ppn);
      
      // hitung total
      let ttl = (parseFloat($('#total').text()) + ppn);
      $('#total_ppn1').text(parseInt(ttl).toLocaleString("id-ID", {style:"currency", currency:"IDR"}));
      $('#total_ppn').text(ttl);
    });
  </script>
</body>

</html>