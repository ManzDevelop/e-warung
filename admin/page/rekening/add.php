
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Tambah Rekening
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <form enctype="multipart/form-data" action="page/rekening/action/add.php" method="POST">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Bank</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="bank" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Atas Nama</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="atas_nama" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Nomor Rekening</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nomor_rekening" required>
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