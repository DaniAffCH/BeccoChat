$(document).ready(function(){

     function update_user_activity(){
          var action = 'update_time';
          $.post("inc/update_time.php", {action: action}, function(data){
               //DEBUG -> alert(data);
         });
     }

     setInterval(function(){
          update_user_activity();
     }, 3000);

});
