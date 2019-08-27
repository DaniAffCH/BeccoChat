$(document).ready(function(){
     function getOnline(){
          $.post("inc/getOnline.php", function(data){
               let split = data.split("/");
               for(c = 0; c < split.length-1; c++){
                    element = split[c].split("-")
                    document.getElementById(element[0]).innerHTML = "<font color = 'black'>"+element[1]+"</font>";
               }
               //document.getElementById().innerHTML = data;
         });
     }
     setInterval(function(){
          getOnline();
     }, 1000);
});
