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
            $("#firstname").css("background-color","#D30404" ); 
        }else{
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
            $("#lastname").css("background-color","#D30404" );
        }else{
            $("#lastname").css("background-color","#7FFF00" );
        }

    });

});

//modification input email
$(document).ready(function(){

    //var regexemail=/^[a-zA-Z0-9]+@laplateforme\.io$/;
    $("#mail").change(function(){
        var mail = $(this).val();
        // alert(mail);

        /*if (!(mail).match(regexemail)){
            $("#mail").css("background-color","#D30404" );
        }else{*/
            $.ajax({
                url : "php/form_inscription.php", // on donne l'URL du fichier de traitement
                type : "post", // la requête est de type POST
                data : ({mail:mail}),// et on envoie nos données
                success:function(response){
                    console.log(response);
                    // alert(response);
                    if ((response) == 'exist'){
                        $("#mail").css("border-color", "#D30404");           // si l'email existe dans la bdd style rouge pour l'input
                  
                    }else{
                        $("#mail").css("border-color", "#7FFF00"); // si l'email est valide style vert pour l'input
                    }
                }
            });
           // $("#mail").css("background-color","#7FFF00" );
        //}

    });

});

// modification input password
$(document).ready(function(){

    var regexpassword=/^(?=.*?[A-Z]{1,})(?=.*?[a-z]{1,})(?=.*?[0-9]{1,})(?=.*?[\W]{1,}).{8,20}$/;
    $("#password").change(function(){
 
        var password = $(this).val();
        //alert(password);
        if (!(password).match(regexpassword)){
            $("#password").css("background-color","#D30404" );
        }else{
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
            $("#check_password").css("background-color","#D30404" );
        }else{
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