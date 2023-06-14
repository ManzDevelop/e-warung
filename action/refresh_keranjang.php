<?php

require_once dirname(__FILE__) . "/../config.php"; ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Quantity</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  $sql = "SELECT pr.nama,pr.id_barang,pr.gambar,pr.harga,pd.quantity FROM pesanan pe INNER JOIN pesanan_detail pd ON pe.id_pesanan = pd.id_pesanan LEFT JOIN barang pr ON pd.id_barang = pr.id_barang LEFT JOIN kategori ka ON pr.id_kategori = ka.id_kategori WHERE pe.status = 'pesan' AND pe.id_pembeli = :id_pembeli ORDER BY pr.nama ASC";
                                  $stmt = $pdo->prepare($sql);
                                  $stmt->bindValue(':id_pembeli',$_SESSION['id_pembeli']);
                                  $stmt->execute();
                                  $i = 0;
                                  while($row = $stmt->fetch()){?>
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
									<img class="img-fluid" src="<?=BASE_URL.$row['gambar'];?>" alt="" />
								</a>
                                    </td>
                                    <td class="name-pr">
                                        <?=$row['nama'];?>
                                    </td>
                                    <td class="price-pr">
                                        <p><?=$row['harga'];?></p>
                                    </td>
                                    <td class="quantity-box"><input type="number" size="4" name="quantity[]" id="quantity_<?=$row['id_barang']?>" min="1" class="form-control" style="width:100px" value="<?=$row['quantity'];?>" max="<?=$max_ukuran?>" data-validation-allowing="range[1;<?=$max_ukuran?>]" data-validation-error-msg="Kurang Stok" data-id="<?=$row['id_barang']?>" step="1" class="c-input-text qty text"></td>
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