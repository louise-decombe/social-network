/*----------------------------------------------------*/
/* CONNEXION FORM
------------------------------------------------------ */
console.log('document ok')
// $(document).ready(function(){


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
                    $("#mail_connexion").css("border-color", "#7FFF00");   // si le login existe style vert pour l'input
                    $( "#password_connexion" ).prop( "disabled", false );      // on rend inaccessible l'input password
                    $( "#submit_connexion" ).prop( "disabled", false);         // on rend inaccesible le bouton submit
                }else{
                    $("#mail_connexion").css("border-color", "#D30404");   // si login inexistant style rouge pour l'input
                    $( "#password_connexion" ).prop( "disabled", true );       // on rend accessible l'input password
                    $( "#submit_connexion" ).prop( "disabled", true );        
                }
            }
        });

    });


// });


// $(document).ready(function(){

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


// });

/*----------------------------------------------------*/
/* VISIBILITY PASSWORD
------------------------------------------------------ */

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