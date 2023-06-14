<?php
    require_once dirname(__FILE__) . "/../../../../config.php"; 

    $sql = "UPDATE ongkir SET kecamatan = :kecamatan,ongkir = :ongkir WHERE id_ongkir = :id_ongkir";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('id_ongkir',$_POST['id']);
    $stmt->bindValue('kecamatan',$_POST['kecamatan']);
    $stmt->bindValue('ongkir',$_POST['ongkir']);
    $stmt->execute();

    ?>
    <script> 
        window.location.replace('<?php echo BASE_URL;?>admin/admin.php?page=ongkir');
    </script>