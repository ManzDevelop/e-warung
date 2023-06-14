            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Ongkir
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kecamatan</th>
                                            <th>Ongkir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                          $sql = "SELECT * FROM ongkir ORDER BY id_ongkir DESC";
                                          $stmt = $pdo->prepare($sql);
                                          $stmt->execute();
                                          $i = 0;
                                          while($row = $stmt->fetch()){?>
                                          <tr>
                                              <td><?=($i+1);?></td>
                                              <td><?=$row['kecamatan'];?></td>
                                              <td><?=$row['ongkir'];?></td>
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
                url:"page/ongkir/action/delete.php",  
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