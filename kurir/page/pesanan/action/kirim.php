<?php
    require_once dirname(__FILE__) . "/../../../../config.php"; 

    $sql = "UPDATE pesanan SET status = :status,id_kurir = :id_kurir WHERE id_pesanan = :id_pesanan";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_pesanan',$_POST['id']);
    $stmt->bindValue(':status','dikirim');
    $stmt->bindValue(':id_kurir',$_SESSION['id_kurir']);
    $stmt->execute();
    ?>
    <script> 
        window.location.replace('<?php echo BASE_URL;?>kurir/kurir.php?page=pesanan&act=detail&id=<?=$_POST['id']?>');
    </script>