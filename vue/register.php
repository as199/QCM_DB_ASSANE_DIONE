<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SamaJeux</title>
    <link href="../ressources/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card shadow-lg border-0 rounded-lg mt-5a ">
                                <div class="card-header">
                                    <div class="cadre">
                                        <div class="cadre1">

                                        </div>
                                        <div class="cadre2">
                                            <p class=" font-weight-light my-4">LE PLAISIR DE JOUER</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <form method="POST" action="" id="inscrireuser" class="col-md-12 ">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="col-md-12">
                                                    <label for="prenom">First name</label>
                                                    <input type="text" class="form-control " id="prenom" placeholder="First name" name="prenom" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="nom">Last name</label>
                                                    <input type="text" class="form-control " id="nom" placeholder="Last name" name="nom" value="" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="email">E-mail</label>
                                                    <input type="text" class="form-control " id="email" placeholder="E-mail" name="email" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="login">Login</label>
                                                    <input type="text" class="form-control " id="login" placeholder="Login" name="login" required>
                                                    <input type="hidden" name="type" value="joueur">
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control " id="password" placeholder="Password" name="password" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="cpassword">Confirm Password</label>
                                                    <input type="password" class="form-control " name="cpassword" id="cpassword" placeholder="Confirm Password" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="col-md-12">
                                                    <input class="btn btn-info small col-12 mt-2" type="file" name="photo" id="photo" onchange="handleFiles(files)">
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="" id="moncerclediv2c5">
                                                        <span class="mx-auto" id="preview">

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row" style="margin-top: 10px;">
                                            <div class="col-md-6 pb-2">
                                                <input class="col-md-12 btn btn-success h-100" type="submit" name="valider" value="s'inscrire" onclick="resend()">
                                            </div>
                                            <div class="col-md-6">
                                                <a class="mx-auto" href="../index.php">Have an account? Go to login</a></div>
                                        </div>
                                </div>


                                </form>
                            </div>

                        </div>
                    </div>
                </div>
        </div>
        </main>
    </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- Bootstrap core JavaScript and others Local Links -->
    <script src="../ressources/jquery/jquery.min.js"></script>
    <script src="../ressources/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../ressources/DataTables/datatables.min.js"></script>
    <script src="../ressources/sweetalert2-9.13.4/package/dist/sweetalert2.min.js"></script>
    <script src="../ressources/fontawesome-free-5.13.0-web/js/all.js"></script>

    <script src="../ressources/js/user.js"></script>

    <script type="text/javascript">
        function resend() {
            event.preventDefault();
            var error = '';
            if ((document.getElementById("nom").value != "") && (document.getElementById("photo").value != "") && (document.getElementById("prenom").value != "") && (document.getElementById("email").value != "") && (document.getElementById("login").value != "") && (document.getElementById("password").value != "") && (document.getElementById("cpassword").value != "")) {

                if ((document.getElementById("cpassword").value) == (document.getElementById("password").value)) {

                    var form = $('#inscrireuser')[0];
                    var data = new FormData(form);
                    //data.append("text", document.getElementById("prenom").value);
                    $.ajax({
                        url: '../traitement/action1.php',
                        type: 'POST',
                        enctype: 'multipart/form-data',
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function(response) {

                            data = JSON.parse(response);
                            console.log(data);
                            if (data.error == "erreur") {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'insertion failed!'

                                })
                            } else if (data.error == "vrai") {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'this login already exists!'

                                })
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Good...',
                                    text: 'User added successfully!'

                                })

                                $("#inscrireuser")[0].reset();
                                window.location.href = "../index.php";
                            }


                        }
                    });
                } else {
                    error = 2;
                }

            } else {
                error = 1;
            }
            if (error == 2) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'the two passwords do not match!'

                })
            } else if (error == 1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'please fill in all fields!'

                })
            }

        }
    </script>
</body>

</html>
