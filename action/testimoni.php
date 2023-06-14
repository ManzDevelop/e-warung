<?php
    require_once dirname(__FILE__) . "/../config.php"; 

    if(!isset($_SESSION["Username"])){?>
        <script>
            window.location.replace("<?php echo BASE_URL; ?>?laman=login");
        </script>
        <?php 
      }
    $sql = "INSERT INTO tabel_testimoni(id_pembeli,isi,rating) VALUES(:id_pembeli,:isi,:rating)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_pembeli',$_SESSION['ID_Pembeli']);
    $stmt->bindValue(':isi',$_POST['isi']);
    $stmt->bindValue(':rating',$_POST['rating']);
    $stmt->execute();
?>
<script>
    window.location.replace("<?php echo BASE_URL."?laman=testimoni"; ?>");
</script>