<?php
  require_once '../utilities/constants.php' ;
  session_start() ;
  session_destroy() ;
  header('Location: ' . base_address . '/index.php') ;
?>
