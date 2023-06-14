<?php
    require_once dirname(__FILE__) . "/../../../../config.php"; 

    $sql = "INSERT INTO kategori(nama) VALUES(:nama)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nama',$_POST['nama']);
    $stmt->execute();
?>
<script>
    window.location.replace("<?php echo BASE_URL."admin/admin.php?page=kategori"; ?>");
</script>