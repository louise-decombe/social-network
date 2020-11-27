// $(document).ready(function(){

$(".link-navbar").click(function(event){

    event.preventDefault();

    let href = $(this).attr("href");

    // window.history.pushState(null, null, href);

    $(".link-navbar").removeClass("link-active");
    $(this).addClass("link-active");

    $.ajax({
        url: href,
        success: function(data){
            $(".container-fluid").fadeOut(350, function(){
                let form_content = $(data).find(".form")
                //console.log(form_content);
                $(".container-fluid").html(form_content);
                //console.log(test);
                $(".container-fluid").fadeIn(350);
            })
        }

    });

});

// });