
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
                          $sql = "SELECT * FROM kurir WHERE id_kurir = :id";
                          $stmt = $pdo->prepare($sql);
                          $stmt->bindValue(':id',$id);
                          $stmt->execute();
                          $row = $stmt->fetch();
                        ?>
                        <div class="body">
                            <div class="row clearfix">
                                    <input type="hidden" name="id" value="<?=$row['id_kurir']?>">
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Username</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="username" value="<?=$row['username']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Nama</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nama" value="<?=$row['nama']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="jenis_kelamin" readonly>
                                                    <option value="">Pilih</option>
                                                    <option value="Laki-Laki" <?=($row['jenis_kelamin'] == "Laki-Laki") ? 'selected' : '' ; ?>>Laki-Laki</option>
                                                    <option value="Perempuan" <?=($row['jenis_kelamin'] == "Perempuan") ? 'selected' : '' ; ?>>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Telepon</label>
                                            <div class="form-line">
                                                <input type="tel" class="form-control" name="telepon" value="<?=$row['telepon']?>" readonly>
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