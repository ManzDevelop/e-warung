<?php
    require_once dirname(__FILE__) . "/../../../../config.php"; 

    $sql = "INSERT INTO kurir(username,nama,password,jenis_kelamin,telepon,status) VALUES(:username,:nama,:password,:jenis_kelamin,:telepon,:status)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username',$_POST['username']);
    $stmt->bindValue(':nama',$_POST['nama']);
    $stmt->bindValue(':password',$_POST['password']);
    $stmt->bindValue(':jenis_kelamin',$_POST['jenis_kelamin']);
    $stmt->bindValue(':telepon',$_POST['telepon']);
    $stmt->bindValue(':status','Kosong');
    $stmt->execute();
?>
<script>
    window.location.replace("<?php echo BASE_URL."admin/admin.php?page=kurir"; ?>");
</script>