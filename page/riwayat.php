<?php
  if(!isset($_SESSION["username"])){?>
    <script>
      window.location.replace("<?php echo BASE_URL; ?>?page=login");
    </script>
  <?php 
  }?>
  <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                      <th>No</th>
                                      <th>Status Pemesanan</th>
                                      <th>Tipe Pembayaran</th>
                                      <th>Status Pembayaran</th>
                                      <th>Kurir</th>
                                      <th>Total Barang</th>
                                      <th>Ongkir</th>
                                      <th>Total Harga</th>
                                      <th>Tanggal</th>
                                      <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  $sql = "SELECT pe.status AS status_pesanan,(SELECT kr.nama FROm kurir kr WHERE kr.id_kurir = pe.id_kurir) AS nama_kurir,pb.status AS status_pembayaran,pe.tanggal,pb.total_harga,pe.id_pesanan,pb.tipe_pembayaran,pe.ongkir
              ,pl.nama,((SELECT SUM((SELECT (pr.harga * pd.quantity) FROM barang pr WHERE pr.id_barang = pd.id_barang)) FROM pesanan_detail pd WHERE pd.id_pesanan = pe.id_pesanan AND pd.id_barang)) as total_harga_barang FROM `pesanan` pe LEFT JOIN pembayaran pb ON pe.id_pesanan = pb.id_pesanan LEFT JOIN pembeli pl ON pe.id_pembeli = pl.id_pembeli LEFT JOIN pesanan_detail pd ON pe.id_pesanan = pd.id_pesanan WHERE pe.id_pembeli = :id_pembeli GROUP BY pe.id_pesanan";
                                  $stmt = $pdo->prepare($sql);
                                  $stmt->bindValue(':id_pembeli',$_SESSION['id_pembeli']);
                                  $stmt->execute();
                                  $i = 0;
                                  while($row = $stmt->fetch()){?>
                                  <tr>
                                      <td><?=($i+1);?></td>
                                      <td><?=$row['status_pesanan']?></td>
                                      <td><?=(isset($row['tipe_pembayaran'])?$row['tipe_pembayaran']:'-')?></td>
                                      <td><?=(isset($row['status_pembayaran'])?$row['status_pembayaran']:'-')?></td>
                                      <td><?=(isset($row['nama_kurir'])?$row['nama_kurir']:'-');?></td>
                                      <td><?=(isset($row['total_harga_barang'])?"Rp. ".number_format($row['total_harga_barang'], 2, ",", "."):'-');?></td>
                                      <td><?=(isset($row['ongkir'])?"Rp. ".number_format($row['ongkir'], 2, ",", "."):'-');?></td>
                                      <td><?="Rp. ".number_format($row['total_harga_barang'] + $row['ongkir'], 2, ",", ".");?></td>
                                      <td><?=$row['tanggal'];?></td>
                                      <td>
                                          <a class="btn btn-info" href="?page=riwayat&act=detail&id=<?=$row["id_pesanan"];?>" role="button">Detail</a>
                                      </td>
                                  </tr>
                                  <?php 
                                  $i++;}?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>