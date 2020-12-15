/*----------------------------------------------------*/
/* NEWSLETTER FORM
------------------------------------------------------ */

$(document).ready(function(){


    $("#email_newsletter").change(function(){
 
        var email_newsletter = $(this).val();
        //alert(mail);
        $.ajax({
            url : "php/form_newsletter.php", // on donne l'URL du fichier de traitement
            type : "post", // la requête est de type POST
            data : ({email_newsletter: email_newsletter}),// et on envoie nos données
            success:function(response_news){
                //console.log(response);
                //alert(response);
                if ((response_news) == 'email_exist'){
                    $("#email_newsletter").css("background-color", "#7FFF00");   // si le login existe style rouge pour l'input
                    $( "#submit_newsletter" ).prop("disabled", false);           // on rend inaccesible le bouton submit 
                    //$('.error-message').append('<p>cet email est déjà enregistré</p>')         
                }else{
                    $("#email_newsletter").css("background-color", "#D30404");   // si login inexistant style vert pour l'input 
                    $("#submit_newsletter").prop("disabled", true );       
                }
            }
        });

    });


});



