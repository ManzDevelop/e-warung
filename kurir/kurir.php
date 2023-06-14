<?php
    require_once dirname(__FILE__) . "/../config.php";
    if(!isset($_SESSION["username"])){?>
        <script>
            window.location.replace("<?php echo BASE_URL."kurir"; ?>");
        </script>
        <?php 
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Kurir Panel Toko Nia</title>
    <!-- Favicon-->
    <link rel="icon" href="../image/icon.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?=BASE_URL?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?=BASE_URL?>assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?=BASE_URL?>assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="<?=BASE_URL?>assets/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?=BASE_URL?>assets/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?=BASE_URL?>assets/css/themes/all-themes.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="<?=BASE_URL?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- Top Bar -->
        <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="#">Kurir Panel Toko Nia</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $db = "toko_nia";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $db);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }


                
                $Pesanan = mysqli_num_rows(mysqli_query($conn,"SELECT*FROM pesanan WHERE status='proses'"));
                $jumlahNotifikasi=$Pesanan;



                ?> 
             <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                         <?php
                            if(!empty($jumlahNotifikasi)){
                                echo '<span class="label-count">'.$jumlahNotifikasi.'</span>';
                            }
                        ?>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="header"> <?php
                                    if(!empty($jumlahNotifikasi)){
                                        echo "$jumlahNotifikasi Notifikasi Baru";
                                    }else{
                                        echo "Tidak ada Notifikasi Baru";
                                    }
                                    ?> 
                            </li>  
                              <?php
                             if(!empty($jumlahNotifikasi)){
                              echo ' <li class="body">';
                              echo ' <ul class="menu">';
                              
                                    $QueryOrder = mysqli_query($conn,"SELECT * FROM pesanan WHERE status!='diterima'");
                                    while ($DataOrder = mysqli_fetch_array($QueryOrder))
                                    {
                                    
                                    $id_transaksi = $DataOrder['id_pesanan'];
                                    $tanggal = $DataOrder['tanggal'];
                                    $StatusTransaksi = $DataOrder['status'];
                                    
                                            if($StatusTransaksi=="proses"){
                                            echo '<li>';
                                            echo '  <a href="?page=pesanan&act=detail&id='.$id_transaksi.'">';
                                            echo '  <div class="icon-circle bg-cyan">';
                                            echo '<i class="material-icons">add_shopping_cart</i> </div>';
                                            echo ' <div class="menu-info">';
                                            echo '          <h4> ID Pesanan : '.$id_transaksi.' <div class="font-bold col-cyan"> Status : Diproses <div>  </h4>';
                                            echo '          <p><i class="material-icons">access_time</i>'.$tanggal.'<p>';
                                            echo '          <p>Silahkan Lakukan Pengiriman</p>';
                                            echo ' </div>';
                                            echo '  </a>';
                                            echo ' </li>';


                                        }


                                        
                                            if($StatusTransaksi=="menunggu"){
                                            echo '<li>';
                                            echo '  <a href="?page=pesanan&act=detail&id='.$id_transaksi.'">';
                                            echo '  <div class="icon-circle bg-cyan">';
                                            echo '<i class="material-icons">add_shopping_cart</i> </div>';
                                            echo ' <div class="menu-info">';
                                            echo '          <h4> ID Pesanan : '.$id_transaksi.' </h4>';
                                            echo '          <p><i class="material-icons">access_time</i>'.$tanggal.'<p>';
                                            echo '          <p>Pesanan</p>';
                                            echo ' </div>';
                                            echo '  </a>';
                                            echo ' </li>';

                                        }
                                    }
                                   
                                    ?>   
                                    </ul> 
                                </li> 
                            <?php }?>
                             </ul>      

                    <li class="">
                        <a href="action/logout.php" onclick="return confirm('Apakah anda yakin akan keluar ?')" title="Logout">
                            <i class="material-icons">exit_to_app</i>
                        </a>
                    </li>
            </ul>
         </div>
    </div>
    </nav>

    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <h3 style="color:white">Selamat Datang</h3>
                <h3 style="color:white"><?=$_SESSION['nama']?></h3>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">Menu</li>
                    <li class="">
                        <a href="?page=home">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="?page=rekening">
                            <i class="material-icons">credit_card</i>
                            <span>Rekening</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="?page=ongkir">
                            <i class="material-icons">local_shipping</i>
                            <span>Ongkir</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="?page=pesanan">
                            <i class="material-icons">shopping_basket</i>
                            <span>Pesanan</span>
                        </a>
                    </li>

                    
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
        
            <?php
                require_once dirname(__FILE__) . "/controller.php";
            ?>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="<?=BASE_URL?>assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?=BASE_URL?>assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?=BASE_URL?>assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?=BASE_URL?>assets/plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="<?=BASE_URL?>assets/plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="<?=BASE_URL?>assets/plugins/raphael/raphael.min.js"></script>
    <script src="<?=BASE_URL?>assets/plugins/morrisjs/morris.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="<?=BASE_URL?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?=BASE_URL?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?=BASE_URL?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?=BASE_URL?>assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?=BASE_URL?>assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?=BASE_URL?>assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?=BASE_URL?>assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?=BASE_URL?>assets/<?=BASE_URL?>assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?=BASE_URL?>assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="<?=BASE_URL?>assets/js/admin.js"></script>
    <script src="<?=BASE_URL?>assets/js/pages/tables/jquery-datatable.js"></script>
    
    <!-- Demo Js -->
    <script src="<?=BASE_URL?>assets/js/demo.js"></script>
</body>

</html>
