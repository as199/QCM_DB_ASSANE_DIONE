<?php
//session_start();
// if(!isset($_SESSION['login'])){
//     header("Location:index.php");
// }
// if (isset($_GET['logout']) == "yes") {
//     session_destroy();
//     header("Location:index.php");
// }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>QCM</title>
    <link href="./ressources/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <div class="cadre">
                                        <div class="cadre1">

                                        </div>
                                        <div class="cadre2">
                                            <p class=" font-weight-light my-4">LE PLAISIR DE JOUER</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-header">
                                    <p class="p1">Se connecter à la plate-forme</p>
                                </div>
                                <div class="card-body">
                                    <label class="form-check-label">
                                        <span class="text-danger align-middle" id="errorMsg"></span>
                                    </label>
                                    <form method="post" action="" id="login_form">
                                        <div class="form-group"><label class="small mb-1" for="user">Login</label>
                                            <input type="text" name="username" class="form-control py-4" id="username" placeholder="Username" autocomplete="off" autocomplete="false" required>
                                        </div>
                                        <div class="form-group"><label class="small mb-1" for="Password">Password</label><input type="password" name="password" class="form-control py-4" id="password" placeholder="Password" autocomplete="false" required></div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox"><input class="custom-control-input" id="rememberme" name="remember" type="checkbox" /><label class="custom-control-label" for="rememberme">Remember password</label></div>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><a class="small" href="./vue/password.php">Forgot Password?</a> <input type="submit" class="btn btn-primary" name="login" id="sconnecter"></div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="./vue/register.php">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Dione Le Pro 2019</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- <script src="js/scripts.js"></script> -->
    <script src="./ressources/jquery/jquery.min.js"></script>
    <script src="./ressources/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./ressources/DataTables/datatables.min.js"></script>
    <script src="./ressources/sweetalert2-9.13.4/package/dist/sweetalert2.min.js"></script>
    <script src="./ressources/fontawesome-free-5.13.0-web/js/all.js"></script>

    <!-- Validation form -->
    <script>
        $(document).ready(function() {
            $("#login_form").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: './traitement/action.php',
                    type: 'POST',
                    data: {
                        username: $("#username").val(),
                        password: $("#password").val(),
                        remember: $("rememberme").val()
                    },
                    success: function(response) {
                        data = JSON.parse(response);
                        if (data.error == 'error') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Invalid username and password!',
                                footer: '<a href>Why do I have this issue?</a>'
                            })
                            //$("#errorMsg").html("Invalid username and password!");
                            //alert('saluy');
                            //location.reload();
                        } else if (data.error == 'admin') {
                            //location.href = './vue/accueil.php';

                            let timerInterval
                            Swal.fire({
                                title: 'successful connection redirection!',
                                html: 'you will be redirected in <b></b> milliseconds.',
                                timer: 2000,
                                timerProgressBar: true,
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                    timerInterval = setInterval(() => {
                                        const content = Swal.getContent()
                                        if (content) {
                                            const b = content.querySelector('b')
                                            if (b) {
                                                b.textContent = Swal.getTimerLeft()
                                            }
                                        }
                                    }, 100)
                                },
                                onClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    console.log('I was closed by the timer');
                                    //
                                    window.location.href = './vue/accueil.php';
                                }
                            })


                        } else {
                            window.location.href = './vue/configuration.php';
                            let timerInterval
                            Swal.fire({
                                title: 'successful connection redirection!',
                                html: 'you will be redirected in <b></b> milliseconds.',
                                timer: 2000,
                                timerProgressBar: true,
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                    timerInterval = setInterval(() => {
                                        const content = Swal.getContent()
                                        if (content) {
                                            const b = content.querySelector('b')
                                            if (b) {
                                                b.textContent = Swal.getTimerLeft()
                                            }
                                        }
                                    }, 100)
                                },
                                onClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    console.log('I was closed by the timer');
                                    //
                                    window.location.href = './vue/configuration.php';
                                }
                            })
                        }
                    }
                });
            });
        });







        // $(document).ready(function(){

        //     $("#sconnecter").click(function(e){
        //         e.preventDefault();
        //         var site ='./index.php',
        //         $.post(
        //             './traitement/action.php', // Un script PHP que l'on va créer juste après
        //             {
        //                 username : $("#username").val(),  // Nous récupérons la valeur de nos input que l'on fait passer à connexion.php
        //                 password : $("#password").val()
        //             },

        //             function(data){

        //                 if(data.erreur !='failed'){
        //                      // Le membre est connecté. Ajoutons lui un message dans la page HTML.
        //                        $("#errorMsg").html("<p>Erreur lors de la connexion...</p>");
        //                       window.location.href = data;
        //                  }
        //                 // else{
        //                 //      // Le membre n'a pas été connecté. (data vaut ici "failed")



        //                 //      $("#errorMsg").html("<p>Erreur lors de la connexion... !</p>");
        //                 //      window.location.href =site;
        //                 // }

        //             },
        //             'text'
        //          );
        //     });
        // });
    </script>


</body>

</html>
