<?php
    include('../database/config.php');

    $product_post = $_POST['product'];
    $unit = $_POST['unit'];
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);

    $product = mysqli_query($mysql,"SELECT * FROM product WHERE id=$product_post");

    if($unit > mysqli_fetch_array($product)['stock']){

        echo "<script> window.location = 'index.php?status=failed&message=stock_tidak_mencukupi' </script>";
        
    } else {
        if(!$unit == 1){
    
            $product = mysqli_query($mysql,"SELECT * FROM product WHERE id=$product_post");
            if(mysqli_fetch_array($product)['stock'] <= $unit ){
        
                echo "<script> window.location = 'index.php?status=failed&message=jumlah_pesanan_melebihi_stock' </script>";
        
            } else {
        
                $product = mysqli_query($mysql,"SELECT * FROM product WHERE id=$product_post");
                $total = mysqli_fetch_array($product)['price'] * $unit;
                
                
                
                $mt_rand = mt_rand(100, 9999);
                $no_order = 'INV-'.$mt_rand;
            
                $query = "INSERT INTO transaction (product_id,no_order,jumlah,uang,status,name,email,phone,totals) VALUES ($product_post,'$no_order',$unit,NULL,'waitting','$name','$email','$phone',$total)";
            
                $result = mysqli_query($mysql,$query);
            
                // print_r($result);
                
            
                if($result){
            
            
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
                    'target' => $phone,
                    'message' => 'Pesan Berhasil, Silahkan Melakukan Pembayaran. link invoice: https://kedai.rohidtzz.live/payment/?trx='.$no_order,
                    ),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: 8i+z-ZSwpY40__8sbQGz'
                    ),
                    ));
            
                    $response = curl_exec($curl);
            
                    curl_close($curl);
            
                    $product = mysqli_query($mysql,"SELECT * FROM product WHERE id=$product_post");
            
            
                    $stock = mysqli_fetch_array($product)['stock'] - $unit;
            
            
                    $kurangi_stock = mysqli_query($mysql,"UPDATE product SET stock=$stock WHERE id=$product_post ");
            
            
                    echo "<script> window.location = '../payment/?trx={$no_order}' </script>";
                } else {
                    echo "<script> window.location = 'index.php?status=failed' </script>";
                }
            }
        } else {
    
            $product = mysqli_query($mysql,"SELECT * FROM product WHERE id=$product_post");
            $total = mysqli_fetch_array($product)['price'] * $unit;
            
            
            
            $mt_rand = mt_rand(100, 9999);
            $no_order = 'INV-'.$mt_rand;
        
            $query = "INSERT INTO transaction (product_id,no_order,jumlah,uang,status,name,email,phone,totals) VALUES ($product_post,'$no_order',$unit,NULL,'waitting','$name','$email','$phone',$total)";
        
            $result = mysqli_query($mysql,$query);
        
            // print_r($result);
            
        
            if($result){
        
        
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
                'target' => $phone,
                'message' => 'Pesan Berhasil, Pesanan Anda Sedang kami proses. link invoice: https://kedai.rohidtzz.live/payment/?trx='.$no_order,
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: 8i+z-ZSwpY40__8sbQGz'
                ),
                ));
        
                $response = curl_exec($curl);
        
                curl_close($curl);
        
                $product = mysqli_query($mysql,"SELECT * FROM product WHERE id=$product_post");
        
        
                $stock = mysqli_fetch_array($product)['stock'] - $unit;
        
        
                $kurangi_stock = mysqli_query($mysql,"UPDATE product SET stock=$stock WHERE id=$product_post ");
        
        
                echo "<script> window.location = '../payment/?trx={$no_order}' </script>";
            } else {
                echo "<script> window.location = 'index.php?status=failed' </script>";
            }
    
        }
    }




    // print_r($_POST);
?>