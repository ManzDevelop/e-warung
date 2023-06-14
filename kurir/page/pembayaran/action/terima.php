<?php
    require_once dirname(__FILE__) . "/../../../../config.php"; 

    $sql = "UPDATE pembayaran SET status = :status, total_dibayar = :total_dibayar,id_kurir = :id_kurir WHERE id_pembayaran = :id_pembayaran";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_pembayaran',$_POST['id']);
    $stmt->bindValue(':status','sudah');
    $stmt->bindValue(':id_kurir',$_SESSION['id_kurir']);
    $stmt->bindValue(':total_dibayar',$_POST['total_dibayar']);
    $stmt->execute();
    
    ?>
    <script> 
        window.location.replace('<?php echo BASE_URL;?>kurir/kurir.php?page=pembayaran&act=detail&id=<?=$_POST['id']?>');
    </script>