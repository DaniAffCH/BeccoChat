<!DOCTYPE html>

<head>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" type="text/css" href="static/css/rooms.css">
     <script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script
       src="https://code.jquery.com/jquery-3.4.1.min.js"
       integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
       crossorigin="anonymous"></script>
       <script src="static/js/getOnline.js"></script>
       <?php
          require_once "inc/dailyDelete.php";
          require_once "inc/connection.php";
          require_once "inc/encryptDecrypt.php";
          session_start();
          $db = new DB;
          if (!isset($_SESSION['auth'])) {
              header("location:index.php");
              die;
          }
          elseif ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['nome']) and !isset($_SESSION['name'])){
               $data = [
                    'name' => encrypt($_POST['nome'])
               ];
               $query = "SELECT * FROM User WHERE Name = :name";
               $result = $db->select($query, $data);
               if($result){
                    header("location:home.php?code=error");
                    die();
               }else{
                    $_SESSION['name'] = strip_tags(stripslashes($_POST["nome"]));
                    $data = [
                         'name' => encrypt($_SESSION['name'])
                    ];
                    $query = "INSERT INTO User (Name) VALUES (:name)";
                    $result = $db->select($query, $data);
               }
          }
          elseif(!isset($_POST['nome']) and !isset($_SESSION['name'])){
               header("location:home.php");
               die;
          }
       ?>
</head>

<body>
     <div class="container">
          <div id = "contact">
               <form action="chat.php" method="post">
                    <h3>BeccoChat</h3>
                    <h4>Scegli una stanza</h4>
                    <?php
                         $query = "SELECT * FROM Rooms WHERE 1";
                         $result = $db->select($query);
                         foreach ($result as $room) {
                              $onlineUsers = 0;
                              $data = [
                                   "RoomID" => $room["ID"]
                              ];

                              $query = "SELECT DISTINCT (Name), LastActivity FROM User WHERE RoomID = :RoomID";

                              $result = $db->select($query, $data);

                              foreach ($result as $online) {
                                   $dateTime = new DateTime();
                                   $dateTime->modify('-4 seconds');
                                   if($online["LastActivity"] > $dateTime->format('Y-m-d H:i:s')){
                                        $onlineUsers++;
                                   }
                              }
                              if($room["Capacity"] <= $onlineUsers){
                                   echo(sprintf('<button class = "roombtn" name = "room" id="button%d" value = %d disabled>
                                             %s [<a id = "%d"><font color = "black">%d</font></a>/%d]
                                             <i class="fa fa-arrow-right">
                                             </i>
                                        </button>', $room["ID"], $room["ID"], $room["Name"], $room["ID"], $onlineUsers, $room["Capacity"]));
                                   echo (sprintf('<input type="hidden" id="capacity%d" value="%d">', $room["ID"], $room["Capacity"]));
                              }

                              else{
                                   echo(sprintf('<button class = "roombtn" name = "room" id="button%d" value = %d>
                                             %s [<a id = "%d"><font color = "black">%d</font></a>/%d]
                                             <i class="fa fa-arrow-right">
                                             </i>
                                        </button>', $room["ID"], $room["ID"], $room["Name"], $room["ID"], $onlineUsers, $room["Capacity"]));

                                   echo (sprintf('<input type="hidden" id="capacity%d" value="%d">', $room["ID"], $room["Capacity"]));
                              }
                         }
                     ?>
                     </form>
                <div align='center'>
                     <!--<a href="newroom.php">-->
                          <button class="btn" disabled><i class="fa fa-plus-circle"></i>Coming soon</button>
                     <!--</a>-->
               </div>
           </div>
     </div>
</body>

</html>
