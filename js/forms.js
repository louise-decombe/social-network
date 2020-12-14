/*----------------------------------------------------*/
/* CONNEXION FORM
------------------------------------------------------ */

$(document).ready(function(){

    /*$("#mail_connexion").on('input',function(){
        //e.preventDefault();
        var mail = $(this).val();
        alert(mail);
        $.ajax({
            url : "php/form_connexion.php", // on donne l'URL du fichier de traitement
            type : "GET", // la requête est de type POST
            data : ({mail: mail}),// et on envoie nos données
            success:function(response){
                console.log(response);
                //alert(response);
                
            }
        });

    });*/

    $("#mail_connexion").change(function(){
 
        var mail = $(this).val();
        //alert(mail);
        $.ajax({
            url : "php/form_connect.php", // on donne l'URL du fichier de traitement
            type : "post", // la requête est de type POST
            data : ({mail: mail}),// et on envoie nos données
            success:function(response){
                //console.log(response);
                //alert(response);
                if ((response) == 'exist'){
                    $("#mail_connexion").css("background-color", "#7FFF00"); 
                    $( "#password_connexion" ).prop( "disabled", false );
                    $( "#submit_connexion" ).prop( "disabled", false );
                }else{
                    $("#mail_connexion").css("background-color", "#D30404"); 
                    $( "#password_connexion" ).prop( "disabled", true );
                    $( "#submit_connexion" ).prop( "disabled", true );
                }
            }
        });

    });


});


$(document).ready(function(){

    $("#password").change(function(){
        var mail = $('#mail_connexion').val();
        var password = $(this).val();
        //alert(password);
        $.ajax({
            url : "php/form_connect.php", // on donne l'URL du fichier de traitement
            type : "post", // la requête est de type POST
            data : ({mail:mail, password: password}),// et on envoie nos données
            success:function(response){
                //console.log(response);
                alert(response);
                if ((response) == 'exist password_correct'){
                    $("#password_connexion").css("background-color", "#7FFF00"); 
                    $( "#submit_connexion" ).prop( "disabled", false );
                }else{
                    $("#password_connexion").css("background-color", "#D30404"); 
                    $( "#submit_connexion" ).prop( "disabled", true );
                }
            }
        });

    });


});

$(document).ready(function(){
    $(function(){
  
  $('#eye').click(function(){
       
        if($(this).hasClass('fa-eye-slash')){
           
          $(this).removeClass('fa-eye-slash');
          
          $(this).addClass('fa-eye');
          
          $('#password').attr('type','text');
            
        }else{
         
          $(this).removeClass('fa-eye');
          
          $(this).addClass('fa-eye-slash');  
          
          $('#password').attr('type','password');
        }
    });
});
})