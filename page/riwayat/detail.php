<?php
  if(!isset($_SESSION["username"])){?>
    <script>
      window.location.replace("<?php echo BASE_URL; ?>?page=login");
    </script>
  <?php 
  } ?>
  
  <?php
        if (isset($_GET['id']) && $_GET['id'] != '') {
          $id = $_GET['id'];
          $sql = "SELECT pe.id_pesanan,pe.status,pe.status AS status_pesanan,pb.status AS status_pembayaran,pe.kecamatan,pb.tipe_pembayaran,                  pl.nama,pl.username,pl.telepon,pl.alamat,pe.ongkir,(SELECT kr.nama FROm kurir kr WHERE kr.id_kurir = pe.id_kurir) AS nama_kurir,pe.alamat AS alamat_tujuan,pb.total_harga,
                  (SELECT SUM((SELECT (pr.harga * pd.quantity) FROM barang pr WHERE pr.id_barang = pd.id_barang)) 
                  FROM pesanan_detail pd WHERE pd.id_pesanan = pe.id_pesanan) as total_harga_barang 
                  FROM pesanan pe LEFT JOIN pembeli pl ON pe.id_pembeli = pl.id_pembeli LEFT JOIN pembayaran pb ON pe.id_pesanan = pb.id_pesanan 
                  WHERE pe.id_pesanan = :id";
          $stmt = $pdo->prepare($sql);
          $stmt->bindValue(':id',$id);
          $stmt->execute();
          $row = $stmt->fetch();
          ?>
          
      <div class="shop-detail-box-main">
        <div class="container">
          <div class="card">
            <div class="card-heading bg-info">
              <h2 style="text-align:center">Pembeli</h2>
            </div>
            <div class="card-body">
              <ul class="" style="list-style: none; padding-inline-start: 0px;">
                <li>
                  Username
                  <span class="pull-right "><?=$row['username']?></span>
                </li>
                <li>
                  Nama
                  <span class="pull-right "><?=$row['nama']?></span>
                </li>
                <li>
                  Telepon
                  <span class="pull-right "><?=$row['telepon']?></span>
                </li>
                <li>
                  Alamat
                  <span class="pull-right "><?=$row['alamat']?></span>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="card">
            <div class="card-heading bg-warning">
              <h2 style="text-align:center">Barang</h2>
            </div>
            <div class="card-body">
              <?php
                $sql_d = "SELECT pr.id_barang,pr.nama,pr.harga,pr.gambar,pr.keterangan,pr.stok,pr.tanggal,ka.nama AS nama_kategori,pd.quantity FROM pesanan_detail pd LEFT JOIN barang pr ON pd.id_barang = pr.id_barang LEFT JOIN kategori ka ON pr.id_kategori = ka.id_kategori WHERE pd.id_pesanan = :id ORDER BY pr.nama ASC";
                $stmt_d = $pdo->prepare($sql_d);
                $stmt_d->bindValue(':id',$id);
                $stmt_d->execute();
                $i = 1;
                while($row_d = $stmt_d->fetch()){?>
                  <div class="row">
                    <div class="col-12 col-md-2">
                      <img class="img-fluid" src="<?=BASE_URL.$row_d["gambar"];?>" width="100px" height="auto">
                    </div>
                    <div class="col-12 col-md-10">
                      <ul class="" style="list-style: none;    padding-inline-start: 0px;">
                        <li>
                          Nama
                          <span class="pull-right "><?=$row_d['nama']?></span>
                        </li>
                        <li>
                          Harga
                          <span class="pull-right ">Rp <?=number_format($row_d['harga'], 2, ",", ".")?></span>
                        </li>
                        <li>
                          Keterangan
                          <span class="pull-right "><?=$row_d['keterangan']?></span>
                        </li>
                        <li>
                          Kategori
                          <span class="pull-right "><?=$row_d['nama_kategori']?></span>
                        </li>
                        <li>
                          Quantity
                          <span class="pull-right "><?=$row_d['quantity']?></span>
                        </li>
                        <li>
                          Total Harga Barang
                          <span class="pull-right ">Rp <?=number_format($row_d['harga'] * $row_d['quantity'], 2, ",", ".")?></span>
                        </li>
                      </ul>
                    </div>
                  </div>
                <?php $i++;}?>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="card">
            <div class="card-heading bg-primary">
              <h2 style="text-align:center">Total</h2>
            </div>
            <div class="card-body">
              <ul class="" style="list-style: none;    padding-inline-start: 0px;">
                <li>
                  Status Pemesanan
                  <span class="pull-right ">
                  <?=$row['status_pesanan']?>
                  </span>
                </li>
                <?php if(isset($row['tipe_pembayaran'])){ ?>
                <li>
                  Tipe Pembayaran
                  <span class="pull-right ">
                  <?=$row['tipe_pembayaran']?>
                  </span>
                </li>
                <?php } ?>
                <?php if(isset($row['status_pembayaran'])){ ?>
                <li>
                  Status Pembayaran
                  <span class="pull-right ">
                  <?=$row['status_pembayaran']?>
                  </span>
                </li>
                <?php } ?>
                <li>
                  Total Harga Barang
                  <span class="pull-right ">
                  Rp <?=number_format($row['total_harga_barang'], 2, ",", ".")?>
                  </span>
                </li>
                <?php if(isset($row['ongkir'])){ ?>
                <li>
                  Ongkir
                  <span class="pull-right">
                  Rp <?=number_format($row['ongkir'], 2, ",", ".")?>
                  </span>
                </li>
                <?php } ?>
                <?php if(isset($row['alamat_tujuan'])){ ?>
                <li>
                  Alamat Tujuan
                  <span class="pull-right">
                  <?=$row['alamat_tujuan'];?>
                  </span>
                </li>
                <?php } ?>
                <?php if(isset($row['kecamatan'])){ ?>
                <li>
                  Kecamatan
                  <span class="pull-right">
                  <?=$row['kecamatan'];?>
                  </span>
                </li>
                <?php } ?>
                <li>
                  Total Harga
                  <span class="pull-right">
                  Rp <?=number_format($row['total_harga_barang']+$row['ongkir'], 2, ",", ".")?>
                  </span>
                </li>
              <ul>
            </div>
          </div>
        </div>
        <?php if($row['tipe_pembayaran'] == 'tunai' AND $row['status_pembayaran'] == 'COD' AND  $row['status_pesanan'] == 'dikirim'){ ?>
        <div class="container">
          <div class="card">
            <div class="card-heading bg-success">
              <h2 style="text-align:center">Pembayaran</h2>
            </div>
            <div class="card-body">
        <form class="needs-validation" id="table_keranjang" action="action/pembayaran_riwayat.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_pesanan" value="<?=$row['id_pesanan']?>">
              <ul class="" style="list-style: none; padding-inline-start: 0px;">
                <li>
                  Silakan Melakukan Pembayaran Kepada Kurir Sebesar
                  <span class="pull-right ">Rp <?=number_format($row['total_harga'], 2, ",", ".")?></span>
                </li>
                <li>
                  Barang Sedang <?php
                                        if($row['status'] == 'menunggu'){
                                            echo 'Menunggu Dikirimkan';
                                        }else if($row['status'] == 'dikirim'){
                                            echo 'Dikirimkan Ke Tempat';
                                        }
                                    ?>
                </li>
                <li>
                    <?php if($row['status'] == 'dikirim'){ ?>
                        <div class="col-12 d-flex shopping-box"> 
                            <button type="submit" class="ml-auto btn hvr-hover btn-primary">Diterima</button> 
                        </div>
                    <?php } ?>
                </li>
              </ul>
        </form>
            </div>
          </div>
        </div>
   
        <?php } ?>
        <?php if($row['tipe_pembayaran'] == 'transfer' AND  $row['status_pesanan'] == 'dikirim'){ ?>
        <div class="container">
          <div class="card">
            <div class="card-heading bg-success">
              <h2 style="text-align:center">Barang Diterima</h2>
            </div>
            <div class="card-body">
        <form class="needs-validation" id="table_keranjang" action="action/pembayaran_riwayat.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_pesanan" value="<?=$row['id_pesanan']?>">
              <ul class="" style="list-style: none; padding-inline-start: 0px;">
                <li>
                  Barang Sedang <?php
                                        if($row['status'] == 'menunggu'){
                                            echo 'Menunggu Dikirimkan';
                                        }else if($row['status'] == 'dikirim'){
                                            echo 'Dikirimkan Ke Tempat';
                                        }
                                    ?>
                </li>
                <li>
                    <?php if($row['status'] == 'dikirim'){ ?>
                        <div class="col-12 d-flex shopping-box"> 
                            <button type="submit" class="ml-auto btn hvr-hover btn-primary">Diterima</button> 
                        </div>
                    <?php } ?>
                </li>
              </ul>
        </form>
            </div>
          </div>
        </div>
   
        <?php } ?>
    </div>
<?php } ?>