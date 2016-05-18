<?php
//Contains functions used by all scripts
function generate_csrf()
{
  return rand(100000000 , 999999999) ;
}
function get_database_connection()
{
  return new mysqli(dbhost , dbuser , dbpass , database) ;
}
?>
