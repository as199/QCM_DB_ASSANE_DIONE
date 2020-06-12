<style>
    .modalcontenu {
        background-color: blanchedalmond;
    }

    .formgroup {
        margin: 0;
    }
</style>
<div class="container col-md-12 ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="text-center">Liste des Utilisateurs</h3>
            <hr>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Open modal
            </button>
        </div>
    </div>
    <!-- ******************************* -->
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Nouveau utilisateur</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body modalcontenu">

                    <div class="form-group formgroup">
                        <label for="">Prénom:</label>
                        <input type="text" name="prenom" id="prenom" class="form-control" placeholder="votre prénom">
                    </div>
                    <div class="form-group formgroup">
                        <label for="">Nom:</label>
                        <input type="text" name="nom" id="nom" class="form-control" placeholder="votre nom">
                    </div>
                    <div class="form-group formgroup">
                        <label for="">E-mail:</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="votre email">
                    </div>
                    <div class="form-group formgroup">
                        <label for="">Login:</label>
                        <input type="text" name="login" id="login" class="form-control" placeholder="votre login">
                    </div>
                    <div class="form-group formgroup">
                        <label for="">Password:</label>
                        <input type="text" name="password" id="password" class="form-control" placeholder="votre password">
                    </div>
                    <div class="form-group formgroup">
                        <label for="">Avartar:</label>
                        <input type="file" name="photo" id="photo" class="form-control" placeholder="votre Avartar">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" name="valider" class="btn btn-success" data-dismiss="modal" onclick="addRecord()">Valider</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <!-- ******************************* -->
    <div class="row" id="contenu">

        <div class="col-md-12">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>E-mail</th>
                        <th>Login</th>
                        <th>Password</th>
                        <th>Avartar</th>
                        <td colspan="2" align="center">Action</td>
                    </tr>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>1</td>
                        <td>ASSANE</td>
                        <td>Dione</td>
                        <td>Dioneassane0290@gmail.com</td>
                        <td>Admin</td>
                        <td>Admin</td>
                        <td>photo</td>
                        <td><a href="#" class="btn btn-danger">Supprimer</a></td>
                        <td><a href="#" class="btn btn-info">Modifier</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Moussa</td>
                        <td>Top</td>
                        <td>Topmoussa0290@gmail.com</td>
                        <td>passer</td>
                        <td>passer</td>
                        <td>photo</td>
                        <td><a href="#" class="btn btn-danger">Supprimer</a></td>
                        <td><a href="#" class="btn btn-info">Modifier</a></td>
                    </tr>
                </tbody>
            </table>


        </div>
    </div>
</div>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script type="text/javaScript">
    function readRecords() {
        var readRecord ="readrecord";
        $.ajax({
            url:"backend1.php",
            type:"post",
            data:{readrecord:readrecord },
            success:function(data,status) {
                $('#contenu').html(data);
            }
        });
    }
    function addRecord() {
      var prenom=$("#prenom").val();
      var nom=$("#nom").val();
      var email=$("#email").val();
      var login=$("#login").val();
      var password=$("#password").val();
     
      $.ajax({
        url:"backend.php",
        type:'post',
        data:{ prenom :prenom,
              nom :nom,
              email :email,
              login :login,
              password :password
             
         },
         success:function(data,status) {
           readRecords();
         }
      });
    }
  </script>
</body>

</html>
/********************************** */
<!doctype html>
<html lang="en">

