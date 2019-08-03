<!DOCTYPE html>

<head>

<script
src="https://code.jquery.com/jquery-3.4.1.slim.js"
integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI="
crossorigin="anonymous"></script>

<?php
     require_once "inc/connection.php";
     $db = new DB;
     $getValue = trim(
          strtolower(
          strip_tags(
          stripslashes($_GET["key"]))));
     if($getValue){
          $data = [
               'value' => $getValue
          ];
          $query = "SELECT * FROM `EnterKey` WHERE chiave = :value";
          $logged = ($db->select($query, $data)) ? true : false;
          if(!$logged){
               echo("<script> alert('Chiave errata!'); </script>");
               header("location:index.php");
          }else{
               session_start();
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
