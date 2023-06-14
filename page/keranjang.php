<?php
  if(!isset($_SESSION["username"])){?>
    <script>
      window.location.replace("<?php echo BASE_URL; ?>?page=login");
    </script>
  <?php 
  }else{
    $sql_check = "SELECT pd.id_pesanan,pd.status FROM pesanan pd WHERE pd.id_pembeli=:id_pembeli  ORDER BY pd.tanggal DESC LIMIT 1";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->bindValue(':id_pembeli',$_SESSION['id_pembeli']);
    $stmt_check->execute();
    $row_check = $stmt_check->fetch();
    // print_r($row_check);
    if ($row_check['status'] == 'menunggu') {?>
      <script>
        window.location.replace("<?php echo BASE_URL; ?>?page=pembayaran");
      </script>
    <?php }
?>
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <form enctype="multipart/form-data" id="table_keranjang" action="action/keranjang.php?act=lanjut" method="post">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama</th>
				    <th>Stok Tersedia</th>
                                    <th>Harga</th>
                                    <th>Quantity</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  $sql = "SELECT pr.nama,pr.id_barang,pr.gambar,pr.harga,pr.stok,pd.quantity FROM pesanan pe INNER JOIN pesanan_detail pd ON pe.id_pesanan = pd.id_pesanan LEFT JOIN barang pr ON pd.id_barang = pr.id_barang LEFT JOIN kategori ka ON pr.id_kategori = ka.id_kategori WHERE pe.status = 'pesan' AND pe.id_pembeli = :id_pembeli ORDER BY pr.nama ASC";
                                  $stmt = $pdo->prepare($sql);
                                  $stmt->bindValue(':id_pembeli',$_SESSION['id_pembeli']);
                                  $stmt->execute();
                                  $i = 0;
                                  while($row = $stmt->fetch()){?>
                          <input type="hidden" name="id_barang[]" value="<?=$row['id_barang']?>">
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
									<img class="img-fluid" src="<?=BASE_URL.$row['gambar'];?>" alt="" />
								</a>
                                    </td>
                                    <td class="name-pr">
                                        <?=$row['nama'];?>
                                    </td>
                                    <td class="name-pr">
                                        <?=$row['stok'];?>
                                    </td>
                                    <td class="price-pr">
                                        <p>Rp <?=number_format($row['harga'], 2, ",", ".")?></p>
                                    </td>
                                    <td class="quantity-box"><input type="number" size="4" name="quantity[]" id="quantity_<?=$row['id_barang']?>" min="1" class="form-control" style="width:100px" value="<?=$row['quantity'];?>" max="<?=$row['stok']?>" data-id="<?=$row['id_barang']?>" step="1" class="c-input-text qty text"></td>
                                    <td class="remove-pr">
                                        <button type="button" class="btn btn-danger" id="<?php echo $row["id_barang"]; ?>" onclick="return Delete(this)"><i class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                      <?php $i++;
                    } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-12 d-flex shopping-box">
                <?php if ($i!=0) { ?>
                  <button type="submit" class="ml-auto btn hvr-hover">Lanjut</button>
                <?php }?>
                </div>
            </div>
            </form>

        </div>
    </div>
    <!-- End Cart -->
      <script>
        function Delete(temp) {
          var jawab = confirm("Anda Yakin Akan Menghapus Data ?");
          if (jawab == true) {
            var id = temp.getAttribute("id");  
            $.ajax({  
                url:"page/keranjang/action/delete.php",  
                method:"post",  
                data:{id:id},  
                success:function(data){  
                  console.log(data);
                  $('#table_keranjang').load('action/refresh_keranjang.php');
                } 
            }); 
          }
        }
      </script>
  <?php } ?>