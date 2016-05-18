<!DOCTYPE html>
<?php
  session_start() ;
  require_once '../utilities/constants.php' ;
  require_once '../utilities/functions.php' ;
  if(!isset($_SESSION['logged_in']))
    header('Location: ' . base_address . '/views/login.php') ;
  $conn = get_database_connection() ;
  $sql = "SELECT id , fromdate , todate , reason , address , guardian FROM submissions WHERE rollno = ? ORDER BY id DESC" ;
  $stmt = $conn->prepare($sql) ;
  $stmt->bind_param('s' , $_SESSION['rollno']) ;
  $stmt->bind_result($id , $fromdate , $todate , $reason , $address , $guardian) ;
  $stmt->execute() ;
?>

<!DOCTYPE html>
<html>
<title>Submissions</title>
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
h2,h3
{
  font-style: oblique;
  font-family: 'Century Gothic', sans-serif;
  letter-spacing: 1.5px ;
}
#id1
{
  background-color: white ;
  -moz-transition: background-color 1.75s;
  -webkit-transition: background-color 1.75s;
}


</style>
<body style="background:#ffcccc;color:black;" onload="callOnLoad();">

<nav class="w3-sidenav w3-card-8 w3-animate-left" style="width:15%;">
  <header class="w3-container w3-dark-grey">
    <h3 style="padding="15%";">Menu <a href="javascript:void(0)"
    onclick="w3_close()"
    class="w3-right w3-xxlarge w3-closenav" title="close sidenav" style="padding-top:10%;" >&times;</a></h3>
  </header>
  <ul class="w3-ul" >
    <a class="w3-padding" href="<?php echo base_address ?>/views/home.php" style="font-size:20px" ><span class="glyphicon glyphicon-home" style="padding-right:10%"></span>Home</a>
    <a class="w3-padding w3-pink" href="javascript:void(0)" style="font-size:20px"><span class="glyphicon glyphicon-envelope" style="padding-right:10%"></span>My Submissions</a>
    <a class="w3-padding" href="<?php echo base_address . '/controllers/logout.php' ?>" style="font-size:20px;"><span class="glyphicon glyphicon-off" style="padding-right:10%"></span>Log out</a>
  </ul>
</nav>

<div id="main" style="margin-left:15%;transition:0.4s;">

<div class="w3-container w3-margin-left">
  <span title="open sidenav" style="position:fixed;top:5px;display:none" class="w3-opennav w3-xlarge" onclick="w3_open()">&#9776;</span>
  <div class="container" style="width:65%;font-size:1.2em">
    <br><br>
    <h2>Your past submissions : </h2><br>
    <h4><b>Webmail Id</b> : <?php echo $_SESSION['username'] . '@iitg.ernet.in' ?></h4>
    <h4><b>Roll Number</b> : <?php echo $_SESSION['rollno'] ?></h4>
    <?php if(isset($_SESSION['sub'])) echo '<b><h4 style="text-align:center;color:red;">Form submitted !</h4></b>' ?><br>
    <?php for($i=0;$stmt->fetch() != NULL;$i++) : ?>
    <div class = "w3-card-4">
      <header class="w3-container w3-blue">
        <h2>Submission id&nbsp; :&nbsp; <?php echo $id?></h2>
      </header>
      <p style="padding:2%;font-size:110%;line-height:1.7em;<?php if($i == 0 && isset($_SESSION['sub'])) echo 'background-color:#ffad33;'; else echo 'background-color:white;' ; unset($_SESSION['sub']) ?>" <?php if($i == 0) echo 'id="id1"' ; ?>>
      <b>Leave Date</b>&nbsp; :&nbsp; <?php echo $fromdate?><br>
      <b>Return Date</b>&nbsp; :&nbsp; <?php echo $todate?><br>
      <b>Reason</b>&nbsp; :&nbsp; <?php echo $reason?><br>
      <b>Address during vaccation</b>&nbsp; :&nbsp; <?php echo $address?><br>
      <b>Guardian's phone number</b>&nbsp; :&nbsp; <?php echo $guardian?><p>
    </div>
    <br><br>
  <?php endfor; ?>

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
  function callOnLoad()
  {
    var obj = document.getElementById("id1") ;
    console.log(obj) ;
    if(obj != null)
    {
      console.log('dasd') ;
      obj.style.transition = "background-color 0.75s" ;
      obj.style = "background-color:white;padding:2%;font-size:110%;line-height:1.7em;" ;
    }
  }
</script>

</body>
</html>
<?php
$stmt->close() ;
$conn->close() ;
?>
