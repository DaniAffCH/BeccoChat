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
     <script>
          $('.round').click(function(e) {
               e.preventDefault();
               e.stopPropagation();
               $('.arrow').toggleClass('bounceAlpha');
          });
     </script>
</head>

<body>
     <div class="container">
          <form id="contact" action="chat.php" method="post">
               <h3>BeccoChat</h3>
               <h4>Scegli una stanza</h4>
                    <button>
                         Public Room #1 [0/10]
                         <i class="fa fa-arrow-right">
                         </i>
                    </button>

                    <button>
                         Public Room #2 [0/10]
                         <i class="fa fa-arrow-right">
                         </i>
                    </button>

                    <button>
                         Public Room #3 [0/10]
                         <i class="fa fa-arrow-right">
                         </i>
                    </button>


          </form>
     </div>
</body>

</html>
