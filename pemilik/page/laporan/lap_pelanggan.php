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
                        <title>CETAK LAPORAN PELANGGAN</title>
                    </head>

                    <body>
                     
                     <center>
                     <br>
                     <h2>LAPORAN PELANGGAN</h2>
                     <br>
                     </center>
                        <div class="body">
                            <div class="table-responsive">
                                <table border="1" style="width: 100%">
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

                                  <script>
                                    window.print();
                                 </script>
                            </div>

                        </div>

                    </div>
                </div>
            </div>




            