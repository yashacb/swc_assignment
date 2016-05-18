<?php
  require_once '../utilities/constants.php' ;
  require_once '../utilities/functions.php' ;
  if(isset($_POST['username']) && isset($_POST['rollno']) && isset($_POST['csrf']))
  {
    session_start() ;
    $csrf = $_SESSION['csrf'] ;
    if(!$_POST['csrf'] == $csrf)
    {
      header('Location: ' . base_address . '/error.php') ;
    }
    else
    {
      $conn = get_database_connection() ;
      if(!$conn->connect_errno)
      {
        $sql = "SELECT webmail , rollno FROM user WHERE webmail = ? AND rollno = ?" ;
        $stmt = $conn->prepare($sql) ;
        $stmt->bind_param("ss" , $_POST['username'] , $_POST['rollno'] ) ;
        $stmt->bind_result($webmail , $rollno) ;
        $stmt->execute() ;
        $stmt->fetch() ;
        if($webmail == $_POST['username'])
        {
          echo "Hello $webmail" ;
          $_SESSION['logged_in'] = true ;
          $_SESSION['username'] = $webmail ;
          $_SESSION['rollno'] = $rollno ;
          $conn->close() ;
          header('Location: '.base_address.'/views/home.php') ;
        }
        else
        {
          $_SESSION['error'] = True ;
          $conn->close() ;
          $stmt->close() ;
          header('Location: ' . base_address . '/index.php') ;
        }
      }
      else
      {
        $conn->close() ;
        $stmt->close() ;
        header('Location: ' . base_address . 'error.php') ;
      }
    }
  }
  else
  {
    header('Location: ' . base_address . 'index.php') ;
  }
?>
