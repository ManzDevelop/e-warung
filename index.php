<?php
    require_once dirname(__FILE__) . "/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Toko Nia</title>

    <link rel="icon" href="image/icon.png">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/jquery-3.2.1.min.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .button-log{
        padding: 4px;
        font-size: 14px;
        background: #b0b435;
        color: #fff;
        border: none;
        border-radius: 0px;
        width:80px
    }
    </style>
</head>

<body>
    <!-- Start Main Top -->
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php
                        $sql = "SELECT pl.* FROM admin pl WHERE pl.id_admin = 1";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $row = $stmt->fetch();
                      if (isset($_SESSION['username'])) { ?>
                        <a href="?page=profile" class="btn btn-primary button-log" style="">Profile</a>
                        <a href="?page=riwayat" class="btn btn-primary button-log" style="">Riwayat</a>
                        <a href="https://api.whatsapp.com/send?phone=<?=$row['telepon']?>" class="btn btn-warning button-log" style="width:150px">Hubungi Admin</a>
                        <a href="action/logout.php" class="btn btn-danger button-log" style="">Logout</a>
                      <?php }else{ ?>
                        <a href="kurir" class="btn btn-primary button-log" style="">Kurir</a>
                        <a href="pemilik" class="btn btn-primary button-log" style="">Pemilik</a>
                        <a href="admin" class="btn btn-primary button-log" style="">Admin</a>
                        <a href="?page=register" class="btn btn-primary button-log" style="">Register</a>
                        <a href="?page=login" class="btn btn-primary button-log" style="">Login</a>
                      <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->

    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item "><a class="nav-link" href="?page=home">Home</a></li>
                        <li class="nav-item "><a class="nav-link" href="?page=barang">Barang</a></li>
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">Kategori</a>
                            <ul class="dropdown-menu">
                              <?php
                                $sql = "SELECT * FROM kategori";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute();
                                $i = 0;
                                while($row = $stmt->fetch()){?>
                                    <li><a href="?page=barang&kategori=<?=$row['id_kategori']?>"><?=$row['nama']?></a></li>
                                <?php }?>
                            </ul>
                        </li>
                        <li class="nav-item "><a class="nav-link" href="?page=keranjang">Keranjang</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

    <?php
      require_once("controller.php");
    ?>

    <!-- ALL JS FILES -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/jquery.superslides.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/inewsticker.js"></script>
    <script src="js/bootsnav.js."></script>
    <script src="js/images-loded.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>