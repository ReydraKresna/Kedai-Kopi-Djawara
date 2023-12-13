<?php
include('../database/config.php');

    if(!isset($_GET['q'])){

    } else {
        $q = $_GET['q'];

        $query = mysqli_query($mysql,"SELECT * FROM transaction WHERE no_order='$q' ");
        if(!mysqli_num_rows($query)){
            $query = mysqli_query($mysql,"SELECT * FROM transaction WHERE name='$q' ");
        } else {

        }

    }
    
    
    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.css" rel="stylesheet">
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

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Cek Pesanan Anda</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="search" name="q"  class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                <button type="submit" class="btn btn-outline-primary" data-mdb-ripple-init>search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <br>

                <?php
                    if(!isset($_GET['q'])){
            
                    } else {
                        if($transaction = mysqli_fetch_array($query)){

                        
                ?>
                <div class="table-responsive">

                    <table class="table table-bordered" id="mytable">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Nama Kopi</td>
                                <td>No Order</td>
                                <td>Nama Customers</td>
                                <td>Total Harga</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // echo json_encode(array("data" => $data));
                                
                                    $numbering = 0;
                                    $query = mysqli_query($mysql,"SELECT * FROM transaction WHERE no_order='$q'");
                                    if(!mysqli_num_rows($query)){
                                        $query = mysqli_query($mysql,"SELECT * FROM transaction WHERE name='$q' ");
                                    } else {
                            
                                    }
                                    while($transaction = mysqli_fetch_array($query)){
        
                                        $product_post = $transaction['product_id'];
        
                                        $result = mysqli_query($mysql,"SELECT * FROM product WHERE id='$product_post'");
        
                                        $product = mysqli_fetch_array($result);
        
                                        $price = number_format($transaction['totals'],0,',','.');
        
                                        // print_r($product);
                                        $numbering += 1;
                                        echo "<tr>";
                                        echo "<td> {$numbering} </td>";
                                        echo "<td> {$product['name']} </td>";
                                        echo "<td> <a href='../payment/?trx={$transaction['no_order']}'> {$transaction['no_order']} </a> </td>";
                                        echo "<td> {$transaction['name']} </td>";
                                        echo "<td>Rp. {$price} </td>";
                                        if($transaction['status'] == 'waitting'){
                                            echo "<td ><span class='badge bg-warning'>{$transaction['status']}</span> </td>";
                                        } elseif($transaction['status'] == 'paid'){
                                            echo "<td ><span class='badge bg-success'>{$transaction['status']}</span> </td>";
                                        } else {
    
                                            echo "<td ><span >{$transaction['status']}</span> </td>";
                                        }
                                        echo "</tr>";
                                        
                                    }
                                
                            ?>
    
                        </tbody>
                        
                    </table>
                </div>
                <?php
                        } else {

                        }
                    }   
                ?>
                
            </div>
        </div>

        <!-- <div class="card">
            <div class="card-header bg-primary">
                <p>Daftar Pesanan</p>
            </div>
            <div class="card-body">
    
                <table class="table table-bordered" id="mytable">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Nama Kopi</td>
                            <td>NO Order</td>
                            <td>Nama Customers</td>
                            <td>Total Harga</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // echo json_encode(array("data" => $data));
                            $numbering = 0;
                            while($transaction = mysqli_fetch_array($query)){

                                $product_post = $transaction['product_id'];

                                $result = mysqli_query($mysql,"SELECT * FROM product WHERE id='$product_post'");

                                $product = mysqli_fetch_array($result);

                                $price = number_format($transaction['totals'],0,',','.');

                                // print_r($product);
                                $numbering += 1;
                                echo "<tr>";
                                echo "<td> {$numbering} </td>";
                                echo "<td> {$product['name']} </td>";
                                echo "<td> {$transaction['no_order']} </td>";
                                echo "<td> {$transaction['name']} </td>";
                                echo "<td>Rp. {$price} </td>";
                                echo "<td ><span >{$transaction['status']}</span> </td>";
                                echo "</tr>";
                                
                            }
                        ?>

                    </tbody>
                    
                </table>
    
            </div>
        </div> -->
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.js"></script>
    <script>

    </script>
</body>
</html>