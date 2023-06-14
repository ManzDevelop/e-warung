<?php
    require_once dirname(__FILE__) . "/../../../../config.php"; 

    $sql = "UPDATE pesanan SET status = :status WHERE id_pesanan = :id_pesanan";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_pesanan',$_POST['id']);
    $stmt->bindValue(':status','proses');
    $stmt->execute();


    ?>
    <script> 
        window.location.replace('<?php echo BASE_URL;?>admin/admin.php?page=pesanan&act=detail&id=<?=$_POST['id']?>');
    </script>