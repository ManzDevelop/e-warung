
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Tambah Ongkir
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <form enctype="multipart/form-data" action="page/ongkir/action/add.php" method="POST">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Kecamatan</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="kecamatan" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Ongkir</label>
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="ongkir" required>
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