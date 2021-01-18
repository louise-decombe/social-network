/*----------------------------------------------------*/
/* MESSAGES ERREUR
------------------------------------------------------ */
const mail = "L'email est invalide";
const mailNews = "Votre email a bien été enregistré";
const mailExist = "cet email est déjà enregistré";

/*----------------------------------------------------*/
/* NEWSLETTER FORM
------------------------------------------------------ */

$(document).ready(function(){

    

    $("#email_newsletter").change(function(event){

        event.preventDefault(); 

        $("#message-newsletter").empty(); 
        $("#email_newsletter").css("border", "1px solid gray");
 
        var email_newsletter = $(this).val();
        //alert(email_newsletter);
        var regexEmail=/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/;

        if (!(email_newsletter).match(regexEmail)){
            $("#message-newsletter").append(mail);
            $("#email_newsletter").css("border", "1px solid #D30404");

        }else{
            $.ajax({
                url : "php/form_newsletter.php", // on donne l'URL du fichier de traitement
                type : "post", // la requête est de type POST
                data : ({email_newsletter: email_newsletter}),// et on envoie nos données
                success:function(response){
                //console.log(response);
                response = response.replace(/\s/g, ''); //enleve les espaces
                console.log (`${response.length}`);
                //alert(response);
                if ((response) === 'news'){
                    
                    $("#message-newsletter").empty();
                    $("#message-newsletter").append(mailNews);
                    $("#email_newsletter").css("border", "1px solid #7FFF00"); 
                    $("#submit_newsletter").prop("disabled", false ); 
                     
                }else{ 
                    $("#email_newsletter").val(''); 
                    $("#message-newsletter").append(mailExist); 
                    $("#email_newsletter").css("border", "1px solid #D30404");   // si le login existe style rouge pour l'input
                    $("#submit_newsletter" ).prop("disabled", true);           // on rend inaccesible le bouton submit       
                    }
                }
            });
        }

    });


});


