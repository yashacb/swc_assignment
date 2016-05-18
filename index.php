<?php
  require 'utilities/constants.php' ;
  session_start() ;
  if(!isset($_SESSION['logged_in']))
    header('Location: ' . base_address . '/views/login.php') ;
  else
  {
    header('Location: ' . base_address . '/views/home.php') ;
  }
?>
