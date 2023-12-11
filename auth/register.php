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
<form action="store.php" method="POST">
  <div class="form-item">
    <label>Username</label>
    <div class="input-wrapper">
      <input required name="username" type="text" id="username" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" data-lpignore="true"/>
    </div>
  </div>
  <div class="form-item">
    <label>Nama lengkap</label>
    <div class="input-wrapper">
      <input required name="name" type="text" id="username" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" data-lpignore="true"/>
    </div>
  </div>
  <div class="form-item">
    <label>No HP</label>
    <div class="input-wrapper">
      <input required name="hp" type="number" id="username" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" data-lpignore="true"/>
    </div>
  </div>
  <div class="form-item">
    <label>Email</label>
    <div class="input-wrapper">
      <input required name="email" type="email" id="username" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" data-lpignore="true"/>
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
  <button id="submit">Submit</button>
</form>
<!-- partial -->

  <script  src="./script.js"></script>

</body>
</html>
