
    <!-- Start Products  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Barang - Barang</h1>
                    </div>
                </div>
            </div>

            <div class="row special-list">
                <?php
                    $sql = "SELECT * FROM barang ORDER by barang.id_barang DESC LIMIT 5";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $i = 0;
                    while($row = $stmt->fetch()){?>
                        <div class="col-lg-3 col-md-6 special-grid best-seller">
                        <div class="products-single fix">
                            <div class="box-img-hover">
                                <img src="<?=BASE_URL.$row['gambar']?>" class="img-fluid" alt="Image">
                            </div>
                            <div class="why-text">
                                <h4><?=$row['nama']?></h4>
                                <h4>Rp <?=number_format($row['harga'], 2, ",", ".")?></h4>
                                <div class="row">
                                    <div class="col-12">
                                        <a href="?page=detail&id=<?=$row['id_barang']?>" class="btn btn-primary button-log">Detail</a>
                                        <a class="btn btn-primary button-log" href="action/keranjang.php?id=<?=$row['id_barang']?>&act=add">+ Keranjang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    <?php }?>
            </div>
        </div>
    </div>
    <!-- End Products  -->