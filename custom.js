$(document).on('click','#showData',function(e){
      $.ajax({    
        type: "GET",
        url: "smth.php",             
        dataType: "html",                  
        success: function(data){                    
            $("#graph").html(data); 
           
        }
    });
});

