<!DOCTYPE html>

<head>
<link rel="stylesheet" type="text/css" href="static/css/form.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
     require_once "inc/dailyDelete.php";
     session_start();
     if (!isset($_SESSION['auth'])) {
         header("location:index.php");
         die;
     }
?>
</head>

<body>
     <div class="container">
          <form id="contact" action="chat.php" method="post">
               <h3>BeccoChat</h3>
               <h4>Scegli un username</h4>
               <fieldset>
                    <input name = "nome" placeholder="Username" type="text" tabindex="1" required autofocus>
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
