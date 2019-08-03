<!DOCTYPE html>

<head>
<link rel="stylesheet" type="text/css" href="form.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
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
          </form>
     </div>
</body>

</html>
