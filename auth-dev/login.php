<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Password Input Light</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<form onsubmit="return false">
  <div class="form-item">
    <label>Username</label>
    <div class="input-wrapper">
      <input required name="username" type="text" id="username" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" data-lpignore="true"/>
    </div>
  </div>
  <div class="form-item">
    <label>Password</label>
    <div class="input-wrapper">
      <input required name="password" type="password" id="password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" data-lpignore="true"/>
      <button type="button" id="eyeball">
        <div class="eye"></div>
      </button>
      <div id="beam"></div>
    </div>
  </div>
  <button id="submit">Login</button>
  <a href="register.php" style="text-decoration:none;" id="daftar"><button style="margin-left:30%" id="submit">Daftar</button></a>
</form>
<!-- partial -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $('#daftar').on('click', function() {

        window.location = 'register.php';
        });
    </script>
  <script  src="./script.js"></script>

</body>
</html>
