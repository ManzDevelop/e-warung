
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row new-account-login">
                <div class="col-sm-12 col-lg-12 mb-3">
                    <div class="title-left">
                        <h3>Register</h3>
                    </div>
                    <form class="mt-3 review-form-box" action="action/register.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="mb-0">Username</label>
                                <input type="text" class="form-control" name="username" required> 
                            </div>
                            <div class="form-group col-md-12">
                                <label class="mb-0">Nama</label>
                                <input type="text" class="form-control" name="nama" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required> 
                            </div>
                            <div class="form-group col-md-12">
                                <label class="mb-0">Password</label>
                                <input type="password" class="form-control" name="password" required> 
                            </div>
                            <div class="form-group col-md-12">
                                <label class="mb-0">Telepon</label>
                                <input type="number" class="form-control" name="telepon" required> 
                            </div>
                            <div class="form-group col-md-12">
                                <label class="mb-0">Jenis Kelamin</label>
                                <select class="form-control show-tick" name="jenis_kelamin" required>
                                    <option value="">Pilih</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="mb-0">Alamat</label>
                                <textarea rows="4" cols="50" class="form-control" name="alamat" required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Register</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->