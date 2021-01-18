/*----------------------------------------------------*/
/* MESSAGES
------------------------------------------------------ */
const password_error = "Le mot de passe n'est pas conforme.";
const check_error = "Les mots de passe ne correspondent pas.";
const modification_ok = "la modification a bien été prise en compte";
const site_error = "veuillez entrer une adresse url valide";


/*----------------------------------------------------*/
/* UPLOAD PROFILE PIC
------------------------------------------------------ */
$(document).ready(function() {

    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //console.log(input.files[0].size)
            reader.onload = function (e) {
                console.log(e)
                $('.profile-pic').attr('src', e.target.result);
            
            }
    
            reader.readAsDataURL(input.files[0]);

        }
    }
    
    

    $(".file-upload").on('change', function(){
        console.log(this.files[0]);
        readURL(this);
        /*var photo = (this.files[0].name);
        var type = (this.files[0].type);
        var size = (this.files[0].size);
        var id_user = $('.id_user').val();*/

        $(".upload-button").remove();
        $(".submit-pic").css("visibility", "visible");
        //$(".upload-button").append();
    
        /*$.ajax({
            url : "php/upload_test.php", // on donne l'URL du fichier de traitement
            type : "POST", // la requête est de type POST
            //enctype:'multipart/form-data',
            //dataType: 'json',
            //data : formdata,
            data : ({id_user: id_user, photo: photo, type:type, size:size}),// et on envoie nos données
            success:function(response){
                console.log(response);
                //alert(response);
                
        }*/
    //});
        
    });
    
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});
/*----------------------------------------------------*/
/* UPLOAD COVER PIC
------------------------------------------------------ */
$(document).ready(function() {

    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //console.log(input.files[0].size)
            reader.onload = function (e) {
                console.log(e)
                $('.cover-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".cover-upload").on('change', function(){
        console.log(this.files[0]);
        readURL(this);

        $(".upload-cover").remove();
        $(".submit-cover").css("visibility", "visible");
        
    });

    $(".upload-cover").on('click', function() {
        $(".cover-upload").click();
    });
    
});


/*----------------------------------------------------*/
/* LOCALITE AUTOCOMPLETION
------------------------------------------------------ */
//console.log('document ok')
$(document).ready(function () {

    $('#modify_city').keyup(function () {

        var nom = $(this).val();
        //alert(nom);

        $.ajax({
            url: "https://geo.api.gouv.fr/communes", // on donne l'URL du fichier de traitement
            type: "get", // la requête est de type POST
            dataType: 'json',
            data: ({ nom: nom }),// et on envoie nos données
            success: function (response) {
                console.log(response);

                $('#result_city ul').empty();

                $.each(response, function (i) {

                    nomCity = response[i].nom;
                    console.log(nomCity);

                    $('#result_city ul').append('<li>' + response[i].nom + '</li>');
                });

                $('#result_city ul li').mouseover(function (event) {

                    console.log($(this))
                    $(this).css("background-color", "yellow");
                    $(this).click(function (event) {
                        console.log(event)
                        //$('#modify_city').val('');
                        $('#modify_city').val(event.target.innerText);
                        $('#result_city ul li').remove();
                    });

                });

            }


        });

    });

});

/*----------------------------------------------------*/
/* LOCALITE UPDATE
------------------------------------------------------ */

$(document).ready(function(){

    $('#user_localite').submit(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
            
        var id_user = $(this).find("input[name=id_user]").val();
        var new_localite = $(this).find("input[name=modify_city]").val();
        //alert(id_user);
                    
            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, new_localite: new_localite}),// et on envoie nos données
                success:function(response){
                    console.log(response);
                    //alert(response);

                    $('#user_city').empty();
                    $('#user_city').append(new_localite);
                    $('#message_city').append(modification_ok);
                    
                }
            });
    });
});

/*----------------------------------------------------*/
/* CURSUS UPDATE
------------------------------------------------------ */

$(document).ready(function(){

    $('#user_cursus').submit(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
            
        var id_user = $(this).find("input[name=id_user]").val();
        var new_cursus = $('#modify_cursus').val();
        //alert(new_cursus);
                    
            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, new_cursus: new_cursus}),// et on envoie nos données
                success:function(response){
                    console.log(response);
                    //alert(response);
                    if(response == 'cursus'){
                     
                    }
                    
                }
            });
    });
});

/*----------------------------------------------------*/
/* ENTREPRISE UPDATE
------------------------------------------------------ */

$(document).ready(function(){

    $('#user_entreprise').submit(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
            
        var id_user = $(this).find("input[name=id_user]").val();
        var new_entreprise = $('#modify_entreprise').val();
        //alert(new_entreprise);
                    
            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, new_entreprise: new_entreprise}),// et on envoie nos données
                success:function(response){
                    console.log(response);
                    //alert(response);
                    
                }
            });
    });
});

/*----------------------------------------------------*/
/* WEBSITE UPDATE
------------------------------------------------------ */

