<?php
    require_once dirname(__FILE__) . "/../../../../config.php"; 

    $sql = "UPDATE kategori SET nama = :nama WHERE id_kategori = :id_kategori";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('id_kategori',$_POST['id']);
    $stmt->bindValue('nama',$_POST['nama']);
    $stmt->execute();

    ?>
    <script> 
        window.location.replace('<?php echo BASE_URL;?>admin/admin.php?page=kategori');
    </script>