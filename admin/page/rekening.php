            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Rekening
                            </h2>
                            <a href="?page=rekening&act=add" class="btn bg-blue waves-effect">Tambah</a>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bank</th>
                                            <th>Atas Nama</th>
                                            <th>Nomor Rekening</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                          $sql = "SELECT * FROM rekening ORDER BY id_rekening DESC";
                                          $stmt = $pdo->prepare($sql);
                                          $stmt->execute();
                                          $i = 0;
                                          while($row = $stmt->fetch()){?>
                                          <tr>
                                              <td><?=($i+1);?></td>
                                              <td><?=$row['bank'];?></td>
                                              <td><?=$row['atas_nama'];?></td>
                                              <td><?=$row['nomor_rekening'];?></td>
                                              <td>
                                                <a class="btn btn-primary" href="?page=rekening&act=edit&id=<?=$row["id_rekening"];?>" role="button">Edit</a>
                                                <button type="button" class="btn btn-danger" data-id="<?=$row["id_rekening"]?>" onclick="return Delete(this)">Hapus</button>
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
                url:"page/rekening/action/delete.php",  
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