<?php
  session_start() ;
  require '../utilities/functions.php' ;
  require '../utilities/constants.php' ;
  if(isset($_SESSION['logged_in']))
    header('Location: ' . base_address ) ;

  $csrf = generate_csrf() ;
  $_SESSION['csrf'] = $csrf ;
?>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login In</title>
    <link rel="stylesheet" href="styles/css/reset.css">
    <link rel='stylesheet prefetch' href='styles/fonts.css'>
    <link rel='stylesheet prefetch' href='styles/font-awesome.min.css'>
    <link rel="stylesheet" href="styles/css/style.css">
  </head>

<body>
<div class="pen-title">
  <h1>Log In Portal</h1>
</div>
<div class="container">
  <div class="card"></div>
  <div class="card">
    <h1 class="title">Login</h1>
    <form method = "POST" action = "<?php echo base_address . '/controllers/login.php' ?>" >
      <input type="hidden" name = "csrf" value = "<?php echo $csrf ; ?>"  />
      <div class="input-container">
        <input type="text" id="Username" required="required" name = "username" autocomplete="off" />
        <label for="Username">Webmail Id</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="text" id="roll_number" required="required" name = "rollno" autocomplete="off" />
        <label for="roll_number">Roll Number</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button><span style="color:red;">Log In</span></button>
      </div>
      <br><br><br>
    </form>
    <?php if (isset($_SESSION['error'])) : ?>
      <h1 style="color:red ;" class = "pen-title">Incorrect login information !</h1>
    <?php endif ?>
    <?php unset($_SESSION['error']) ?>
  </div>
</div>
<script src='styles/jquery.min.js'></script>
<script src="styles/js/index.js"></script>
</body>
</html>
