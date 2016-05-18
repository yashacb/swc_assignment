<?php
require_once '../utilities/constants.php' ;
require_once '../utilities/functions.php' ;
session_start() ;
try
{
  $csrf = $_SESSION['csrf'] ;
  if($csrf != $_POST['csrf'] && isset($_SESSION['logged_in']))
    throw new Exception('No csrf exception') ;
  else
  {
    $_SESSION['fromdate'] = $_POST['fromdate'] ;
    $_SESSION['todate'] = $_POST['todate'] ;
    $_SESSION['reason'] = $_POST['reason'] ;
    $_SESSION['address'] = $_POST['address'] ;
    $_SESSION['guardian'] = $_POST['guardian'] ;
    $sql = "SELECT id FROM submissions WHERE fromdate = ? AND todate = ? " ;
    $conn = get_database_connection() ;
    if($conn != false)
    {
      $stmt = $conn->prepare($sql) ;
      $stmt->bind_param('ss' , $_POST['fromdate'] , $_POST['todate']) ;
      $stmt->bind_result($id) ;
      $stmt->execute() ;
      if($stmt->fetch() != false)
      {
        $_SESSION['rev_err'] = 1 ;
        header('Location: ' . base_address . '/views/review.php') ;
      }
      else
        header('Location: ' . base_address . '/views/review.php') ;
      $stmt->close() ;
      $conn -> close() ;
    }
    else
    {
      echo 'Database connection error .' ;
      $stmt->close() ;
      $conn -> close() ;
    }
  }
}
catch (Exception $e)
{
  var_dump($e) ;
  $stmt->close() ;
  $conn -> close() ;
  //header('Location: ' . base_address . '/error.php');
}


?>
