
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Tambah Kurir
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <form enctype="multipart/form-data" action="page/kurir/action/add.php" method="POST">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Username</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="username" required>
                                            </div>
                                        </div>
                                    </div>
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
                                            <label class="form-label">Password</label>
                                            <div class="form-line">
                                                <input type="password" class="form-control" name="password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="jenis_kelamin" required>
                                                    <option value="">Pilih</option>
                                                    <option value="Laki-Laki">Laki-Laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Telepon</label>
                                            <div class="form-line">
                                                <input type="tel" class="form-control" name="telepon" required>
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