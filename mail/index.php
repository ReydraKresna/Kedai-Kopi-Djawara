<?php
    require '../vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pesan'])){
        $nama = $_POST['name'];
        $email = $_POST['email'];
        $pesan = $_POST['pesan'];
        $mail = new PHPMailer; 
        $mail->IsSMTP();
        $mail->SMTPSecure = 'ssl'; 
        $mail->Host = "smtp.titan.email"; //host masing2 provider email
        $mail->SMTPDebug = 0;
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->Username = "contact@rohidtzz.live"; //user email
        $mail->Password = "zsedc0009"; //password email 
        $mail->SetFrom("contact@rohidtzz.live","Nama pengirim"); //set email pengirim
        $mail->Subject = "Testing"; //subyek email
        $mail->AddAddress('gemersrasta@gmail.com','rohidtzz');  //tujuan email
        $mail->MsgHTML("Nama : $nama <br/> Email : $email <br/> Pesan : $pesan");
        if($mail->Send()){
            echo "<script>alert('Terimakasih sudah menghubungi kami')  </script>";
            echo "<script> window.location = '../index.php?' </script>";
            // header("location:index.php");
        }
    } else {
        echo "<script>alert('Gagal')  </script>";
        echo "<script> window.location = '../index.php?' </script>";
    }
?>