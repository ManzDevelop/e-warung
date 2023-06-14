<?php
    require_once dirname(__FILE__) . "/../../../../config.php"; 

    $sql = "UPDATE rekening SET bank = :bank,atas_nama = :atas_nama,nomor_rekening = :nomor_rekening WHERE id_rekening = :id_rekening";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('id_rekening',$_POST['id']);
    $stmt->bindValue('bank',$_POST['bank']);
    $stmt->bindValue('atas_nama',$_POST['atas_nama']);
    $stmt->bindValue('nomor_rekening',$_POST['nomor_rekening']);
    $stmt->execute();

    ?>
    <script> 
        window.location.replace('<?php echo BASE_URL;?>admin/admin.php?page=rekening');
    </script>