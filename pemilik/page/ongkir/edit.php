
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Detail Rekening
                            </h2>
                        </div>
                        <?php
                          if (isset($_GET['id']) && $_GET['id'] != '') {
                          $id = $_GET['id'];
                          $sql = "SELECT * FROM ongkir WHERE id_ongkir = :id";
                          $stmt = $pdo->prepare($sql);
                          $stmt->bindValue(':id',$id);
                          $stmt->execute();
                          $row = $stmt->fetch();
                        ?>
                        <div class="body">
                            <div class="row clearfix">
                                    <input type="hidden" name="id" value="<?=$row['id_ongkir']?>">
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Kecamatan</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="kecamatan" value="<?=$row['kecamatan']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Ongkir</label>
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="ongkir" value="<?=$row['ongkir']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->