<!DOCTYPE html>

<head>

<script
src="https://code.jquery.com/jquery-3.4.1.slim.js"
integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI="
crossorigin="anonymous"></script>

<?php
     require_once "inc/dailyDelete.php";
     require_once "inc/connection.php";
     $db = new DB;
     session_start();
     if($_SESSION['auth']){
          header("location:home.php");
     }
     $getValue = trim(
          strtolower(
          strip_tags(
          stripslashes($_GET["key"]))));

     if($getValue){
          $data = [
               'value' => hash("sha256",$getValue)
          ];
          $query = "SELECT * FROM `EnterKey` WHERE chiave = :value";
          $logged = ($db->select($query, $data)) ? true : false;
          if(!$logged){
               header("location:index.php");
          }else{
               $_SESSION['auth'] = true;
               header("location:home.php");
          }
     }
?>

</head>

<body>
<script>

function getUrlVars() {
     var vars = {};
     var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
     vars[key] = value;
     });
     return vars;
}

getValue = getUrlVars()["key"]
if(!getValue || getValue === null){
     do{
          key = prompt("Inserisci la chiave di ingresso");
     }while(key === "" || key === null)
     window.location.href="index.php?key="+key;
}

</script>
</body>
</html>
