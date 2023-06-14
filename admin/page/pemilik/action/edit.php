<?php
    require_once dirname(__FILE__) . "/../../../../config.php"; 

    if(isset($_POST['password'])){
        $sql = "UPDATE pemilik SET nama = :nama,jenis_kelamin = :jenis_kelamin,telepon = :telepon,password = :password WHERE id_pemilik = :id_pemilik";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('id_pemilik',$_POST['id']);
        $stmt->bindValue('nama',$_POST['nama']);
        $stmt->bindValue('password',$_POST['password']);
        $stmt->bindValue('jenis_kelamin',$_POST['jenis_kelamin']);
        $stmt->bindValue('telepon',$_POST['telepon']);
        $stmt->execute();
    }else{
        $sql = "UPDATE pemilik SET nama = :nama,jenis_kelamin = :jenis_kelamin,telepon = :telepon WHERE id_pemilik = :id_pemilik";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('id_pemilik',$_POST['id']);
        $stmt->bindValue('nama',$_POST['nama']);
        $stmt->bindValue('jenis_kelamin',$_POST['jenis_kelamin']);
        $stmt->bindValue('telepon',$_POST['telepon']);
        $stmt->execute();
    }

    ?>
    <script> 
        window.location.replace('<?php echo BASE_URL;?>admin/admin.php?page=pemilik');
    </script>