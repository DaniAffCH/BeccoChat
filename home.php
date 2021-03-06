<!DOCTYPE html>

<head>
<link rel="stylesheet" type="text/css" href="static/css/form.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BeccoChat</title>
<meta name="description" content="Una chat completamente anonima e criptata senza registrazione!">
<meta name="keywords" content="chat,anonimo,anonimato,messaggi,
Becco,Becchime,BeccoChat,criptato">
<?php
     require_once "inc/dailyDelete.php";
     session_start();
     $_SESSION['auth'] = true;
     if (!isset($_SESSION['auth'])) {
         header("location:index.php");
         die;
     }
     if($_SERVER['REQUEST_METHOD'] === 'GET' and $_GET['code'] == 'error'){
          echo("<script>alert('Il nome è gia utilizzato e non potrà essere utilizzato nuovamente fino a domani!')</script>");
     }
     if(isset($_SESSION['name'])){
          header("location:rooms.php");
     }
?>
</head>

<body>
     <div class="container">
          <form id="contact" action="rooms.php" method="post">
               <h3>BeccoChat</h3>
               <h4>Scegli un username</h4>
               <fieldset>
                    <input name = "nome" placeholder="Username" type="text" tabindex="1" autocomplete="off" required autofocus>
               </fieldset>
               <fieldset>
                    <button name="submit" type="submit" id="contact-submit" data-submit="...Inviando...">Invio</button>
               </fieldset>
               <p class="copyright">Developed by <a href="https://github.com/DaniAffCH" target="_blank" title="DaniAffCH">DaniAffCH</a></p>
          </form>
     </div>
     <p style="color: #00529b;
	background-color: #bde5f8;
     border: 1px solid;
     max-width: 400px;
     width: 100%;
	padding:1px 5px;
     margin: 0 auto;">Questa chat offre il completo anonimato. Tutti i messaggi utilizzano una crittografia AES, inoltre vengono cancellati automaticamente ogni giorno (per una maggiore sicurezza cancellare i propri messaggi al termine di ogni conversazione)</p>
</body>

</html>
