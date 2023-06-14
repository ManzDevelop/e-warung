<?php



      $servername = "localhost";
      $username = "root";
      $password = "";
      $db = "toko_nia";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $db);

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }



require_once dirname(__FILE__) . "/../config.php";

function AddBarang($idp,$id){
  global $pdo;
  $sql_add = "INSERT IGNORE INTO pesanan_detail(id_pesanan,id_barang,quantity) VALUES(:id_pesanan,:id_barang,:quantity)";
  $stmt_add = $pdo->prepare($sql_add);
  $stmt_add->bindValue(':id_pesanan',$idp);
  $stmt_add->bindValue(':id_barang',$id);
  $stmt_add->bindValue(':quantity','1');
  $stmt_add->execute();
}

function GetIDPemesanan(){
  global $pdo;

  $sql = "SELECT pd.id_pesanan,pd.status FROM pesanan pd WHERE pd.id_pembeli=:id_pembeli AND pd.status = 'pesan' OR pd.status = 'menunggu' ORDER BY pd.Tanggal DESC LIMIT 1";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id_pembeli',$_SESSION['id_pembeli']);
  $stmt->execute();
  $row = $stmt->fetch();

  return $row;
}

// print_r($row);

if(!isset($_SESSION["username"])){?>
  <script>
      window.location.replace("<?php echo BASE_URL; ?>?page=login");
  </script>
  <?php
}
$id = isset($_GET['id'])?$_GET['id']:'';
$row = GetIDPemesanan();
if ($_GET['act']=='add') {
  $sql_pro = "SELECT pr.* FROM barang pr WHERE pr.id_barang = :id";
  $stmt_pro = $pdo->prepare($sql_pro);
  $stmt_pro->bindValue(':id',$id);
  $stmt_pro->execute();
  $row_pro = $stmt_pro->fetch();
  if ($row_pro['stok']>0) {
    if (!isset($row['status']) ||  $row['status']==null || $row['status'] == '') {
      $sql_new = "INSERT INTO pesanan(id_pembeli,status) VALUES(:id_pembeli,:status)";
      $stmt_new = $pdo->prepare($sql_new);
      $stmt_new->bindValue(':id_pembeli',$_SESSION['id_pembeli']);
      $stmt_new->bindValue(':status','pesan');
      $stmt_new->execute();
      $id_last = $pdo->lastInsertId();
      AddBarang($id_last,$id);
      ?>
        <script>
          window.location.replace("<?php echo BASE_URL."?page=keranjang"; ?>");
        </script>
      <?php
    }else if($row['status']=="menunggu"){
      ?>
      <script>
        window.location.replace("<?php echo BASE_URL."?page=pembayaran"; ?>");
      </script>
    <?php
    }else if($row['status']=="pesan"){
      AddBarang($row['id_pesanan'],$id);
      ?>
        <script>
          window.location.replace("<?php echo BASE_URL."?page=keranjang"; ?>");
        </script>
      <?php
    }
  }else{?>
    <script>
      alert('Stok Kosong');
      history.go(-1); 
    </script>
  <?php }
}else if ($_GET['act'] =='lanjut') {
 
    $id_brg        =$_POST['id_barang'][0];
    $jumlah        =$_POST['quantity'][0];
    
  
    $selSto =mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id_brg'");
    $sto    =mysqli_fetch_array($selSto);
    $stok    =$sto['stok'];
    
    if ($stok < $jumlah) {
        ?>
        <script language="JavaScript">
            alert('Mohon Maaf! Jumlah Barang lebih besar dari stok. Stok Tesedia Ditoko Sebanyak <?=$stok?>');
            window.location.replace("<?php echo BASE_URL."?page=keranjang"; ?>");
        </script>
        <?php
    }

 else {

  for ($i=0; $i < Count($_POST['id_barang']); $i++) {
    $sql_update = "UPDATE pesanan_detail SET quantity = :quantity WHERE id_pesanan = :id AND id_barang = :id_barang";
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->bindValue(':id',$row['id_pesanan']);
    $stmt_update->bindValue(':quantity',$_POST['quantity'][$i]);
    $stmt_update->bindValue(':id_barang',$_POST['id_barang'][$i]);
    $stmt_update->execute();
  }
  ?>
    <script>
      window.location.replace("<?php echo BASE_URL."?page=lanjut"; ?>");
    </script>
  <?php }

}else if ($_GET['act'] =='checkout') {
    $sql = "SELECT pe.*,pr.*,pd.* FROM pesanan pe INNER JOIN pesanan_detail pd ON pe.id_pesanan = pd.id_pesanan LEFT JOIN barang pr ON pd.id_barang = pr.id_barang WHERE pe.status = 'pesan' AND pe.id_pembeli = :id_pembeli";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id_pembeli',$_SESSION['id_pembeli']);
  $stmt->execute();
  // echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
  $id_pesanan = 1;
  while($row = $stmt->fetch()){
      $id_pesanan = $row['id_pesanan'];
    $stok = $row['stok'] - $row['quantity'];

    $sql_update_stok = "UPDATE barang SET stok = :stok WHERE id_barang = :id_barang";
    $stmt_update_stok = $pdo->prepare($sql_update_stok);
    $stmt_update_stok->bindValue(':id_barang',$row['id_barang']);
    $stmt_update_stok->bindValue(':stok',$stok);
    $stmt_update_stok->execute();
  }
  
  $sql_on = "SELECT og.* FROM ongkir og WHERE og.id_ongkir = :id_ongkir";
  $stmt_on = $pdo->prepare($sql_on);
  $stmt_on->bindValue(':id_ongkir',$_POST['id_ongkir']);
  $stmt_on->execute();
  $row_on = $stmt_on->fetch();
  
  $sql_booking = "UPDATE pesanan SET alamat = :alamat,id_ongkir = :id_ongkir,kecamatan = :kecamatan, ongkir = :ongkir WHERE id_pesanan = :id ";
  $stmt_booking = $pdo->prepare($sql_booking);
  $stmt_booking->bindValue(':id',$id_pesanan);
  $stmt_booking->bindValue(':alamat',$_POST['alamat']);
  $stmt_booking->bindValue(':id_ongkir',$_POST['id_ongkir']);
  $stmt_booking->bindValue(':kecamatan',$row_on['kecamatan']);
  $stmt_booking->bindValue(':ongkir',$row_on['ongkir']);
  $stmt_booking->execute();

  
   $sql_total = "SELECT gh.Total FROM gethargatotal gh WHERE gh.id_pesanan = (SELECT pe.id_pesanan FROM pesanan pe WHERE pe.status = 'pesan' AND pe.id_pembeli = :id_pembeli)";
  $stmt_total = $pdo->prepare($sql_total);
  $stmt_total->bindValue(':id_pembeli',$_SESSION['id_pembeli']);
  $stmt_total->execute();
  $row_total= $stmt_total->fetch();
  $total_harga = $row_total['Total']
  +$row_on['ongkir'];
  
  $sql_pemesanan = "UPDATE pesanan SET status = :status WHERE id_pesanan = :id ";
  $stmt_pemesanan = $pdo->prepare($sql_pemesanan);
  $stmt_pemesanan->bindValue(':id',$id_pesanan);
  $stmt_pemesanan->bindValue(':status','menunggu');
  $stmt_pemesanan->execute();

  $sql_bayar = "INSERT INTO pembayaran(id_pesanan,status,total_harga,total_dibayar,tipe_pembayaran)
  VALUES(:id,:status,
  (
    SELECT
      (
        (SELECT SUM(
          (SELECT (pr.harga * ped.quantity) FROM barang pr WHERE pr.id_barang = ped.id_barang)) FROM pesanan_detail ped WHERE ped.id_pesanan = pe.id_pesanan
        ) + pe.ongkir
      ) as TotalHargaProduk
    FROM pesanan pe WHERE pe.id_pesanan = :id
  ),:total_dibayar,:tipe_pembayaran)";
  $stmt_bayar = $pdo->prepare($sql_bayar);
  $stmt_bayar->bindValue(':id',$id_pesanan);
  $stmt_bayar->bindValue(':status','belum');
  $stmt_bayar->bindValue(':total_dibayar',0);
  $stmt_bayar->bindValue(':total_harga',$total_harga);
  $stmt_bayar->bindValue(':tipe_pembayaran',$_POST['tipe_pembayaran']);
  $stmt_bayar->execute();

  ?>
    <script>
      window.location.replace("<?php echo BASE_URL."?page=pembayaran"; ?>");
    </script>
  <?php
}
?>
