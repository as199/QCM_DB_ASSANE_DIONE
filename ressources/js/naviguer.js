$(document).ready(function () {
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    $("#menu a").click(function () {
        page = $(this).attr("href");
        $.ajax({
            url: "./" + page,
            cache: false,
            success: function (html) {
                afficher(html);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("textStatus");
            }
        })
        return false;
    });

        // lview user details connected

        $("body").on("click", ".infodetcon", function (e) {
            e.preventDefault();
            infoss_id = $(this).attr('id');
            $.ajax({
                url: "../traitement/action.php",
                type: "POST",
                data: {
                    infoss_id: infoss_id
                },
                success: function (response) {
                   // console.log(response);
                    data =JSON.parse(response);
                    Swal.fire({
                        title: '<strong>User Info : ID(' + data.iduser + ')</strong>',
                        icon: 'info',
                        html: '<b>Prénom :</b>' + data.prenom + '<br><b>Nom :</b>' + data.prenom + '<br><b>E-mail :</b>' + data.email + '<br><b>Type :</b>' + data.type + '<br><b>Login :</b>' + data.login + '<br><b>Password :</b>' + data.password,
                        showCancelButton: true,

                    })
                }
            });
        });
    
}); 
function afficher(data) {
    $('#contenu').slideUp(500,function(){
        $("#contenu").empty();
        $("#contenu").append(data);
        $('#contenu').slideDown(1000);
    })
   
}
