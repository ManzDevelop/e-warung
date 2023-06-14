<?php
if (isset($_GET['id']) && $_GET['id'] != '') {
  $id = $_GET['id'];
  $sql = "SELECT pe.id_pembeli,pb.id_pembayaran,pe.status,pb.id_pesanan,pb.status AS status_pembayaran,pb.tanggal AS tanggal_pembayaran,pb.total_harga,pb.foto_transfer,pe.kecamatan AS kecamatan_tujuan,pb.tipe_pembayaran,
  ((SELECT SUM((SELECT (pr.harga * pd.quantity) FROM barang pr WHERE pr.id_barang = pd.id_barang)) FROM pesanan_detail pd WHERE pd.id_pesanan = pe.id_pesanan AND pd.id_barang)) as total_harga_barang,pe.ongkir,  
  re.bank,re.atas_nama,re.nomor_rekening,pe.alamat AS alamat_tujuan,pb.total_harga,pb.total_dibayar 
  FROM pembayaran pb LEFT JOIN pesanan pe ON pb.id_pesanan = pe.id_pesanan LEFT JOIN rekening re ON pb.id_rekening = re.id_rekening WHERE pb.id_pembayaran = :id ORDER BY pb.tanggal DESC";
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
                              <?php
                                $sql_pl = "SELECT pl.alamat,pl.username,pl.nama,pl.telepon,pl.alamat FROM pembeli pl WHERE pl.id_pembeli 
                                = (SELECT pe.id_pembeli FROM pesanan pe WHERE pe.id_pesanan = :id)";
                                $stmt_pl = $pdo->prepare($sql_pl);
                                $stmt_pl->bindValue(':id',$row['id_pesanan']);
                                $stmt_pl->execute();
                                $row_pl = $stmt_pl->fetch();
                              ?>
                            <ul class="" style="list-style: none; padding-inline-start: 0px;">
                                <li>
                                  Username
                                  <span class="pull-right "><?=$row_pl['username']?></span>
                                </li>
                                <li>
                                  Nama
                                  <span class="pull-right "><?=$row_pl['nama']?></span>
                                </li>
                                <li>
                                  Telepon
                                  <span class="pull-right "><?=$row_pl['telepon']?></span>
                                </li>
                                <li>
                                  Alamat
                                  <span class="pull-right "><?=$row_pl['alamat']?></span>
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
                            $stmt_d->bindValue(':id',$row['id_pesanan']);
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
                
        <?php if (isset($row['foto_transfer']) && $row['foto_transfer'] != '' && $row['tipe_pembayaran'] == 'transfer') { ?>
        <div class="col-12">
                    <div class="card">
                        <div class="header bg-orange">
                            <h2>
                                Transfer
                            </h2>
                        </div>
                        <div class="body">
                          <ul class="" style="list-style: none; padding-inline-start: 0px;">
                              <li>
                                Foto Transfer
                                <img class="img-fluid" src="<?=BASE_URL.$row['foto_transfer'];?>" width="500px" height="auto">
                              </li>
                              <li>
                                Bank
                                <span class="pull-right "><?=$row['bank']?></span>
                              </li>
                              <li>
                                Atas Nama
                                <span class="pull-right "><?=$row['atas_nama']?></span>
                              </li>
                              <li>
                                Nomor Rekening
                                <span class="pull-right "><?=$row['nomor_rekening']?></span>
                              </li>
                            </ul>
                        </div>
                    </div>
                </div>
        <?php } ?>
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
                            </li>
                            </li>
                            <?php 
                            if ($row['total_dibayar'] != null || $row['total_dibayar'] != '') { ?>
                            <li>
                              Total Dibayar
                              <span class="pull-right">
                              <?=$row['total_dibayar'];?>
                              </span>
                            </li>
                            <li>
                              Tanggal Pembayaran
                              <span class="pull-right">
                              <?=$row['tanggal_pembayaran'];?>
                              </span>
                            </li>
                            <li>
                              Status Pembayaran
                              <span class="pull-right">
                              <?=$row['status_pembayaran'];?>
                              </span>
                            </li>
                            <?php
                              } ?>
                          <ul>
                        </div>
                    </div>
                </div>
                
                <?php if($row['tipe_pembayaran'] == 'tunai' && $row['status'] == 'diterima' && $row['status_pembayaran'] == 'belum'){ ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="header bg-orange">
                                <h2>
                                    Terima Pembayaran
                                </h2>
                            </div>
                            <div class="body">
                                <form role="form" action="page/pembayaran/action/terima.php" method="POST">
                                    <input type="hidden" name="id" value="<?=$id?>">
                                      Total Dibayar
                                      <span class="pull-right ">
                                        <input type="number" class="form-control" name="total_dibayar" id="" required="required" min=<?=$row['total_harga_barang']+$row['ongkir'];?>  data-validation="number" data-validation-error-msg="Pembayaran Kurang">
                                      </span>
                                    <button type="submit" class="btn btn-warning btn-block btn-oval">Terima</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
<?php } ?>