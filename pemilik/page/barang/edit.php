
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Detail Kategori
                            </h2>
                        </div>
                        <?php
                          if (isset($_GET['id']) && $_GET['id'] != '') {
                          $id = $_GET['id'];
                          $sql = "SELECT * FROM barang WHERE id_barang = :id";
                          $stmt = $pdo->prepare($sql);
                          $stmt->bindValue(':id',$id);
                          $stmt->execute();
                          $row = $stmt->fetch();
                        ?>
                        <div class="body">
                            <div class="row clearfix">
                                    <input type="hidden" name="id" value="<?=$row['id_barang']?>">
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
                                            <label class="form-label">Kategori</label>
                                            <select class="form-control show-tick" name="id_kategori" readonly>
                                                <option value="">Pilih</option>
                                                <?php 
                                                $sql = "SELECT * FROM kategori";
                                                $stmt = $pdo->prepare($sql);
                                                $stmt->execute();
                                                while($row_2 = $stmt->fetch()){ ?>
                                                    <option value="<?=$row['id_kategori']?>" <?=($row_2['id_kategori'] == $row['id_kategori']) ? 'selected' : '' ; ?>><?=$row_2['nama']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Harga</label>
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="harga" value="<?=$row['harga']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Gambar</label>
                                            <div class="form-line">
                                    <img class="img-fluid" src="<?=BASE_URL.$row['gambar'];?>" width="300px" height="auto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Keterangan</label>
                                            <div class="form-line">
                                                <textarea class="form-control" name="keterangan" readonly><?=$row['keterangan']?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Stok</label>
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="stok" value="<?=$row['stok']?>" readonly>
                                            </div>
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