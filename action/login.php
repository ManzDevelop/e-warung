<?php
    require_once dirname(__FILE__) . "/../config.php";
    $username = $password = "";
    $captcha_err = $username_err = $password_err = "";
    
		$_SESSION = array();
		session_destroy();
		$_SESSION = [];
		session_start();
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
                if(empty(trim($_POST["username"]))){
                    $username_err = 'Masukkan username';
                } else{
                    $username = trim($_POST["username"]);
                }
                
                if(empty(trim($_POST['password']))){
                    $password_err = 'Masukkan password';
                } else{
                    $password = trim($_POST['password']);
                }
                
                if(empty($username_err) && empty($password_err)){
                    $sql = "SELECT id_pembeli,username,password,nama FROM pembeli WHERE trim(lower(username)) = trim(lower(:username))";
                    $stmt = $pdo->prepare($sql);
                        
                    $param_username = trim($_POST["username"]);
                    $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
                        
                    $stmt->execute();
                        if($stmt->rowCount() == 1){
                            if($row = $stmt->fetch()){
                                // print_r($row);
                                $hashed_password = $row['password'];
                                if($password == $hashed_password){
                                    $_SESSION['username'] = $username; 
                                    $_SESSION['id_pembeli'] = $row['id_pembeli'];
                                    $_SESSION['nama'] = $row['nama']; ?>
                                        <script>
                                        window.location.replace("<?php echo BASE_URL."?page=home"; ?>");
                                        </script>
                                            <?php
                                } else{ ?>
                                    <script>
                                        alert("Password Salah");
                                        window.location.replace("<?php echo BASE_URL;?>?page=login");
                                    </script>
                                <?php  }
                            }
                        } else{?>
                            <script>
                                alert("Username Tidak Ditemukan");
                                window.location.replace("<?php echo BASE_URL;?>?page=login");
                            </script>
                        <?php }
                    unset($stmt);
                }
            unset($pdo);
        }