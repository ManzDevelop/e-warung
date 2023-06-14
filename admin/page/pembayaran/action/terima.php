<?php
    require_once dirname(__FILE__) . "/../../../../config.php"; 

    $sql = "UPDATE pembayaran SET status = :status, total_dibayar = :total_dibayar,id_admin = :id_admin WHERE id_pembayaran = :id_pembayaran";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_pembayaran',$_POST['id']);
    $stmt->bindValue(':status','sudah');
    $stmt->bindValue(':id_admin',$_SESSION['id_admin']);
    $stmt->bindValue(':total_dibayar',$_POST['total_dibayar']);
    $stmt->execute();


    ?>
    <script> 
        window.location.replace('<?php echo BASE_URL;?>admin/admin.php?page=pesanan');
    </script>