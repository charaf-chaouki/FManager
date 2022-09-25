<?php
   require_once('config.php');
   require_once('autoload.php');

   if(!isset($_SESSION))
   {
       session_start();
   }

   //Verify if the user is connected
   if(!isset($_SESSION['fm_logged']))
   {
        header('location: login.php');
   }
