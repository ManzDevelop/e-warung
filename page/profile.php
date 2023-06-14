
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row new-account-login">
                <div class="col-sm-12 col-lg-12 mb-3">
                    <div class="title-left">
                        <h3>Profile</h3>
                    </div>
                    <?php
                        $id = $_SESSION['id_pembeli'];
                        $sql = "SELECT pl.* FROM pembeli pl WHERE pl.id_pembeli = :id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindValue(':id',$id);
                        $stmt->execute();
                        $row = $stmt->fetch();
                      ?>
                    <form class="mt-3 review-form-box" action="action/profile.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="mb-0">Username</label>
                                <input type="text" class="form-control" name="username" value="<?=$row['username']?>" readonly> 
                            </div>
                            <div class="form-group col-md-12">
                                <label class="mb-0">Nama</label>
                                <input type="text" class="form-control" name="nama" value="<?=$row['nama']?>" required> 
                            </div>
                            <div class="form-group col-md-12">
                                <label class="mb-0">Password</label>
                                <input type="password" class="form-control" name="password"> 
                            </div>
                            <div class="form-group col-md-12">
                                <label class="mb-0">Telepon</label>
                                <input type="tel" class="form-control" name="telepon" value="<?=$row['telepon']?>" required> 
                            </div>
                            <div class="form-group col-md-12">
                                <label class="mb-0">Jenis Kelamin</label>
                                <select class="form-control show-tick" name="jenis_kelamin" required>
                                    <option value="">Pilih</option>
                                    <option value="Laki-Laki" <?=($row['jenis_kelamin'] == "Laki-Laki") ? 'selected' : '' ; ?>>Laki-Laki</option>
                                    <option value="Perempuan" <?=($row['jenis_kelamin'] == "Perempuan") ? 'selected' : '' ; ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="mb-0">Alamat</label>
                                <textarea rows="4" cols="50" class="form-control" name="alamat" required><?=$row['alamat']?></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Simpan</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->