<?php
    require_once dirname(__FILE__) . "/../config.php"; 

    $sql = "SELECT COUNT(*) AS jumlah FROM pembeli pe WHERE pe.username = :username ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username',$_POST['username']);
    $stmt->execute();
    $user = $stmt->fetchColumn();
    if( $user > 0) {
        ?>
      <script>
        alert("Username sudah digunakan");
        window.location.replace("<?php echo BASE_URL."?page=register"; ?>");
      </script> <?php
    } else {
        $sql = "INSERT INTO pembeli(username,password,nama,telepon,alamat,jenis_kelamin) VALUES(:username,:password,:nama,:telepon,:alamat,:jenis_kelamin)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username',trim(strtolower($_POST['username'])));
        $stmt->bindValue(':password',$_POST['password']);
        $stmt->bindValue(':nama',$_POST['nama']);
        $stmt->bindValue(':telepon',$_POST['telepon']);
        $stmt->bindValue(':alamat',$_POST['alamat']);
        $stmt->bindValue(':jenis_kelamin',$_POST['jenis_kelamin']);
        $stmt->execute();

        $sql = "SELECT id_pembeli,username,password,nama FROM pembeli WHERE username = :username AND nama = :nama";
        $stmt = $pdo->prepare($sql);
            
        $param_username = trim($_POST["username"]);
        $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
        $stmt->bindParam(':nama', $_POST['nama'], PDO::PARAM_STR);
            
        $stmt->execute();
        $row = $stmt->fetch();

        $_SESSION['username'] = $row['username']; 
        $_SESSION['id_pembeli'] = $row['id_pembeli'];
        $_SESSION['nama'] = $row['nama']; 
        
        ?>
      <script>
        window.location.replace("<?php echo BASE_URL."?page=home"; ?>");
      </script> <?php
    }
