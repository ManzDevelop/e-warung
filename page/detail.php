<div class="container" style="margin-bottom:100px">
<?php
  if (isset($_GET['id']) && $_GET['id'] != '') {
  $id = $_GET['id'];
  $sql = "SELECT pr.*,k.nama AS nama_kategori FROM barang pr LEFT JOIN kategori k ON pr.id_kategori = k.id_kategori WHERE pr.id_barang = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id',$id);
  $stmt->execute();
  $row = $stmt->fetch();
?>

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <img class="d-block w-50" src="<?=BASE_URL.$row['gambar']?>" alt="First slide">
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2><?=$row['nama']?></h2>
                        <h5>Rp <?=number_format($row['harga'], 2, ",", ".")?></h5>
						<h4>Keterangan :</h4>
						<p><?=$row['keterangan']?></p>
						<ul>
							<li>
								<div class="form-group quantity-box">
									<label class="control-label">Quantity</label>
									<input class="form-control" value="1" min="1" max="<?=$row['stok']?>" type="number">
								</div>
							</li>
						</ul>

						<div class="price-box-bar">
							<div class="cart-and-bay-btn">
								<a class="btn hvr-hover" data-fancybox-close="" href="action/keranjang.php?id=<?=$row['id_barang']?>&act=add">+ Keranjang</a>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->
<?php } ?>