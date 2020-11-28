/*----------------------------------------------------*/
/* MESSAGES ERREUR
------------------------------------------------------ */
const firstname_error = " Le prénom doit :<br>- Comporter entre 3 et 19 caractères.<br>- Commencer et finir par une lettre.<br>- Ne contenir aucun caractère spécial (excepté -).";
const lastname_error = "Le nom doit:<br>- Comporter entre 3 et 50 caractètres.<br>- Commencer et finir par une lettre.<br>- Ne contenir aucun caractère spécial (excepté un espace).";
const mail_error = "L'email n'est pas conforme. </br> Entrer une adresse email se terminant par @laplateforme.io";
const mail_exist = "cette adresse email est déjà enregistrée";
const password_error = "Le mot de passe n'est pas conforme.";
const check_error = "Les mots de passe ne correspondent pas.";


/*----------------------------------------------------*/
/* REGISTER FORM
------------------------------------------------------ */

// modification input prénom
$(document).ready(function(){

    var regexfirstname=/^([a-zA-Z]{3,25})$/;
    $("#firstname").change(function(){
 
        var firstname = $(this).val();
        //alert(firstname);
        if (!(firstname).match(regexfirstname)){
             
            $("#error_firstname").append(firstname_error);
            $("#firstname").css("background-color","#D30404" );

        }else{
            $("#error_firstname").empty();
            $("#firstname").css("background-color","#7FFF00" );
        }

    });

});

// modification input nom
$(document).ready(function(){

    var regexlastname=/^([a-zA-Z]{3,25})$/;
    $("#lastname").change(function(){
 
        var lastname = $(this).val();
        //alert(email);
        if (!(lastname).match(regexlastname)){
            $("#error_lastname").append(lastname_error);
            $("#lastname").css("background-color","#D30404" );
            
        }else{
            $("#lastname").css("background-color","#7FFF00" );
            $("#error_lastname").empty();
        }

    });

});

//modification input email
$(document).ready(function(){

    var regexemail=/^[a-zA-Z0-9]+@laplateforme\.io$/;
    $("#mail").change(function(){
        var mail = $(this).val();
        // alert(mail);

        if (!(mail).match(regexemail)){
            $("#mail").css("background-color","#D30404" );
            $("#error_email1").append(mail_error);
        }else{
            $("#error_email1").empty();
            $.ajax({
                url : "php/form_inscription.php", // on donne l'URL du fichier de traitement
                type : "post", // la requête est de type POST
                data : ({mail:mail}),// et on envoie nos données
                success:function(response_mail){
                    //console.log(response_mail);
                    // alert(response);
                    if ((response_mail) === 'exist'){
                        $("#mail").css("background-color", "#D30404");           // si l'email existe dans la bdd style rouge pour l'input
                        $("#error_email").append(mail_exist);
                  
                    }else{
                        $("#mail").css("background-color", "#7FFF00"); // si l'email est valide style vert pour l'input
                        $("#error_email").empty();
                    }
                }
            });
           // $("#mail").css("background-color","#7FFF00" );
        }

    });

});

// modification input password
$(document).ready(function(){

    var regexpassword=/^(?=.*?[A-Z]{1,})(?=.*?[a-z]{1,})(?=.*?[0-9]{1,})(?=.*?[\W]{1,}).{8,20}$/;
    $("#password").change(function(){
 
        var password = $(this).val();
        //alert(password);
        if (!(password).match(regexpassword)){
            $("#error_password").append(password_error);
            $("#password").css("background-color","#D30404" );
        }else{
            $("#error_password").empty();
            $("#password").css("background-color","#7FFF00" );
        }

    });

});

// confirmation password
$(document).ready(function(){

    $("#check_password").change(function(){
 
        var password = $("#password").val();
        var check_password = $(this).val();
        //alert(password);
        if ( check_password != password){
            $("#error_check").append(check_error);
            $("#check_password").css("background-color","#D30404" );
        }else{
            $("#error_check").empty();
            $("#check_password").css("background-color","#7FFF00" );
        }

    });

});


/*----------------------------------------------------*/
/* VISIBILITY PASSWORD EYE
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

$(document).ready(function(){
    $(function(){
  
        $('#eye1').click(function(){
       
            if($(this).hasClass('fa-eye-slash')){
           
                $(this).removeClass('fa-eye-slash');
          
                $(this).addClass('fa-eye');
          
                $('#check_password').attr('type','text');
            
            }else{
         
                $(this).removeClass('fa-eye');
          
                $(this).addClass('fa-eye-slash');  
          
                $('#check_password').attr('type','password');
            }
        });
    });
})