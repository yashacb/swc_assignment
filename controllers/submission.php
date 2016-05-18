<?php
  session_start() ;
  require_once '../utilities/constants.php' ;
  require_once '../utilities/functions.php' ;
  if(!isset($_SESSION['logged_in']))
    header('Location: ' . base_address . '/views/login.php') ;
  try
  {
      $conn = get_database_connection() ;
      if($conn->connect_error)
        throw new Exception('Database connection cannot be established') ;
      else
      {
        $sql = "INSERT INTO submissions (rollno , fromdate , todate , reason , address , guardian) VALUES (?,?,?,?,?,?)" ;
        $stmt = $conn->prepare($sql) ;
        $stmt->bind_param('ssssss' , $_SESSION['rollno'] , $_SESSION['fromdate'] , $_SESSION['todate'] , $_SESSION['reason'] , $_SESSION['address'] , $_SESSION['guardian']) ;
        $stmt->execute() ;
        echo $stmt->fetch() ;
        $stmt->close() ;
        $conn->close() ;
        $_SESSION['sub'] = 1 ;
        header('Location: ' . base_address . '/views/submissions.php') ;
      }
  }
  catch (Exception $e)
  {
    echo $e ;
    $stmt->close() ;
    $conn->close() ;
  }

?>
