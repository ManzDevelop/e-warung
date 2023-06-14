<?php
	
    if(isset($_GET['page'])){
        switch($_GET['page']){
            case "home":
                include "page/home.php";
                break;
                
            case "kategori":
                $act = isset($_GET['act'])?$_GET['act']:'';
                switch ($act) {
                    case 'add':
                        include "page/kategori/add.php";
                        break;
                    
                    case 'edit':
                        include "page/kategori/edit.php";
                        break;

                    default:
                        include "page/kategori.php";
                        break;
                }
                break;
                
            case "ongkir":
                $act = isset($_GET['act'])?$_GET['act']:'';
                switch ($act) {
                    case 'add':
                        include "page/ongkir/add.php";
                        break;
                    
                    case 'edit':
                        include "page/ongkir/edit.php";
                        break;

                    default:
                        include "page/ongkir.php";
                        break;
                }
                break;
                
            case "barang":
                $act = isset($_GET['act'])?$_GET['act']:'';
                switch ($act) {
                    case 'add':
                        include "page/barang/add.php";
                        break;
                    
                    case 'edit':
                        include "page/barang/edit.php";
                        break;

                    default:
                        include "page/barang.php";
                        break;
                }
                break;
                
            case "rekening":
                $act = isset($_GET['act'])?$_GET['act']:'';
                switch ($act) {
                    case 'add':
                        include "page/rekening/add.php";
                        break;
                    
                    case 'edit':
                        include "page/rekening/edit.php";
                        break;

                    default:
                        include "page/rekening.php";
                        break;
                }
                break;
                
            case "pemilik":
                $act = isset($_GET['act'])?$_GET['act']:'';
                switch ($act) {
                    case 'add':
                        include "page/pemilik/add.php";
                        break;
                    
                    case 'edit':
                        include "page/pemilik/edit.php";
                        break;

                    default:
                        include "page/pemilik.php";
                        break;
                }
                break;
                
            case "kurir":
                $act = isset($_GET['act'])?$_GET['act']:'';
                switch ($act) {
                    case 'add':
                        include "page/kurir/add.php";
                        break;
                    
                    case 'edit':
                        include "page/kurir/edit.php";
                        break;

                    default:
                        include "page/kurir.php";
                        break;
                }
                break;
                
            case "pesanan":
				$act = isset($_GET['act'])?$_GET['act']:'';
				switch ($act) {
					case 'detail':
						include "page/pesanan/detail.php";
						break;

					default:
						include "page/pesanan.php";
						break;
				}
				break;
		
            case "pembayaran":
				$act = isset($_GET['act'])?$_GET['act']:'';
				switch ($act) {
					case 'detail':
						include "page/pembayaran/detail.php";
						break;

					default:
						include "page/pembayaran.php";
						break;
				}
				break;

            case "pembeli":
                include "page/pembeli.php";
                break;
                    
            default:
                include "page/home.php";
                break;
        }
    }else{
        include "page/home.php";
    }
    