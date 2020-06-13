<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Page Title - SB Admin</title>
    <link href="../ressources/css/styles.css" rel="stylesheet" />
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
                                    <!-- <h3 class="text-center font-weight-light my-4">Password Recovery</h3> -->
                                </div>
                                <div class="card-body">
                                    <div class="small mb-3 text-muted" id="sms">Enter your email address and we will send you a link to reset your password.</div>
                                    <form method="post">
                                        <div class="form-group"><label class="small mb-1" for="email">Email</label><input class="form-control py-4" id="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" /></div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><a class="small" href="../index.php">Return to login</a><input type="submit" class="btn btn-primary" id="reset" value="Reset Password" /></div>
                                    </form>
                                </div>
                                <div class=" card-footer text-center">
                                    <div class="small"><a href="./register.php">Need an account? Sign up!</a></div>
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(document).ready(function() {
            $("#reset").click(function(e) {
                e.preventDefault();
                var email = $("#email").val();
                $.ajax({
                    url: "../traitement/action.php",
                    type: "POST",
                    data: {
                        email: email
                    },
                    success: function(response) {
                        data = JSON.parse(response);
                        if (data.error != 1) {
                            $('#sms').html('Votre Password est :' + data.error);
                            $('#sms').css('font-weight', 'bold');
                            $('#sms').css('font-size', '25px');
                            $('#email').val('');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'this email is not linked to any user!',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
