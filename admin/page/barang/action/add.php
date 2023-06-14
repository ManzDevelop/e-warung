<?php
    require_once dirname(__FILE__) . "/../../../../config.php"; 

     if ($_FILES['gambar']['error'] == 4)
    {
        $check = false;
    }else{
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    }

    $temp = explode(".", $_FILES["gambar"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    move_uploaded_file($_FILES["gambar"]["tmp_name"], dirname(__FILE__) .'/../../../../image/barang/'.$newfilename);
    $picture = 'image/barang/'.$newfilename;
    
    $sql = "INSERT INTO barang(nama,id_kategori,harga,gambar,keterangan,stok) VALUES(:nama,:id_kategori,:harga,:gambar,:keterangan,:stok)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nama',$_POST['nama']);
    $stmt->bindValue(':id_kategori',$_POST['id_kategori']);
    $stmt->bindValue(':harga',$_POST['harga']);
    $stmt->bindValue(':gambar',$picture);
    $stmt->bindValue(':keterangan',$_POST['keterangan']);
    $stmt->bindValue(':stok',$_POST['stok']);
    $stmt->execute();
?>
<script>
    window.location.replace("<?php echo BASE_URL."admin/admin.php?page=barang"; ?>");
</script>