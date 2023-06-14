<?php
    require_once dirname(__FILE__) . "/../../../../config.php"; 
    
    $target_dir = "image/barang";

    $picture = "";

    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
    $skip = false;
    if ($_FILES['gambar']['error'] == 4){
        
        $skip = true;
        $sql = "UPDATE barang SET nama = :nama,id_kategori = :id_kategori,harga = :harga,keterangan = :keterangan,stok = :stok WHERE id_barang = :id_barang";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('id_barang',$_POST['id']);
        $stmt->bindValue('nama',$_POST['nama']);
        $stmt->bindValue('id_kategori',$_POST['id_kategori']);
        $stmt->bindValue('harga',$_POST['harga']);
        $stmt->bindValue('keterangan',$_POST['keterangan']);
        $stmt->bindValue('stok',$_POST['stok']);
        $stmt->execute();

    }else{
        $temp = explode(".", $_FILES["gambar"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        move_uploaded_file($_FILES["gambar"]["tmp_name"], dirname(__FILE__) . "/../../../../image/barang/".$newfilename);
        $picture = 'image/barang/'.$newfilename;
        $sql = "UPDATE barang SET nama = :nama,id_kategori = :id_kategori,harga = :harga,gambar = :gambar,keterangan = :keterangan,stok = :stok WHERE id_barang = :id_barang";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('id_barang',$_POST['id']);
        $stmt->bindValue('nama',$_POST['nama']);
        $stmt->bindValue('id_kategori',$_POST['id_kategori']);
        $stmt->bindValue('harga',$_POST['harga']);
        $stmt->bindValue('gambar',$picture);
        $stmt->bindValue('keterangan',$_POST['keterangan']);
        $stmt->bindValue('stok',$_POST['stok']);
        $stmt->execute();
    }

    ?>
    <script> 
        window.location.replace('<?php echo BASE_URL;?>admin/admin.php?page=barang');
    </script>