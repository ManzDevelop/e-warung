<?php
    session_start();
    // error_reporting(~E_NOTICE);
    define("BASE_URL","http://localhost/toko_nia/");
    define('DB_SERVER', 'localhost');
    define('DB_DATABASE', 'toko_nia');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('KEY','b01a4ddc4382eb0454381e3a20f04497');
    define('ASAL','17');

    try{
        $pdo = new PDO("mysql:host=". DB_SERVER .";dbname=".DB_DATABASE, DB_USERNAME, DB_PASSWORD); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));
    } catch(PDOException $e){
        die("ERROR: Could not connect. " . $e->getMessage());
    }

    function cutText($text, $length)
    {
        if(strlen($text) > $length){
            return substr($text, 0, $length)." ...";
        }
        else{
            return $text;
        }
    }

    function rupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
    }

?>