<head>
    <title>Sidebar 09</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/font.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        #moncerclediv2c1 {

            border-radius: 50%;
            width: 40%;

        }

        #preview {
            margin-left: 16px;
        }

        #preview img {
            border-radius: 50%;
            width: 180px;
            height: 155px;

        }
    </style>
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                </button>
            </div>
            <div class="img bg-wrap text-center py-4" style="background-image: url(images/bg_1.jpg);">
                <div class="user-logo">
                    <div class="img" style="background-image: url(images/logo.jpg);"></div>
                    <h3>Fatou Séne</h3>
                </div>
            </div>
            <ul class="list-unstyled components mb-5">
                <li class="active">
                    <a href="accueil.php?lien=ajouterquestions"><span class="fa  mr-3"></span> AJOUTER QUESTIONS</a>
                </li>
                <li>
                    <a href="accueil.php?lien=listerquestions"><span class="fa  mr-3 notif"><small class="d-flex align-items-center justify-content-center">5</small></span> LISTER/EDIT QUESTIONS</a>
                </li>
                <li>
                    <a href="accueil.php?lien=ajouterutilisateurs"><span class="fa  mr-3"></span> AJOUTER UTILISATEURS</a>
                </li>
                <li>
                    <a href="accueil.php?lien=listerutilisateurs"><span class="fa  mr-3"></span> LISTER/EDIT UTILISATEURS</a>
                </li>
                <li>
                    <a href="#"><span class="fa  mr-3"></span> </a>
                </li>
                <li>
                    <a href="#"><span class="fa  mr-3"></span> </a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-sign-out mr-3"></span> Sign Out</a>
                </li>
            </ul>

        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <?php
            
            //  Si la variable lien existe dans l'url, la variable $lien = 'accueil'
            if (!isset($_GET['lien']))
                $lien = 'accueil';
            // Sinon $lien est égal à la valeur de la variable lien qui provient de l'url
            else
                $lien = $_GET['lien'];

            // Quand $lien vaut :
            switch ($lien) {
                case 'ajouterquestions':
                    include 'ajouterquestions.php';
                    break;
                case 'listerquestions':
                    include 'listerquestions.php';
                    break;
                case 'ajouterutilisateurs':
                    include 'ajouterutilisateurs.php';
                    break;
                case 'listerutilisateurs':
                    include 'listerutilisateurs.php';
                    break;
            }

            ?>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/a076d05399.js"></script>
    <script src="js/datatables.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript">
        // view image user
        function handleFiles(files) {
            var imageType = /^image\//;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                if (!imageType.test(file.type)) {
                    alert("veuillez sélectionner une image");
                } else {
                    if (i == 0) {
                        preview.innerHTML = '';
                    }
                    var img = document.createElement("img");
                    img.classList.add("obj");
                    img.file = file;
                    preview.appendChild(img);
                    var reader = new FileReader();
                    reader.onload = (function(aImg) {
                        return function(e) {
                            aImg.src = e.target.result;
                        };
                    })(img);

                    reader.readAsDataURL(file);
                }

            }
        }
        /******************************************* */
        $(document).ready(function() {

            showAllUsers();

            function showAllUsers() {
                $.ajax({
                    url: "traitement/action.php",
                    type: "POST",
                    data: {
                        action: "view"
                    },
                    success: function(response) {
                        //console.log(response);
                        $('#showuser').html(response);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });
                    }
                });
            }

            // insertion avec ajax
            $('#insert').click(function(e) {
                if ($('#form-data')[0].checkValidity()) {
                    e.preventDefault();

                    $.ajax({
                        url: "traitement/action.php",
                        type: "POST",
                        data: $('#form-data').serialize() + "&action=insert",
                        success: function(data) {
                            $('#form-data').html(data);
                            Swal.fire({
                                icon: 'success',
                                title: 'User added successfully!',
                            })
                            $("#addModel").modal('hide');
                            $("#form-data")[0].reset();
                            showAllUsers();
                        }
                    });
                }
            });

            // update user
            $("body").on("click", ".editBtn", function(e) {
                console.log("working");
                e.preventDefault();
                edit_id = $(this).attr('id');
                $.ajax({
                    url: "traitement/action.php",
                    type: "POST",
                    data: {
                        edit_id: edit_id
                    },
                    success: function(response) {
                        data = JSON.parse(response);
                        $("#id").val(data.iduser);
                        $("#prenom").val(data.prenom);
                        $("#nom").val(data.nom);
                        $("#email").val(data.email);
                        $("#type").val(data.type);
                        $("#login").val(data.login);
                        $("#password").val(data.password);
                        $("#photo").val(data.photo);
                        // console.log(data);
                    }
                });
            });

            // update avec ajax
            $('#update').click(function(e) {
                if ($('#editform-data')[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "traitement/action.php",
                        type: "POST",
                        data: $('#editform-data').serialize() + "&action=update",
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'User added successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#editModal").modal('hide');
                            $("#editform-data")[0].reset();
                            showAllUsers();
                        }
                    });
                }
            });
            // delete ajax 
            $("body").on("click", ".delBtn", function(e) {
                e.preventDefault();
                var tr = $(this).closest('tr');
                del_id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "traitement/action.php",
                            type: "POST",
                            data: {
                                del_id: del_id
                            },
                            success: function(response) {
                                tr.css('background-color', '#ff666');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'User deleted successfully!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                $("#editModal").modal('hide');
                                $("#editform-data")[0].reset();
                                showAllUsers();
                            }
                        });
                    }
                });
            });

            // view details user
            $("body").on("click", ".infoBtn", function(e) {
                e.preventDefault();
                info_id = $(this).attr('id');
                $.ajax({
                    url: "traitement/action.php",
                    type: "POST",
                    data: {
                        info_id: info_id
                    },
                    success: function(response) {
                        //console.log(response);
                        data = JSON.parse(response);
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
    </script>
</body>

</html>