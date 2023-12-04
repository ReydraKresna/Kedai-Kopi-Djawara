<?php
    include('../database/config.php');
    
    if(!isset($_GET['trx'])){
        echo "<script> window.location = '../index.php' </script>";
    }

    $trx = $_GET['trx'];

    $query = mysqli_query($mysql,"SELECT * FROM transaction WHERE no_order='$trx'");
    if(!mysqli_fetch_array($query)){
        echo "<script> window.location = '../index.php' </script>";
    } else {
        $query = mysqli_query($mysql,"SELECT * FROM transaction WHERE no_order='$trx'");
        $transaction = mysqli_fetch_array($query);
        
    
        $price = number_format($transaction['totals'],0,',','.');
    
        $product_post = $transaction['product_id'];
    
        $result = mysqli_query($mysql,"SELECT * FROM product WHERE id='$product_post'");
    
        $product = mysqli_fetch_array($result);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,700;1,700&display=swap"
      rel="stylesheet"
    />
    <style>
        *{
            font-family: "Poppins", sans-serif;
        }
    </style> -->
</head>
<body>
    

    <div class="container mt-5">

        <?php

            $gets = isset($_GET['status']);
            if($gets){
                
                if($_GET['status'] == 'success'){

                    echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>";
                        echo "Pesanan Berhasil dipesan";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                } else if($_GET['status'] == 'failed'){
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
                        echo "Pesanan gagal <br>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            } else {

            }
        ?>


        <div class="card">

            <div class="card-header bg-primary text-white">
                <h6>Pesanan</h6>
            </div>

            <div class="card-body">

                <table class="" border="0" id="mytable">
                    <tr>
                        <td>Nama kopi</td>
                        <td style="padding-left: 10px;">:</td>
                        <td style="padding-left: 10px;"><?php echo $product['name'] ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td style="padding-left: 10px;">:</td>
                        <td style="padding-left: 10px;"><?php echo $transaction['jumlah'] ?></td>
                    </tr>
                    <tr>
                        <td>No Order</td>
                        <td style="padding-left: 10px;">:</td>
                        <td style="padding-left: 10px;"><?php echo $transaction['no_order'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama Customers</td>
                        <td style="padding-left: 10px;">:</td>
                        <td style="padding-left: 10px;"><?php echo $transaction['name'] ?></td>
                    </tr>
                    <tr>
                        <td>total</td>
                        <td style="padding-left: 10px;">:</td>
                        <td style="padding-left: 10px;">Rp. <?php echo $price ?></td>
                    </tr>
                    
                        
                </table>
                <br>

                <?php
                    if($transaction['status'] == 'waitting'){
                        echo "<h6>Status: <span style='color:green'>{$transaction['status']} </span></h6>";
                    } elseif($transaction['status'] == 'paid'){
                        echo "<h6>Status:  <span style='color:green'>{$transaction['status']} </span></h6>";
                    } else {

                        echo "<h6>Status:  {$transaction['status']} </h6>";
                    }
                    
                ?>

                <br>

                <?php
                    if($transaction['status'] != "waitting"){
                        echo "<p> Transaksi Berhasil. pesanan anda akan diproses </p><br>";
                        if($transaction['uang'] > $transaction['totals']){
                            $to = $transaction['uang'] - $transaction['totals'];
                            echo "uang anda: Rp. ".number_format($transaction['uang'],0,',','.');
                            echo "<br>";
                            echo "kembalian anda RP. ".number_format($to,0,',','.');
                        } else {
                            echo "uang Anda Pas.";
                        }
                        
                    }
                ?>

            </div>


        </div>

        <br><br>

        <?php 
            if($transaction['status'] == "waitting"){
                
        ?>
        <div class="card">

            <div class="card-header bg-primary text-white">
                <h6>Pembayaran</h6>
            </div>

            <div class="card-body">



                <form action="store.php" method="post">

                    <input type="number" name="uang" class="form-control" placeholder="masukan uang anda" required>
                    <p style="color:red">
                        <?php 
                            if(isset($_GET['message'])){
                                echo str_replace('_',' ',$_GET['message']);
                            } else {

                            } 
                        ?>
                    </p>
                    <input type="hidden" name="trx" value="<?php echo $_GET['trx'] ?>">
                    <br>
                    <button class="btn btn-success">
                        Bayar
                    </button>

                </form>
                




            </div>


        </div>
        <?php
            } else {


            }
        ?>


    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
        });
        $('.btn-close').on('click', function() {

            const searchParams = new URLSearchParams(window.location.search);
            let trx = searchParams.get('trx');
            // console.log(trx);
            
            window.location = 'index.php?trx='+trx;
        });
    </script>
    

</body>
</html>