$(document).ready(function(){

    $('#user_website').submit(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
          
        var urlregex = /^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)$/;
        var id_user = $(this).find("input[name=id_user]").val();
        var new_website = $('#modify_website').val();;
        //alert(new_website);

        if (!(new_website).match(urlregex)){
                    
            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, new_website: new_website}),// et on envoie nos données
                success:function(response){
                    console.log(response);
                    //alert(response);

                    $('#user_site').empty();
                    $('#user_site').append(new_localite);
                    $('#message_site').append(modification_ok);
                }
            });
        }else{
            $('#message_site').append(site_error);
        };   
    });
});

/*----------------------------------------------------*/
/* BIO UPDATE
------------------------------------------------------ */

$(document).ready(function(){

    $('#user_bio').submit(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
            
        var id_user = $(this).find("input[name=id_user]").val();
        var new_bio = $('#modify_bio').val();;
        //alert(new_bio);
                    
            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, new_bio: new_bio}),// et on envoie nos données
                success:function(response){
                    console.log(response);
                    //alert(response);
                    
                }
            });
    });
});

/*----------------------------------------------------*/
/* HOBBIES UPDATE
------------------------------------------------------ */

$(document).ready(function(){

    $('#user_hobbies').submit(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
            
        var id_user = $(this).find("input[name=id_user]").val();
        var new_hobbies = $('#modify_hobbies').val();
        //alert(new_hobbies);
                    
            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, new_hobbies: new_hobbies}),// et on envoie nos données
                success:function(response){
                    console.log(response);
                    //alert(response);
                    
                }
            });
    });
});
/*----------------------------------------------------*/
/* FIRSTNAME UPDATE
------------------------------------------------------ */

/*$(document).ready(function(){

    $('#user_firstname').submit(function(e){
        //e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
            
        //var id_user = $(this).find("input[name=id_user]").val();
        var new_firstname = $('#modify_firstname').val();
        alert(new_firstname);
                    
            /*$.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, new_firstname: new_firstname}),// et on envoie nos données
                success:function(response){
                    console.log(response);
                    //alert(response);
                    
                }
            });
    });
});

/*----------------------------------------------------*/
/* LASTNAME UPDATE
------------------------------------------------------ */

/*$(document).ready(function(){

    $('#user_lastname').submit(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
            
        var id_user = $(this).find("input[name=id_user]").val();
        var new_lastname = $('#modify_lastname').val();
        //alert(new_lastname);
                    
            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, new_lastname: new_lastname}),// et on envoie nos données
                success:function(response){
                    console.log(response);
                    //alert(response);
                    
                }
            });
    });
});*/

/*----------------------------------------------------*/
/* BIRTHDAY UPDATE
------------------------------------------------------ */

$(document).ready(function(){

    $('#user_birthday').submit(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
            
        var id_user = $(this).find("input[name=id_user]").val();
        var new_birthday = $('#modify_birthday').val();

        //alert(new_birthday);
                    
            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, new_birthday: new_birthday}),// et on envoie nos données
                success:function(response){
                    console.log(response);
                    //alert(response);
                    $('#user_birth').empty();
                    $('#user_birth').append(new_birthday);
                    $('#message_birthday').append(modification_ok);
                }
            });
    });
});

/*----------------------------------------------------*/
/* PASSWORD UPDATE
------------------------------------------------------ */

$(document).ready(function(){

    $('#user_password').submit(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire

           
        var id_user = $(this).find("input[name=id_user]").val();
        var new_password = $('#modify_password').val();
        var new_check_password = $('#modify_confirmation_password').val();
        var regexpassword=/^(?=.*?[A-Z]{1,})(?=.*?[a-z]{1,})(?=.*?[0-9]{1,})(?=.*?[\W]{1,}).{8,20}$/; 
        //alert(new_password);

        if (!(new_password).match(regexpassword)){
            $("#error_newPassword").append(password_error);
            $('#modify_password').css("background-color","#D30404" );
        }
        else if(new_password != new_check_password){
            $('#error_newPassword').append(check_error);
            $('#modify_password').css("background-color","#D30404" );
            $('#modify_confirmation_password').css("background-color","#D30404" );
        }
        else{

            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, new_password: new_password, new_check_password: new_check_password}),// et on envoie nos données
                success:function(response){
                    console.log(response);
                    //alert(response);
                    
                }
            });

            $("#error_newPassword").empty();

        }
                    
           
    });
});

/*----------------------------------------------------*/
/* FOLLOW
------------------------------------------------------ */

$(document).ready(function(){

    $('#button_follow').click(function(e){
        e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
         
        var id_user = $('#id_user').val();
        var id_user_follow = $('#id_user_follow').val();
        //alert(id_user_follow);
                    
            $.ajax({
                url : "php/form_profile.php", // on donne l'URL du fichier de traitement
                type : "POST", // la requête est de type POST
                data : ({id_user: id_user, id_user_follow: id_user_follow}),// et on envoie nos données
                success:function(response){
                    console.log(response);
                    //alert(response);
                    $('#button_follow').empty();
                    $('#button_follow').append('suivi')
                    
                }
            });
    });
});






