<?php
    require_once dirname(__FILE__) . "/../../../../config.php"; 

    $sql = "INSERT INTO ongkir(kecamatan,ongkir) VALUES(:kecamatan,:ongkir)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':kecamatan',$_POST['kecamatan']);
    $stmt->bindValue(':ongkir',$_POST['ongkir']);
    $stmt->execute();
?>
<script>
    window.location.replace("<?php echo BASE_URL."admin/admin.php?page=ongkir"; ?>");
</script>