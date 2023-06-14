<?php
if (isset($_GET['id']) && $_GET['id'] != '') {
  $id = $_GET['id'];
  $sql = "SELECT pe.id_pesanan,pe.status,pl.nama, pl.username, pl.telepon, pl.alamat, pe.ongkir, pe.alamat AS alamat_tujuan,
  (SELECT SUM((SELECT (pr.harga * pd.quantity) FROM barang pr WHERE pr.id_barang = pd.id_barang)) 
  FROM pesanan_detail pd WHERE pd.id_pesanan = pe.id_pesanan) as total_harga_barang, pe.kecamatan AS kecamatan_tujuan , pb.tipe_pembayaran
  FROM pesanan pe LEFT JOIN pembeli pl ON pe.id_pembeli = pl.id_pembeli LEFT JOIN pembayaran pb ON pb.id_pesanan = pe.id_pesanan
  WHERE pe.id_pesanan = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id',$id);
  $stmt->execute();
  $row = $stmt->fetch();
  ?>
        <div class="container-fluid">
            <!-- Basic Example -->
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
                        <div class="header bg-red">
                            <h2>
                                Pembeli
                            </h2>
                        </div>
                        <div class="body">
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
                                <li>
                                  Status
                                  <span class="pull-right "><?=ucfirst($row['status'])?></span>
                                </li>
                              </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                Barang
                            </h2>
                        </div>
                        <div class="body">
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
                                      <span class="pull-right ">Rp. <?=number_format($row_d['harga'], 2, ",", ".")?></span>
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
                                      <span class="pull-right ">Rp. <?=(number_format($row_d['harga'] * $row_d['quantity'], 2, ",", "."))?></span>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            <?php $i++;}?>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                Total
                            </h2>
                        </div>
                        <div class="body">
                          <ul class="" style="list-style: none;    padding-inline-start: 0px;">
                            <li>
                              Total Harga Produk
                              <span class="pull-right ">
                              Rp. <?=number_format($row['total_harga_barang'], 2, ",", ".")?>
                              </span>
                            </li>
                            <li>
                              Ongkir
                              <span class="pull-right">
                              Rp. <?=number_format($row['ongkir'], 2, ",", ".")?>
                              </span>
                            </li>
                            <li>
                              Alamat Tujuan
                              <span class="pull-right">
                              <?=$row['alamat_tujuan'];?>
                              </span>
                            </li>
                            <li>
                              Kecamatan Tujuan
                              <span class="pull-right">
                              <?=$row['kecamatan_tujuan'];?>
                              </span>
                            </li>
                            <li>
                              Total Harga
                              <span class="pull-right">
                              Rp. <?=number_format($row['total_harga_barang']+$row['ongkir'], 2, ",", ".")?>
                              </span>
                            </li>
                            <li>
                              Tipe Pembayaran
                              <span class="pull-right">
                              <?=ucfirst($row['tipe_pembayaran']);?>
                              </span>
                          <ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
<?php } ?>