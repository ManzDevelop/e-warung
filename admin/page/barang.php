            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Barang
                            </h2>
                            <a href="?page=barang&act=add" class="btn bg-blue waves-effect">Tambah</a>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Gambar</th>
                                            <th>Tanggal</th>
                                            <th>Stok</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                          $sql = "SELECT barang.*,kategori.nama AS nama_kategori FROM barang LEFT JOIN kategori ON barang.id_kategori = kategori.id_kategori ORDER BY id_barang DESC";
                                          $stmt = $pdo->prepare($sql);
                                          $stmt->execute();
                                          $i = 0;
                                          while($row = $stmt->fetch()){?>
                                          <tr>
                                              <td><?=($i+1);?></td>
                                              <td><?=$row['nama'];?></td>
                                              <td><?=$row['nama_kategori'];?></td>
                                              <td><?=$row['harga'];?></td>
                                              <td><img class="img-fluid" src="<?=BASE_URL.$row['gambar'];?>" width="100px" height="auto"></td>
                                              <td><?=$row['tanggal'];?></td>
                                              <td><?=$row['stok'];?></td>
                                              <td>
                                                <a class="btn btn-primary" href="?page=barang&act=edit&id=<?=$row["id_barang"];?>" role="button">Edit</a>
                                                <button type="button" class="btn btn-danger" data-id="<?=$row["id_barang"]?>" onclick="return Delete(this)">Hapus</button>
                                              </td>
                                          </tr>
                                          <?php 
                                          $i++;}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
            
<script>
function Delete(temp) {
    var jawab = confirm("Anda Yakin Akan Menghapus Data ?");
    if (jawab == true) {
        var id = temp.getAttribute("data-id");  
        $.ajax({  
                url:"page/barang/action/delete.php",  
                method:"post",  
                data:{id:id},  
                success:function(data){  
                    // alert(data);
                    if (data == "Berhasil") {
                        alert("Data Berhasil Dihapus");
                        location.reload(true);
                    }else if (data = "Tidak Dapat Dihapus") {
                        alert("Tidak Dapat Dihapus");
                    } else {
                        alert("Error");
                    } 
                }  
        }); 
    }
}
</script>