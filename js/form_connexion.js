/*----------------------------------------------------*/
/* MESSAGES ERREUR
------------------------------------------------------ */
const mail_error_exist = "cette adresse email n'est pas enregistrée";
const mail_error = "L'email n'est pas conforme.</br>";
const password_error_connect = "Le mot de passe est invalide.";

/*----------------------------------------------------*/
/* CONNEXION FORM*/

//console.log('document ok')
$(document).ready(function(){
    
    $("#mail_connexion").change(function(){
        $("#error_email1").empty();
        var regexemail=/^[a-zA-Z0-9]+@laplateforme\.io$/;
        var mail = $(this).val();
        //alert(mail);
        if (!(mail).match(regexemail)){
            $("#mail").css("background-color","#D1F1BE" );
            $("#error_email1").append(mail_error);
        }else{
            $.ajax({
            url : "php/form_check.php", // on donne l'URL du fichier de traitement
            type : "post", // la requête est de type POST
            data : ({mail: mail}),// et on envoie nos données
            success:function(response){
                //console.log(response);
                //alert(response);
                if ((response) == 'exist'){
                    $("#error_email1").empty();
                    $("#mail_connexion").css("background-color", "#D1F1BE");  // si le login existe style vert pour l'input
                    $( "#password_connexion" ).prop( "disabled", false );    // on rend accessible l'input password
                    $( "#submit_connexion" ).prop( "disabled", false);      // on rend accesible le bouton submit
                }else{
                    $("#error_email1").append(mail_error);
                    $("#mail_connexion").css("background-color", "#F1BFBE");   // si login existant style rouge pour l'input
                    $( "#password_connexion" ).prop( "disabled", true );   // on rend inaccessible l'input password
                    $( "#submit_connexion" ).prop( "disabled", true );        
                }
            }
            });
        };
    });
});
//------------------------------------------------------ */

$(document).ready(function(){

    $("#password_connexion").change(function(){
        $("#error_password").empty();
        var mail = $('#mail_connexion').val();
        var password = $(this).val();
        //alert(password);
        $.ajax({
            url : "php/form_check.php", // on donne l'URL du fichier de traitement
            type : "post", // la requête est de type POST
            data : ({mail:mail, password:password}),// et on envoie nos données
            success:function(response){
                //console.log(response);
                alert(response);
                if ((response) == 'exist password_correct'){
                    $("#error_password").empty();
                    $("#password_connexion").css("background-color", "#D1F1BE"); 
                    $( "#submit_connexion" ).prop( "disabled", false );
                }else{
                    $("#error_password").append(password_error_connect );
                    $("#password_connexion").css("background-color", "#F1BFBE"); 
                    $( "#submit_connexion" ).prop( "disabled", true );
                }
            }
        });

    });

 });

 $(document).ready(function(){

    $("#submit_connexion").click(function(){
 
        var mail = $('#mail_connexion').val();
        var password = $('#password_connexion').val();
        //alert(password);
    
        $.ajax({
            url : "php/form_connect.php", // on donne l'URL du fichier de traitement
            type : "post", // la requête est de type POST
            data : ({mail:mail, password:password}),// et on envoie nos données
            success:function(response){
                console.log("response");
                alert(response);
                response = response.replace(/\s/g, ''); //enleve les espaces
                // console.log (`${response.length}`);
                
                if (response == "success"){

                    window.location.href = 'profile.php'; 
                    
                }
                else{
                    alert('error');
                }
            }
        });

    });

 });

/*----------------------------------------------------*/
/* VISIBILITY PASSWORD
------------------------------------------------------ */

$(document).ready(function(){
    $(function(){
  
        $('#eye').click(function(){
       
            if($(this).hasClass('fa-eye-slash')){
           
                $(this).removeClass('fa-eye-slash');
          
                $(this).addClass('fa-eye');
          
                $('#password_connexion').attr('type','text');
            
            }else{
         
                $(this).removeClass('fa-eye');
          
                $(this).addClass('fa-eye-slash');  
          
                $('#password_connexion').attr('type','password');
            }
        });
    });
})