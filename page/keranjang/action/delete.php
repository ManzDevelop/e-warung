<?php
    require_once dirname(__FILE__) . "/../../../config.php"; 
    $id = $_POST['id'];

    $sql_pemesanan = "SELECT pd.id_pesanan,pd.status FROM pesanan pd WHERE pd.id_pembeli=:id_pembeli AND pd.status = 'pesan' ORDER BY pd.tanggal DESC LIMIT 1";
    $stmt_pemesanan = $pdo->prepare($sql_pemesanan);
    $stmt_pemesanan->bindValue(':id_pembeli',$_SESSION['id_pembeli']);
    $stmt_pemesanan->execute();
    $row = $stmt_pemesanan->fetch();

    $sql = "DELETE FROM pesanan_detail WHERE id_barang = :id AND id_pesanan = :idp";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id',$id);
    $stmt->bindValue(':idp',$row['id_pesanan']);
    $stmt->execute();
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