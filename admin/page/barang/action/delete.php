<?php
    require_once dirname(__FILE__) . "/../../../../config.php"; 
    $id = $_POST['id'];

    $sql = "DELETE FROM barang WHERE id_barang = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id',$id);
    try {
        $stmt->execute();
        print("Berhasil");
    } catch (Exception $e) {
        if($sql->errorCode() == 23000){
            print("Tidak Dapat Dihapus");
        }else{
            print("Terjadi Kesalahan");
        }
    }
?>