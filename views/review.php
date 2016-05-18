<!DOCTYPE html>
<?php
  session_start() ;
  require_once '../utilities/constants.php' ;
  require_once '../utilities/functions.php' ;
  if(!isset($_SESSION['logged_in']))
    header('Location: ' . base_address);
  $ref = getallheaders()['Referer'] ;
  if($ref != base_address . '/views/home.php' )
    header('Location: ' . base_address);
?>

<!DOCTYPE html>
<html>
<title>Review</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles/w3css.css">
<link rel="stylesheet" href="styles/font-awesome.min.css">
<link rel='stylesheet prefetch' href='styles/fonts.css'>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="styles/bootstrap/css/bootstrap.min.css">
<style>
textarea {
   resize: none;
}
input
{
  font-family:Roboto ;
}
@media screen and (max-width: 455px) {
    .h3 {
        font-size:16px;
    }
}
.w3-closenav {position:absolute !important;right:20px!important;top:2px!important;padding:0 !important;}
.w3-closenav:hover {background-color:transparent !important;color:#fff;}
body
{
  font-family: 'Century Gothic', sans-serif;
  -webkit-font-smoothing: antialiased;
}
a:link,a:hover,a:visited,a:active
{
  color : #000 ;
}
h3
{
  letter-spacing: 1.5px ;
  padding:7%;
}
h2,h3,h4
{
  font-style: oblique;
  font-family: 'Century Gothic', sans-serif;
  letter-spacing: 1.5px ;
}
</style>
<body style="background:#ffcccc;color:black;">

<nav class="w3-sidenav w3-card-8 w3-animate-left" style="width:15%;">
  <header class="w3-container w3-dark-grey">
    <h3 style="padding="15%";">Menu <a href="javascript:void(0)"
    onclick="w3_close()"
    class="w3-right w3-xxlarge w3-closenav" title="close sidenav" style="padding-top:10%;" >&times;</a></h3>
  </header>
  <ul class="w3-ul" >
    <a class="w3-padding w3-pink" href="<?php echo base_address ?>/views/home.php" style="font-size:20px" ><span class="glyphicon glyphicon-home" style="padding-right:10%"></span>Home</a>
    <a class="w3-padding" href="<?php echo base_address ?>/views/submissions.php" style="font-size:20px"><span class="glyphicon glyphicon-envelope" style="padding-right:10%"></span>My Submissions</a>
    <a class="w3-padding" href="<?php echo base_address . '/controllers/logout.php' ?>" style="font-size:20px;"><span class="glyphicon glyphicon-off" style="padding-right:10%"></span>Log out</a>
  </ul>
</nav>

<div id="main" style="margin-left:15%;transition:0.4s;">

<div class="w3-container w3-margin-left">
  <span title="open sidenav" style="position:fixed;top:5px;display:none" class="w3-opennav w3-xlarge" onclick="w3_open()">&#9776;</span>
  <div class="container" style="width:65%;font-size:1.2em">
    <br><br>
  <h2>Hostel Leaving Form :</h2><br>
  <h4>Review your submission :</h4>
  <br>
  <form role="form" method="POST" action="<?php echo base_address ?>/controllers/submission.php" onsubmit="return validate()" id = "submission" >
    <div class="form-group">
      <label for="email">Webmail Id:</label>
      <input value = "<?php echo $_SESSION['username'].'@iitg.ernet.in' ?>" type="email" class="form-control w3-sand" id="email" placeholder="Enter email" autocomplete="off" disabled>
    </div>
    <br>
    <div class="form-group">
      <label for="rollno">Roll No:</label>
      <input value = "<?php echo $_SESSION['rollno'] ?>" pattern="[0-9]{9}" type="text" class="form-control w3-sand" id="rollno" placeholder="Enter rollno" autocomplete="off" disabled>
    </div>
    <br>
    <div class="form-inline row">
      <div class="col-md-6">
        <label for="fromdate" style="padding-right:5%;">Date and time of leave :</label>
        <input disabled required style="width:50%" value = "<?php echo isset($_SESSION['fromdate']) ? $_SESSION['fromdate'] : date('Y-m-d') ?>" type="datetime" class="form-control w3-sand" id="fromdate" name = "fromdate" placeholder="From date" autocomplete="off">
      </div>
      <div class="col-md-6">
        <label for="todate" style="padding-right:5%;">Date and time of return :</label>
        <input disabled required style="width:50%;" value = "<?php echo isset($_SESSION['todate']) ? $_SESSION['todate'] : date('Y-m-d') ?>" type="datetime" class="form-control w3-sand" id="todate" name = "todate" placeholder="T date" autocomplete="off">
      </div>
    </div>
    <br>
    <div class = "form-group">
      <label for="reason" >Reason for leaving :</label>
      <textarea form="submission" disabled required class="form-control w3-sand" id="reason" name="reason" placeholder="Reason for leaving (maximum 4096 characters)" maxlength="4096" rows="5"><?php echo isset($_SESSION['reason']) ? $_SESSION['reason'] : "" ?></textarea>
    </div>
    <br>
    <div class = "form-group">
      <label for="address" >Address during leave :</label>
      <input disabled autocomplete="off" required value = "<?php echo isset($_SESSION['address']) ? $_SESSION['address'] : "" ?>" type="text" class="form-control w3-sand" id="address" name="address" placeholder="Address during leave" maxlength="1024">
    </div>
    <div class = "form-group">
      <label for="guardian" >Phone number of guardian during leave :</label>
      <input disabled autocomplete="off" pattern="[0-9,]+" value = "<?php echo isset($_SESSION['guardian']) ? $_SESSION['guardian'] : "" ?>" type="text" class="form-control w3-sand" id="guardian" name="guardian" placeholder="Phone number of guardian" maxlength="1024">
    </div>
    <br>
    <div lass="form-control">
      <button style="float:right;font-size:1.1em" type="submit" class="btn btn-primary">Final Submit</button>
      <input type="button" style="float:left;font-size:1.1em" class="btn btn-primary" value="Change data" id="clear" onclick="back()">
    </div>
  </form>
</div>
</div>

</div>

<script>
  function back()
  {
    window.location = "<?php echo base_address ?>/views/home.php" ;
  }
  function w3_open() {
    document.getElementById("main").style.marginLeft = "15%";
    document.getElementsByClassName("w3-sidenav")[0].style.width = "15%";
    document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
    document.getElementsByClassName("w3-opennav")[0].style.display = 'none';
  }
  function w3_close() {
    document.getElementById("main").style.marginLeft = "0";
    document.getElementsByClassName("w3-sidenav")[0].style.display = "none";
    document.getElementsByClassName("w3-opennav")[0].style.display = "inline-block";
  }
  function clearall()
  {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0' + dd ;
    }

    if(mm<10) {
        mm = '0' + mm ;
    }
    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("reason").value = "" ;
    document.getElementById("address").value = "" ;
    document.getElementById("guardian").value = "" ;
    document.getElementById("fromdate").value = today ;
    document.getElementById("todate").value = today ;
  }
  function validate()
  {
    var d1 = Date.parse(document.getElementById("fromdate").value) ;
    var d2 = Date.parse(document.getElementById("todate").value) ;
    if(d1 > d2)
    {
      alert("Leave date is further than return date . Looks like you are a time traveller . Recheck your submission .") ;
      return false ;
    }
    return true ;
  }
  <?php if(isset($_SESSION['rev_err'])) : ?>
    alert('You already have a submisssion with the same date . Recheck you submission , just to be sure .') ;
  <?php endif ; ?>
</script>

</body>
</html>
