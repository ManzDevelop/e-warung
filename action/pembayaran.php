<?php
  require_once dirname(__FILE__) . "/../config.php"; 

  if(!isset($_SESSION["username"])){?>
    <script>
        window.location.replace("<?php echo BASE_URL; ?>?page=login");
    </script>
    <?php 
  }
  
  if($_POST["tipe_pembayaran"] == 'transfer'){
      $target_dir = "image/pembayaran";
      $newfilename = "";
      $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $check = false;

      if ($_FILES['gambar']['error'] == 4)
      {
          $check = false;
      }else{
          $check = getimagesize($_FILES["gambar"]["tmp_name"]);
      }

      $temp = explode(".", $_FILES["gambar"]["name"]);
      $newfilename = "pembayaran_".round(microtime(true)) . '.' . end($temp);
      move_uploaded_file($_FILES["gambar"]["tmp_name"], dirname(__FILE__) .'/../image/pembayaran/'.$newfilename);
      $picture = 'image/pembayaran/'.$newfilename;

      $sql = "UPDATE pembayaran SET foto_transfer = :foto_transfer, status = :status, id_rekening = :id_rekening WHERE id_pesanan = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id',$_POST['id_pesanan']);
      $stmt->bindValue(':foto_transfer',$picture);
      $stmt->bindValue(':id_rekening',$_POST['id_rekening']);
      $stmt->bindValue(':status','belum');
      $stmt->execute();

      $sql_2 = "UPDATE pesanan SET status = :status WHERE id_pesanan = :id";
      $stmt2 = $pdo->prepare($sql_2);
      $stmt2->bindValue(':id',$_POST['id_pesanan']);
      $stmt2->bindValue(':status','proses');
      $stmt2->execute();
      ?>
      <script>
          window.location.replace("<?php echo BASE_URL."?page=home"; ?>");
      </script>
  <?php 
    } else if($_POST["tipe_pembayaran"] == 'tunai'){
          $sql = "SELECT pe.id_pesanan,pe.status
          FROM pesanan pe 
          WHERE pe.id_pesanan = :id";
          $stmt = $pdo->prepare($sql);
          $stmt->bindValue(':id',$_POST['id_pesanan']);
          $stmt->execute();
          $row = $stmt->fetch();
            if($row['status'] == 'menunggu'){
              $sql_2 = "UPDATE pesanan SET status = :status WHERE id_pesanan = :id";
              $stmt2 = $pdo->prepare($sql_2);
              $stmt2->bindValue(':id',$_POST['id_pesanan']);
              $stmt2->bindValue(':status','proses');
              $stmt2->execute();
              ?>
              <script>
                  window.location.replace("<?php echo BASE_URL."?page=home"; ?>");
              </script>
          <?php 
            }else{?>
              <script>
                alert("Barang Belum Dikirim");
                  window.location.replace("<?php echo BASE_URL."?page=pembayaran"; ?>");
              </script>
            <?php }
    }
  
  
