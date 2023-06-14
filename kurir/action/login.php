<?php
    require_once dirname(__FILE__) . "/../../config.php";
    // session_start();
    $username = $password = "";
    $captcha_err = $username_err = $password_err = "";

    $_SESSION = array();
    session_destroy();
    $_SESSION = [];
    session_start();
    if(!isset($_POST["username"])){
        $username_err = 'Masukkan username';
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(!isset($_POST['password'])){
        $password_err = 'Masukkan password';
    } else{
        $password = trim($_POST['password']);
    }
    // echo($password);
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id_kurir,nama,password FROM kurir WHERE username = :username";
        $stmt = $pdo->prepare($sql);
            
        $param_username = trim($_POST["username"]);
        $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
            
        $stmt->execute();
            if($stmt->rowCount() == 1){
                if($row = $stmt->fetch()){
                    // print_r($row);
                    $hashed_password = $row['password'];
                    // echo $password."|".$hashed_password;
                    if($password == $hashed_password){
                        $_SESSION['username'] = $username; 
                        $_SESSION['id_kurir'] = $row['id_kurir'];
                        $_SESSION['nama'] = $row['nama'];?>
                        <script>
                          window.location.replace("<?php echo BASE_URL."kurir/kurir.php?page=home"; ?>");
                        </script>
                        <?php 
                    } else{ ?>
                        <script>
                            alert("Password Salah");
                            window.location.replace("<?php echo BASE_URL;?>kurir");
                        </script>
                    <?php  }
                }
            } else{?>
                <script>
                    alert("Username Tidak Ditemukan");
                    window.location.replace("<?php echo BASE_URL;?>kurir");
                </script>
            <?php }
        unset($stmt);
    }
    unset($pdo);