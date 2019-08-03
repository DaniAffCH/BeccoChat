$(function(){

      $(document).on("submit", "#chatForm", function(){
           var msg = $.trim($("#msg").val());
           var usr = $.trim($("#name").val());
           $.post("inc/chatPost.php", { text: msg, name: usr }, function(data){
                $(".chatMessages").append(data);
                $('#msg').val("");
                $(".chatMessages").stop().animate({ scrollTop: $(".chatMessages")[0].scrollHeight}, 1000);
          });
     });

     function getMessages(){
          $.get("inc/getMessages.php", function(data){
               $(".chatMessages").html(data);
          });
     }

     setInterval(function(){
          getMessages();
     },500);
});
