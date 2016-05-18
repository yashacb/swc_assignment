<?php
session_start() ;
var_dump($_POST) ;
if(isset($_POST['csrf']))
{
  try
  {
    $csrf = $_POST['csrf'] ;
    if($csrf == $_SESSION['csrf'])
    {
      $_SESSION['fromdate'] = $_POST['fromdate'] ;
      $_SESSION['todate'] = $_POST['todate'] ;
      $_SESSION['reason'] = $_POST['reason'] ;
      $_SESSION['address'] = $_POST['address'] ;
      $_SESSION['guardian'] = $_POST['guardian'] ;
      echo "Success" ;
    }
    else
    {
      throw new Exception('No csrf') ;
    }
  }
  catch (Exception $e)
  {
      echo "Incorrect csrf token" ;
  }
}
else
{
  echo "Now csrf" ;
}
?>
