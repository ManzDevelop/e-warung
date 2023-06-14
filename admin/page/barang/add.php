
                                            
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Tambah Barang
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <form enctype="multipart/form-data" action="page/barang/action/add.php" method="POST">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Nama</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nama" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Kategori</label>
                                            <select class="form-control show-tick" name="id_kategori" required>
                                                <option value="">Pilih</option>
                                                <?php 
                                                $sql = "SELECT * FROM kategori";
                                                $stmt = $pdo->prepare($sql);
                                                $stmt->execute();
                                                while($row = $stmt->fetch()){ ?>
                                                    <option value="<?=$row['id_kategori']?>"><?=$row['nama']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Harga</label>
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="harga" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Gambar</label>
                                            <div class="form-line">
                                                <input type="file" class="form-control" name="gambar" required  accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Keterangan</label>
                                            <div class="form-line">
                                                <textarea class="form-control" name="keterangan" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Stok</label>
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="stok" required>
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
                    </div>
                </div>
            </div>
            <!-- #END# Input -->