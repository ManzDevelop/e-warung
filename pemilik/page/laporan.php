            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Laporan Transaksi
                            </h2>
                        </div>
                        <div class="header">
                        <a href="page/laporan/lap_transaksi.php" class="btn bg-blue waves-effect">Cetak Laporan</a>
                        </div>
                        <div class="body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Status</th>
                                            <th>Alamat</th>
                                            <th>Kecamatan</th>
                                            <th>Ongkir</th>
                                            <th>Kurir</th>
                                            <th>Total Barang</th>
                                            <th>Tanggal</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                          $sql = "SELECT pe.*,pl.nama,((SELECT SUM((SELECT (pr.harga * pd.quantity) FROM barang pr WHERE pr.id_barang = pd.id_barang)) FROM pesanan_detail pd WHERE pd.id_pesanan = pe.id_pesanan AND pd.id_barang)) as total_harga_barang,(SELECT kr.nama FROM kurir kr WHERE kr.id_kurir = pe.id_kurir) AS nama_kurir,(SELECT kr.nama FROM kurir kr WHERE kr.id_kurir = pe.id_kurir) AS nama_kurir FROM pesanan pe LEFT JOIN pembeli pl ON pe.id_pembeli = pl.id_pembeli LEFT JOIN pesanan_detail pd ON pe.id_pesanan = pd.id_pesanan GROUP BY pe.id_pesanan";
                                          $stmt = $pdo->prepare($sql);
                                          $stmt->execute();
                                          $i = 0;
                                          while($row = $stmt->fetch()){?>
                                          <tr>
                                              <td><?=($i+1);?></td>
                                              <td><?=$row['nama'];?></td>
                                              <td><?=$row['status'];?></td>
                                              <td><?=$row['alamat'];?></td>
                                              <td><?=$row['kecamatan'];?></td>
                                              <td><?=$row['ongkir'];?></td>
                                              <td><?=$row['nama_kurir'];?></td>
                                              <td><?=$row['total_harga_barang'];?></td>
                                              <td><?=$row['tanggal'];?></td>
                                              <td>
                                                <a class="btn btn-primary" href="?page=pesanan&act=detail&id=<?=$row["id_pesanan"];?>" role="button">Detail</a>
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

             <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Laporan Pelanggan
                            </h2>
                        </div>
                         <div class="header">
                        <a href="page/laporan/lap_pelanggan.php" class="btn bg-blue waves-effect" target="_blank" >Cetak Laporan</a>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Telepon</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                          $sql = "SELECT * FROM pembeli ORDER BY id_pembeli DESC";
                                          $stmt = $pdo->prepare($sql);
                                          $stmt->execute();
                                          $i = 0;
                                          while($row = $stmt->fetch()){?>
                                          <tr>
                                              <td><?=($i+1);?></td>
                                              <td><?=$row['username'];?></td>
                                              <td><?=$row['nama'];?></td>
                                              <td><?=$row['jenis_kelamin'];?></td>
                                              <td><?=$row['telepon'];?></td>
                                              <td><?=$row['alamat'];?></td>
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
            