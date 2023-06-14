
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
                          $sql = "SELECT * FROM pemilik WHERE id_pemilik = :id";
                          $stmt = $pdo->prepare($sql);
                          $stmt->bindValue(':id',$id);
                          $stmt->execute();
                          $row = $stmt->fetch();
                        ?>
                        <div class="body">
                            <div class="row clearfix">
                                <form enctype="multipart/form-data" action="page/pemilik/action/edit.php" method="POST">
                                    <input type="hidden" name="id" value="<?=$row['id_pemilik']?>">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Nama</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nama" value="<?=$row['nama']?>" required>
                                            </div>
                                        </div>
                                    </div>
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
                                            <label class="form-label">Password</label>
                                            <div class="form-line">
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="jenis_kelamin" required>
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
                                                <input type="tel" class="form-control" name="telepon" value="<?=$row['telepon']?>" required>
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