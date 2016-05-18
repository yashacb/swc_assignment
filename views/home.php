<!DOCTYPE html>
<?php
  session_start() ;
  require_once '../utilities/constants.php' ;
  require_once '../utilities/functions.php' ;
  if(!isset($_SESSION['logged_in']))
    header('Location: ' . base_address . '/views/login.php') ;
  $csrf = generate_csrf() ;
  $_SESSION['csrf'] = $csrf ;
  unset($_SESSION['rev_err']) ;
?>

<!DOCTYPE html>
<html>
<title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles/w3css.css">
<link rel="stylesheet" href="styles/font-awesome.min.css">
<link rel='stylesheet prefetch' href='styles/fonts.css'>
<link rel='stylesheet prefetch' href='styles/font-awesome.min.css'>
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
  font-size:1.5em ;
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
input
{
  font-family:Roboto ;
}
h2,h3
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
    <a class="w3-padding w3-pink" href="#" style="font-size:20px" ><span class="glyphicon glyphicon-home" style="padding-right:10%"></span>Home</a>
    <a class="w3-padding" href="<?php echo base_address ?>/views/submissions.php" style="font-size:20px"><span class="glyphicon glyphicon-envelope" style="padding-right:10%"></span>My Submissions</a>
    <a class="w3-padding" href="<?php echo base_address . '/controllers/logout.php' ?>" style="font-size:20px;"><span class="glyphicon glyphicon-off" style="padding-right:10%"></span>Log out</a>
  </ul>
</nav>

<div id="main" style="margin-left:15%;transition:0.4s;">

<div class="w3-container w3-margin-left">
  <span title="open sidenav" style="position:fixed;top:5px;display:none" class="w3-opennav w3-xlarge" onclick="w3_open()">&#9776;</span>
  <div class="container" style="width:65%;font-size:1.2em">
    <br><br>
  <h2>Hostel Leaving Form :</h2><br><br>
  <form role="form" method="POST" action="<?php echo base_address?>/controllers/review.php" onsubmit="return validate()" id = "submission" >
    <input id = "csrf" type = "hidden" name = "csrf" value = "<?php echo $csrf ?>" >
    <div class="form-group">
      <label for="email">Webmail Id:</label>
      <input title = "Your webmail id" value = "<?php echo $_SESSION['username'].'@iitg.ernet.in' ?>" type="email" class="form-control w3-white" id="email" placeholder="Enter email" autocomplete="off" disabled>
    </div>
    <br>
    <div class="form-group">
      <label for="rollno">Roll No:</label>
      <input title = "Your roll number" value = "<?php echo $_SESSION['rollno'] ?>" pattern="[0-9]{9}" type="text" class="form-control w3-white" id="rollno" placeholder="Enter rollno" autocomplete="off" disabled>
    </div>
    <br>
    <div class="form-inline row">
      <div class="col-md-6">
        <label for="fromdate" style="padding-right:5%;">Leave :</label>
        <input title="date and time you leave the hostel" maxlength="100" onkeyup="saveData();" required style="width:50%" value = "<?php echo isset($_SESSION['fromdate']) ? $_SESSION['fromdate'] : date('Y-m-d') . ' 10-10' ?>" type="datetime" class="form-control w3-white" id="fromdate" name = "fromdate" placeholder="From date" autocomplete="off">
      </div>
      <div class="col-md-6">
        <label for="todate" style="padding-right:5%;">Return :</label>
        <input title = "date and time you reach the hostel after leave" maxlength="100" onkeyup="saveData();" required style="width:50%;" value = "<?php echo isset($_SESSION['todate']) ? $_SESSION['todate'] : date('Y-m-d') . ' 10-10' ?>" type="datetime" class="form-control w3-white" id="todate" name = "todate" placeholder="T date" autocomplete="off">
      </div>
    </div>
    <br>
    <div class = "form-group">
      <label for="reason" >Reason for leaving :</label>
      <textarea title = "briefly mention the reason for leave" onkeyup="saveData();" form="submission" required class="form-control" id="reason" name="reason" placeholder="Reason for leaving (maximum 4096 characters)" maxlength="4096" rows="5"><?php echo isset($_SESSION['reason']) ? $_SESSION['reason'] : "" ?></textarea>
    </div>
    <br>
    <div class = "form-group">
      <label for="address" >Address during leave :</label>
      <input title = "address of the play you will be staying while leave" onkeyup="saveData();" autocomplete="off" required value = "<?php echo isset($_SESSION['address']) ? $_SESSION['address'] : "" ?>" type="text" class="form-control" id="address" name="address" placeholder="Address during leave" maxlength="1024">
    </div>
    <div class = "form-group">
      <label for="guardian" >Phone number of guardian during leave :</label>
      <input title = "phone number of guardian during your leave" maxlength="10" onkeyup="saveData();" autocomplete="off" pattern="[0-9,]+" value = "<?php echo isset($_SESSION['guardian']) ? $_SESSION['guardian'] : "" ?>" type="text" class="form-control" id="guardian" name="guardian" placeholder="Phone number of guardian" maxlength="25">
    </div>
    <br>
    <div lass="form-control">
      <button style="float:right;font-size:1.1em" type="submit" class="btn btn-primary">Submit</button>
      <input type="button" style="float:left;font-size:1.1em" class="btn btn-primary" value="Clear all" id="clear" onclick="clearall();">
    </div>
  </form>
  <h3 style="color:red;">Format of date fields : yyyy-mm-dd(space)hh-mm(24hrs format) .</h3>
