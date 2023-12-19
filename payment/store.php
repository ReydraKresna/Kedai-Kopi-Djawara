<?php

    include('../database/config.php');

    if(!isset($_POST['trx'])){
        echo "<script> window.location = '../order/index.php' </script>";
    }

    if(!isset($_POST['uang'])){
        echo "<script> window.location = '../order/index.php' </script>";
    }

    $uang = $_POST['uang'];
    $trx = $_POST['trx'];

    $cek_uang = $query = mysqli_query($mysql,"SELECT * FROM transaction WHERE no_order='$trx'");

    $result = mysqli_fetch_array($cek_uang);

    if($uang < $result['totals'] ){

        // header('location:index.php?trx={$trx}&status=failed&message=*_uang_anda_kurang');

        echo "<script> window.location = 'index.php?trx={$trx}&status=failed&message=*_uang_anda_kurang' </script>";


    } else {
        
        $transaction = mysqli_query($mysql,"UPDATE transaction SET status='paid' , uang='$uang'  WHERE no_order='$trx' ");
    
    
        if($transaction){
    
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $result['phone'],
                    'message' => 'Transaksi Berhasil, Pesanan Anda Akan diproses. link invoice: https://kedai.rohidtzz.live/payment/?trx='.$trx,
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: 8i+z-ZSwpY40__8sbQGz'
                ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
    
    
            echo "<script> window.location = 'index.php?trx={$trx}' </script>";
    
    
    
        }
    }




?>