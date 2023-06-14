<?php

require_once dirname(__FILE__) . "/../config.php";

$response = array(
  'valid' => false,
  'message' => 'Username sudah digunakan'
);

if( isset($_POST['username']) ) {
  if (isset($_SESSION['Username'])) {
    if ($_POST['username'] == $_SESSION['Username']) {
      $response = array('valid' => true);
    }else{
      $sql = "SELECT COUNT(*) AS jumlah FROM tabel_pembeli pe WHERE pe.username = :Username ";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':Username',$_POST['username']);
      $stmt->execute();
      $user = $stmt->fetchColumn();
      if( $user > 0) {
        // User name is registered on another account
        $response = array('valid' => false, 'message' => 'Username sudah digunakan');
      } else {
        // User name is available
        $response = array('valid' => true);
      }
    }
  }else{
    $sql = "SELECT COUNT(*) AS jumlah FROM tabel_pembeli pe WHERE pe.username = :Username ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':Username',$_POST['username']);
    $stmt->execute();
    $user = $stmt->fetchColumn();
    if( $user > 0) {
      // User name is registered on another account
      $response = array('valid' => false, 'message' => 'Username sudah digunakan');
    } else {
      // User name is available
      $response = array('valid' => true);
    }
  }
}
echo json_encode($response);