</div>
</div>

</div>

<script>
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
    today = yyyy + '-' + mm + '-' + dd + ' 10-10';
    document.getElementById("reason").value = "" ;
    document.getElementById("address").value = "" ;
    document.getElementById("guardian").value = "" ;
    document.getElementById("fromdate").value = today ;
    document.getElementById("todate").value = today ;
  }
  function validate()
  {
    var fromdate = document.getElementById("fromdate").value ;
    var parsedFrom = parseDate(fromdate) ;
    var todate = document.getElementById("todate").value ;
    var parsedTo = parseDate(todate) ;
    if(parsedFrom != false && parsedTo != false)
    {
      if(parsedFrom[0] < parsedTo[0])
        return true ;
      else if(parsedFrom[0] > parsedTo[0])
      {
        alert('Leave date is further than return date !!') ;
        return false ;
      }
      else
      {
        if(parsedFrom[1].hrs > parsedTo[1].hrs)
        {
          alert('Leave date is further than return date !!') ;
          return false ;
        }
        else if(parsedFrom[1].hrs < parsedTo[1].hrs)
          return true ;
        else
        {
          if(parsedFrom[1].mins > parsedTo[1].mins)
          {
            alert('Leave date is further than return date !!') ;
            return false ;
          }
          else if(parsedFrom[1].mins < parsedTo[1].mins)
            return true ;
          else
          {
            alert('Leave date and return date are the same .') ;
            return false ;
          }
        }

      }
    }
    else
      return false ;

  }
  function parseDate(str)
  {
    var splitted = str.split(' ') ;
    if(splitted.length != 2)
    {
      alert('Incorrect date format .');
      return false
    }
    else
    {
      try
      {
        var d1 = Date.parse(splitted[0]) ;
        var time = splitted[1] ;
        var t1 = time.split('-') ;
        var time = {hrs : parseInt(t1[0]) , mins : parseInt(t1[1])} ;
        if((time.hrs < 0 || time.hrs > 23) || (time.mins < 0 || time.mins > 59))
        {
          alert('Incorrect time entered .') ;
          return false ;
        }
        return [d1 , time] ;
      }
      catch (e)
      {

      }
    }
  }
  function saveData()
  {
    var fromdate = document.getElementById("fromdate").value ;
    var todate = document.getElementById("todate").value ;
    var reason = document.getElementById("reason").value ;
    var address = document.getElementById("address").value ;
    var guardian = document.getElementById("guardian").value ;
    var csrf = document.getElementById("csrf").value ;
    console.log(csrf) ;
    var xhttp = new XMLHttpRequest() ;
    xhttp.open("POST", "<?php echo base_address ?>/controllers/savedata.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var str = "fromdate="+fromdate+"&todate="+todate+"&reason="+reason+"&address="+address+"&guardian="+guardian+"&csrf="+csrf ;
    console.log(str);
    xhttp.send(str);
  }
</script>

</body>
</html>
