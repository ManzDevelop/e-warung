<?php
    require_once dirname(__FILE__) . "/../../../../config.php"; 

    if(isset($_POST['password'])){
        $sql = "UPDATE kurir SET nama = :nama,jenis_kelamin = :jenis_kelamin,telepon = :telepon,password = :password WHERE id_kurir = :id_kurir";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('id_kurir',$_POST['id']);
        $stmt->bindValue('nama',$_POST['nama']);
        $stmt->bindValue('password',$_POST['password']);
        $stmt->bindValue('jenis_kelamin',$_POST['jenis_kelamin']);
        $stmt->bindValue('telepon',$_POST['telepon']);
        $stmt->execute();
    }else{
        $sql = "UPDATE kurir SET nama = :nama,jenis_kelamin = :jenis_kelamin,telepon = :telepon WHERE id_kurir = :id_kurir";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('id_kurir',$_POST['id']);
        $stmt->bindValue('nama',$_POST['nama']);
        $stmt->bindValue('jenis_kelamin',$_POST['jenis_kelamin']);
        $stmt->bindValue('telepon',$_POST['telepon']);
        $stmt->execute();
    }

    ?>
    <script> 
        window.location.replace('<?php echo BASE_URL;?>admin/admin.php?page=kurir');
    </script>