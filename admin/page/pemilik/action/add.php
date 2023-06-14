<?php
    require_once dirname(__FILE__) . "/../../../../config.php"; 

    $sql = "INSERT INTO pemilik(nama,username,jenis_kelamin,telepon,password) VALUES(:nama,:username,:jenis_kelamin,:telepon,:password)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nama',$_POST['nama']);
    $stmt->bindValue(':username',$_POST['username']);
    $stmt->bindValue(':password',$_POST['password']);
    $stmt->bindValue(':jenis_kelamin',$_POST['jenis_kelamin']);
    $stmt->bindValue(':telepon',$_POST['telepon']);
    $stmt->execute();
?>
<script>
    window.location.replace("<?php echo BASE_URL."admin/admin.php?page=pemilik"; ?>");
</script>