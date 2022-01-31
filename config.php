<?php 
     try 
     {
         $bdd = new PDO("mysql:host=localhost;dbname=app;charset=utf8","root","1234");
     }
     catch(PDOException $e)
     {
         die('Erreur : '.$e->getMessage());
     }
