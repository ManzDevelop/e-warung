<?php
  $sql_pl = "SELECT pl.* FROM pembeli pl WHERE pl.id_pembeli = :id_pembeli";
  $stmt_pl = $pdo->prepare($sql_pl);
  $stmt_pl->bindValue(':id_pembeli',$_SESSION['id_pembeli']);
  $stmt_pl->execute();
  $row_pl = $stmt_pl->fetch();

  $sql_check = "SELECT pd.id_pesanan,pd.kecamatan,pd.alamat,pd.status FROM pesanan pd WHERE pd.id_pembeli=:id_pembeli ORDER BY pd.tanggal DESC LIMIT 1";
  $stmt_check = $pdo->prepare($sql_check);
  $stmt_check->bindValue(':id_pembeli',$_SESSION['id_pembeli']);
  $stmt_check->execute();
  $row_check = $stmt_check->fetch();

  $sql_total = "SELECT pb.* FROM pembayaran pb WHERE pb.id_pesanan=:id_pesanan";
  $stmt_total = $pdo->prepare($sql_total);
  $stmt_total->bindValue(':id_pesanan',$row_check['id_pesanan']);
  $stmt_total->execute();
  $row_total = $stmt_total->fetch();
  
    if($row_total['tipe_pembayaran'] == 'tunai'){?>
        
<!-- Start Cart  -->
    <div class="cart-box-main">
        <form class="needs-validation" id="table_keranjang" action="action/pembayaran.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_pesanan" value="<?=$row_check['id_pesanan']?>">
        <input type="hidden" name="tipe_pembayaran" value="tunai">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Alamat</h3>
                        </div>
                            <div class="mb-3">
                                <label >Kecamatan</label>
                                <input name="kecamatan" type="text" value="<?=$row_check['kecamatan']?>" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label >Alamat</label>
                                <textarea class="form-control" name="alamat" readonly><?=$row_check['alamat']?></textarea>
                            </div>
                            <hr class="mb-4">
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Pembayaran</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Silakan Melakukan Pembayaran Sebesar</div>
                                    <div class="ml-auto font-weight-bold">Rp <?=number_format($row_total['total_harga'], 2, ",", ".")?></div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Kepada Kurir</h4>
                                </div>
                                <div class="d-flex">
                                    <h4>Barang Sedang <?php
                                        if($row_check['status'] == 'menunggu'){
                                            echo 'Menunggu Dikirimkan';
                                        }else if($row_check['status'] == 'dikirim'){
                                            echo 'Dikirimkan Ke Tempat';
                                        }
                                    ?></h4>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <?php if($row_check['status'] == 'menunggu'){ ?>
                            <div class="col-12 d-flex shopping-box"> 
                                <button type="submit" class="ml-auto btn hvr-hover btn-primary">Proses</button> 
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
        </form>
    </div>
 
    <!-- End Cart -->
    <?php }else if($row_total['tipe_pembayaran'] == 'transfer'){ ?>
        
<!-- Start Cart  -->
    <div class="cart-box-main">
        <form class="needs-validation" id="table_keranjang" action="action/pembayaran.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_pesanan" value="<?=$row_check['id_pesanan']?>">
        <input type="hidden" name="tipe_pembayaran" value="transfer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Alamat</h3>
                        </div>
                            <div class="mb-3">
                                <label >Kecamatan</label>
                                <input name="kecamatan" type="text" value="<?=$row_check['kecamatan']?>" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label >Alamat</label>
                                <textarea class="form-control" name="alamat" readonly><?=$row_check['alamat']?></textarea>
                            </div>
                            <hr class="mb-4">
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Pembayaran</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Silakan Melakukan Pembayaran Sebesar</div>
                                    <div class="ml-auto font-weight-bold">Rp <?=number_format($row_total['total_harga'], 2, ",", ".")?></div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4 class="col-sm-2">Kepada</h4>
                                    <select id="id_rekening" class="form-control col-sm-10" name="id_rekening" required="required">
                                      <option value="">Pilih Rekening</option>
                                      <?php
                                        $sql = "SELECT re.* FROM rekening re ORDER BY re.bank ASC ";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute();
                                        while ($row = $stmt->fetch()) { ?>
                                          <option value="<?=$row['id_rekening']?>"><?=$row['bank']." - ".$row['atas_nama']?></option>
                                        <?php }
                                      ?>
                                    </select>
                                </div>
                                <div class="d-flex">
                                    <h4 class="col-sm-2">Bukti</h4>
                                      <input type="file" name="gambar" class="form-control col-sm-10" accept="image/*" required="required">
                                </div>
                                <div class="d-flex">
                                    <h4>Bayarlah sesuai dengan <?php
                                        if($row_check['status'] == 'menunggu'){
                                            echo 'Pesanan';
                                        }else if($row_check['status'] == 'dikirim'){
                                            echo 'Dikirimkan Ke Tempat';
                                        }
                                    ?></h4>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="col-12 d-flex shopping-box"> 
                            <button type="submit" class="ml-auto btn hvr-hover btn-primary">Bayar</button> 
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </form>
    </div>
    <?php }
?>