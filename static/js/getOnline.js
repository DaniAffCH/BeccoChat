$(document).ready(function(){
     function getOnline(){
          $.post("inc/getOnline.php", function(data){
               let split = data.split("/");
               for(c = 0; c < split.length-1; c++){
                    element = split[c].split("-")
                    document.getElementById(element[0]).innerHTML = "<font color = 'black'>"+element[1]+"</font>";
                    var tot = $.trim($("#capacity"+element[0]).val());
                    if(element[1] < tot){
                         $("#button"+element[0]).attr("disabled", false);
                    }else{
                         $("#button"+element[0]).attr("disabled", true);
                    }
               }
               //document.getElementById().innerHTML = data;
         });
     }
     setInterval(function(){
          getOnline();
     }, 1000);
});
