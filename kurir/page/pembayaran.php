            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Pembayaran
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Total Barang</th>
                                            <th>Ongkir</th>
                                            <th>Total Harga</th>
                                            <th>Total Dibayar</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT pb.*,pl.nama,pe.ongkir,((SELECT SUM((SELECT (pr.harga * pd.quantity) FROM barang pr WHERE pr.id_barang = pd.id_barang)) FROM pesanan_detail pd WHERE pd.id_pesanan = pe.id_pesanan AND pd.id_barang)) as total_harga_barang FROM `pembayaran` pb LEFT JOIN pesanan pe ON pb.id_pesanan = pe.id_pesanan LEFT JOIN pembeli pl ON pe.id_pembeli = pl.id_pembeli WHERE pe.id_kurir = :id_kurir ";
                                          $stmt = $pdo->prepare($sql);
                                            $stmt->bindValue(':id_kurir',$_SESSION['id_kurir']);
                                          $stmt->execute();
                                          $i = 0;
                                          while($row = $stmt->fetch()){?>
                                          <tr>
                                              <td><?=($i+1);?></td>
                                              <td><?=$row['nama'];?></td>
                                              <td><?=$row['status'];?></td>
                                              <td><?=$row['tanggal'];?></td>
                                              <td>Rp. <?=number_format($row['ongkir'], 2, ",", ".");?></td>
                                              <td>Rp. <?=number_format($row['total_harga_barang'], 2, ",", ".");?></td>
                                              <td>Rp. <?=number_format($row['total_harga'], 2, ",", ".");?></td>
                                              <td>Rp. <?=number_format($row['total_dibayar'], 2, ",", ".");?></td>
                                              <td>
                                                <a class="btn btn-info" href="?page=pembayaran&act=detail&id=<?=$row["id_pembayaran"];?>" role="button">Detail</a>
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
            <!-- #END# Basic Examples -->