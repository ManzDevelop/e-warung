<?php
    require_once dirname(__FILE__) . "/../config.php";

    $sql = "UPDATE pembeli SET username = :username, nama = :nama,password = IF(:password IS NULL, :password, password),telepon = :telepon,alamat = :alamat WHERE id_pembeli = :id_pembeli";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('id_pembeli',$_SESSION['id_pembeli']);
    $stmt->bindValue('nama',$_POST['nama']);
    $stmt->bindValue('username',$_POST['username']);
    $stmt->bindValue('password',$_POST['password']);
    $stmt->bindValue('telepon',$_POST['telepon']);
    $stmt->bindValue('alamat',$_POST['alamat']);
    $stmt->execute();

    $_SESSION['nama'] = $_POST['nama'];
    ?>
    <script>
    window.location.replace("<?php echo BASE_URL."?page=profile"; ?>");
    </script>