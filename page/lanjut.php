<?php
  $sql_pl = "SELECT pl.* FROM pembeli pl WHERE pl.id_pembeli = :id_pembeli";
  $stmt_pl = $pdo->prepare($sql_pl);
  $stmt_pl->bindValue(':id_pembeli',$_SESSION['id_pembeli']);
  $stmt_pl->execute();
  $row_pl = $stmt_pl->fetch();
?>
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <form class="needs-validation" id="table_keranjang" action="action/keranjang.php?act=checkout" method="post">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Alamat</h3>
                        </div>
                            <div class="mb-3">
                                <label >Kecamatan</label>
                                <select class="form-control show-tick" name="id_ongkir" id="id_ongkir" required>
                                    <option value="" ongkir="0" selected>Pilih</option>
                                    <?php 
                                    $sql = "SELECT * FROM ongkir";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    while($row = $stmt->fetch()){ ?>
                                        <option value="<?=$row['id_ongkir']?>" ongkir="<?=$row['ongkir']?>"><?=$row['kecamatan']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label >Alamat</label>
                                <textarea class="form-control" name="alamat" required></textarea>
                            </div>
                            <hr class="mb-4">
                            <div class="title"> <span>Pembayaran</span> </div>
                            <div class="d-block my-3">
                                <select class="form-control" name="tipe_pembayaran" required>
                                    <option  value="tunai" class="custom-control-input" selected>Tunai</option>
                                    <option  value="transfer" class="custom-control-input" selected>Transfer</option>
                                </select>
                            </div>
                    </div>
                    <div class="title-left">
                        <h3>Transfer Dapat Dilakukan Ke Rekening :</h3>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Bank</th>
                                <th>Atas Nama</th>
                                <th>Nomor Rekening</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                              $sql = "SELECT re.* FROM rekening re ORDER BY re.bank ASC";
                              $stmt = $pdo->prepare($sql);
                              $stmt->execute();
                              while($row = $stmt->fetch()){?>
                              <tr>
                                  <td><?=$row['bank'];?></td>
                                  <td><?=$row['atas_nama'];?></td>
                                  <td><?=$row['nomor_rekening'];?></td>
                              </tr>
                              <?php 
                            } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <?php
                                  $sql = "SELECT gh.Total FROM gethargatotal gh WHERE gh.id_pesanan = (SELECT pe.id_pesanan FROM pesanan pe WHERE pe.status = 'pesan' AND pe.id_pembeli = :id_pembeli)";
                                  $stmt = $pdo->prepare($sql);
                                  $stmt->bindValue(':id_pembeli',$_SESSION['id_pembeli']);
                                  $stmt->execute();
                                  $row = $stmt->fetch();
                                  $total = $row['Total'];
                                  ?>
                                <div class="title-left">
                                    <h3>Pesanan</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Barang</div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Sub Total</h4>
                                    <div class="ml-auto font-weight-bold">Rp <?=number_format($row['Total'], 2, ",", ".")?></div>
                                </div>
                                <div class="d-flex">
                                    <h4>Ongkir</h4>
                                    <div class="ml-auto font-weight-bold" id="ongkir">Rp. 0,00</div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Total</h5>
                                    <div class="ml-auto h5" id="total">Rp <?=number_format($row['Total'], 2, ",", ".")?></div>
                                </div>
                                <hr> 
                            </div>
                        </div>
                        <div class="col-12 d-flex shopping-box"> 
                            <button type="submit" class="ml-auto btn hvr-hover">Lanjut</button> 
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </form>
    </div>
    <!-- End Cart -->
    
<script>
  $('#id_ongkir').on('change', function() {
    console.log($('option:selected', this).attr('ongkir'));
    var	reverse = $('option:selected', this).attr('ongkir').toString().split('').reverse().join(''),
	ribuan 	= reverse.match(/\d{1,3}/g);
	ribuan	= ribuan.join('.').split('').reverse().join('');
    $("#ongkir").text('Rp. ' + ribuan +',00');
    var sub_total = <?=$total?>;
    var total = parseInt(sub_total, 10) +  parseInt($('option:selected', this).attr('ongkir'), 10);
    console.log(total);
    var	reverse_total = total.toString().split('').reverse().join(''),
	ribuan_total 	= reverse_total.match(/\d{1,3}/g);
	ribuan_total	= ribuan_total.join('.').split('').reverse().join('');
    $("#total").text('Rp. ' + ribuan_total +',00');
  });
  
</script>