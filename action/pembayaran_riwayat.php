<?php
  require_once dirname(__FILE__) . "/../config.php"; 

  if(!isset($_SESSION["username"])){?>
    <script>
        window.location.replace("<?php echo BASE_URL; ?>?page=login");
    </script>
    <?php 
  }
  
          $sql = "SELECT pe.id_pesanan,pe.status
          FROM pesanan pe 
          WHERE pe.id_pesanan = :id";
          $stmt = $pdo->prepare($sql);
          $stmt->bindValue(':id',$_POST['id_pesanan']);
          $stmt->execute();
          $row = $stmt->fetch();
            if($row['status'] == 'dikirim'){
              $sql_2 = "UPDATE pesanan SET status = :status WHERE id_pesanan = :id";
              $stmt2 = $pdo->prepare($sql_2);
              $stmt2->bindValue(':id',$_POST['id_pesanan']);
              $stmt2->bindValue(':status','diterima');
              $stmt2->execute();
              ?>
              <script>
                  window.location.replace("<?php echo BASE_URL."?page=riwayat&act=detail&id=".$_POST['id_pesanan']; ?>");
              </script>
          <?php 
            }else{?>
              <script>
                alert("Barang Belum Dikirim");
                  window.location.replace("<?php echo BASE_URL."?page=riwayat&act=detail&id=".$_POST['id_pesanan']; ?>");
              </script>
            <?php }
  
  
