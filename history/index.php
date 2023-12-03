<?php
include('../database/config.php');

$query = mysqli_query($mysql,"SELECT * FROM transaction");

// $data = array();
//     while ($row = $query->fetch_assoc()) {
//         $data[] = $row;
//     }


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
            <div class="card-header">
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
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#mytable').DataTable();
            
        });

    </script>
</body>
</html>