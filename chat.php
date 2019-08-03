<!DOCTYPE html>

<head>
<link rel="stylesheet" type="text/css" href="chat.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<?php
     session_start();
     if (!isset($_SESSION['auth'])) {
         header("location:index.php");
         die;
     }
     if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['nome'])){
          $_SESSION['name'] = strip_tags(stripslashes($_POST["nome"]));
     }
?>
<script>
     $(function(){

           $(document).on("submit", "#chatForm", function(){
                var msg = $.trim($("#msg").val());
                var usr = $.trim($("#name").val());
                $.post("chatPost.php", { text: msg, name: usr }, function(data){
                     $(".chatMessages").append(data);
                     $('#msg').val("");
               });
          });

          function getMessages(){
               $.get("getMessages.php", function(data){
                    $(".chatMessages").html(data);
               });
          }

          setInterval(function(){
               getMessages();
          },500);
     });
</script>
</head>

<body>
     <div class="chatContainer" align="center">
          <div class="chatHeader">
               <h3>Benvenuto <?php echo($_SESSION['name']);?></h3>
          </div>
          <div class="chatMessages">
               <?php
                    session_start();
                    if (!isset($_SESSION['auth'])) {
                        header("location:index.php");
                        die;
                    }
                    require_once "connection.php";
                    $db = new DB;
                    $query = "SELECT * FROM Logs ORDER BY ID";
                    $res = $db->select($query);
                    foreach ($res as $msg) {
                         echo(sprintf("<font style = 'color: #000000;'><li class='cm' align='left'><font style = 'color: #D9534F;'> %s </font></b> - %s </li></font>", ucwords($msg["Name"]), $msg["Message"]));
                    }
               ?>
          </div>
          <div class="chatBottom">
               <form action="" onsubmit="return false;" id="chatForm">
                    <input type="hidden" id="name" name="name" value="<?php echo($_SESSION['name']);?>">
                    <input type="text" name="msg" id="msg" placeholder="Inserisci il mesaggio">
                    <input type="submit" name="submit" value="Invio">
               </form>
          </div>
     </div>
</body>

</html>
