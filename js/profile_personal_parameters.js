/*----------------------------------------------------*/
/* MESSAGES
------------------------------------------------------ */
const password_error = "Le mot de passe n'est pas conforme.";
const check_error = "Les mots de passe ne correspondent pas.";

/*----------------------------------------------------*/
/* FIRSTNAME UPDATE
------------------------------------------------------ */

$(document).ready(function () {
    $('#form_firstname').submit(function (e) {
    
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire

        var id_user = $(".id_user").val();
        var new_firstname = $('#modify_firstname').val();

        if(new_firstname == ''){

            $('#message_firstname').append(error_input);

        }else{

            $('#message_firstname').empty();

            $.ajax({
                url: "php/form_profile.php", // on donne l'URL du fichier de traitement
                type: "POST", // la requête est de type POST
                data: ({ id_user: id_user, new_firstname: new_firstname }),// et on envoie nos données
                success: function (response) {
                console.log(response);
                response = response.replace(/\s/g, ''); 

                if(response == 'firstname'){

                    $('#profile_firstname').empty();
                    $('#profile_firstname').append('&nbsp;' + new_firstname);
                    $('#message_firstname').append(modification_ok);

                    }else{

                    $('#message_firstname').append(modification_ko);

                    }
                }
            });
        }
    });
});

/*----------------------------------------------------*/
/* LASTNAME UPDATE
------------------------------------------------------ */

$(document).ready(function () {

    $('#form_lastname').submit(function (e) {
        //console.log('ye');
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire

        var id_user = $(".id_user").val();
        var new_lastname = $('#modify_lastname').val();
        //alert(id_user);

        if(new_lastname == ''){

            $('#message_lastname').append(error_input);

        }else{

            $('#message_lastname').empty();

            $.ajax({
                url: "php/form_profile.php", // on donne l'URL du fichier de traitement
                type: "POST", // la requête est de type POST
                data: ({ id_user: id_user, new_lastname: new_lastname }),// et on envoie nos données
                success: function (response) {
                console.log(response);
                //alert(response);
                response = response.replace(/\s/g, ''); 
                if(response == 'lastname'){

                    $('#profile_lastname').empty();
                    $('#profile_lastname').append('&nbsp;' + new_lastname);
                    $('#message_lastname').append(modification_ok);

                    }else{

                    $('#message_lastname').append(modification_ko);

                };
            }

            });
        };
    });
});



/*----------------------------------------------------*/
/* PASSWORD UPDATE
------------------------------------------------------ */

$(document).ready(function () {

    $('#form_password').submit(function (e) {
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire


        var id_user = $(".id_user").val();
        var new_password = $('#modify_password').val();
        var new_check_password = $('#modify_confirmation_password').val();
        var regexpassword = /^(?=.*?[A-Z]{1,})(?=.*?[a-z]{1,})(?=.*?[0-9]{1,})(?=.*?[\W]{1,}).{8,20}$/;
        //alert(new_check_password);

        if (!(new_password).match(regexpassword)) {
            $("#message_password").append(password_error);
            $('#modify_password').css("background-color", "#D30404");
        }
        else if (new_password != new_check_password) {
            $("#message_password").empty();
            $('#message_password').append(check_error);
            $('#modify_password').css("background-color", "#D30404");
            $('#modify_confirmation_password').css("background-color", "#D30404");
        }
        else if ((new_password == new_check_password) && (new_password).match(regexpassword))  {

            $("#message_password").empty();
            $('#modify_password').css("background-color", "#7FFF00");
            $('#modify_confirmation_password').css("background-color", "#7FFF00");

            $.ajax({
                url: "php/form_profile.php", // on donne l'URL du fichier de traitement
                type: "POST", // la requête est de type POST
                data: ({ id_user: id_user, new_password: new_password, new_check_password: new_check_password }),// et on envoie nos données
                success: function (response) {
                    //console.log(response);
                    response = response.replace(/\s/g, ''); 
                    //alert(response);
                    if(response == 'password'){

                        $('#message_password').empty();
                        $('#message_password').append(modification_ok);
    
                        }else{
    
                        $('#message_password').append(modification_ko);
    
                    };

                }
            });

            //$("#message_password").empty();

        }


    });
});








