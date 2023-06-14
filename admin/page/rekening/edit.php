
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Edit Rekening
                            </h2>
                        </div>
                        <?php
                          if (isset($_GET['id']) && $_GET['id'] != '') {
                          $id = $_GET['id'];
                          $sql = "SELECT * FROM rekening WHERE id_rekening = :id";
                          $stmt = $pdo->prepare($sql);
                          $stmt->bindValue(':id',$id);
                          $stmt->execute();
                          $row = $stmt->fetch();
                        ?>
                        <div class="body">
                            <div class="row clearfix">
                                <form enctype="multipart/form-data" action="page/rekening/action/edit.php" method="POST">
                                    <input type="hidden" name="id" value="<?=$row['id_kategori']?>">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Bank</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="bank" value="<?=$row['bank']?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Atas Nama</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="atas_nama" value="<?=$row['atas_nama']?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Nomor Rekening</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nomor_rekening" value="<?=$row['nomor_rekening']?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->