<?php
  $page = isset($_GET['page'])?$_GET['page']:'';
  switch($page){
    case "home":
      include "page/home.php";
      break;

    case "detail":
      include "page/detail.php";
      break;

    case "keranjang":
      include "page/keranjang.php";
      break;

    case "pembayaran":
      include "page/pembayaran.php";
      break;

    case "lanjut":
      include "page/lanjut.php";
      break;

    case "checkout":
      include "page/checkout.php";
      break;

    case "login":
      include "page/login.php";
      break;

    case "register":
      include "page/register.php";
      break;

    case "profile":
      include "page/profile.php";
      break;

    case "riwayat":
      $act = isset($_GET['act'])?$_GET['act']:'';
      switch ($act) {
        case 'detail':
          include "page/riwayat/detail.php";
          break;

        default:
          include "page/riwayat.php";
          break;
      }
      break;

    case "barang":
      include "page/barang.php";
      break;

    default:
      include "page/home.php";
      break;
  }
?>