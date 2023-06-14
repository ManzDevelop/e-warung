         <?php
    session_start();
    // error_reporting(~E_NOTICE);
    define("BASE_URL","http://localhost/toko_nia/");
    define('DB_SERVER', 'localhost');
    define('DB_DATABASE', 'toko_nia');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('KEY','b01a4ddc4382eb0454381e3a20f04497');
    define('ASAL','17');

    try{
        $pdo = new PDO("mysql:host=". DB_SERVER .";dbname=".DB_DATABASE, DB_USERNAME, DB_PASSWORD); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));
    } catch(PDOException $e){
        die("ERROR: Could not connect. " . $e->getMessage());
    }

    function cutText($text, $length)
    {
        if(strlen($text) > $length){
            return substr($text, 0, $length)." ...";
        }
        else{
            return $text;
        }
    }

    function rupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
    }

?>



            <!-- Basic Examples -->
                    <head>
                        <title>CETAK LAPORAN TRANSAKSI</title>
                    </head>

                    <body>
                     
                     <center>
                     <br>
                     <h2>LAPORAN TRANSAKSI</h2>
                     <br>
                     </center>
                        <div class="body">
                            <div class="table-responsive">
                                <table border="1" style="width: 100%">
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
                                          </tr>
                                          <?php 
                                          $i++;}?>
                                    </tbody>
                                </table>

                                  <script>
                                    window.print();
                                 </script>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


            

            