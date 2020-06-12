<div class="container" style="overflow: scroll;height: 560px;" id="scrollZone">
    <!-- <div class="row">
        <div class="col-lg-12">
x        </div>
    </div> -->
    <div class="row" id="">
        <div class="col-lg-6">
            <h4 class="mt-2 text-primary">All users</h4>
        </div>
        <div class="col-lg-6">

            <button type="button" class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addModel"><i class="fas fa-user-plus fa-lg"></i>&nbsp;&nbsp;Add New User</button>

            <a href="../traitement/action.php?export=excel" class="btn btn-success m-1 float-right"><i class="fas fa-table fa-lg"></i>&nbsp;&nbsp;Export to Excel</a>

        </div>
    </div>
    <hr class="my-1">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive" id="showuser">
                <h3 class="text-center text-success" style="margin-top:150px">Loading&nbsp;&nbsp;<i class="fas fa-sync-alt fa-spin text-success"></i></h3>

            </div>
        </div>

    </div>

</div>

<!-- The Modal -->
<div class="modal" id="addModel">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add New User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body px-4">
                <form action="" method="post" id="samaform" enctype="multipart/form-data">
                    <input type="hidden" name="classe" id="classe" value="addusern">

                    <div class="row">
                        <div class="gauche" style="width:50%; padding-left:15px;">
                            <div class="form-group ">
                                <input type="text" name="prenoms" id="prenoms" class="form-control" placeholder="votre prénom" pattern="[A-Za-z]+">
                                <span id="error1"></span>
                            </div>
                            <div class="form-group ">
                                <input type="text" name="noms" id="noms" class="form-control" placeholder="votre nom" pattern="[A-Za-z]+">
                                <span id="error2"></span>
                            </div>
                            <div class="form-group ">
                                <input type="email" name="emails" id="emails" class="form-control" placeholder="votre email">
                                <span id="error3"></span>
                            </div>
                        </div>
                        <div class="droit float-left " id="moncerclediv2c1">
                            <span id="preview"></span>

                        </div>
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="types" id="types" type="text" placeholder="Enter your login">
                            <option value="">--Please choose The Type--</option>
                            <option value="admin">Administrateur </option>
                            <option value="jouer">Joueur </option>
                        </select>

                    </div>
                    <div class="form-group">
                        <input type="text" name="logins" id="logins" class="form-control" placeholder="votre login">
                        <span id="error4"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="passwords" id="passwords" class="form-control" placeholder="votre password">
                        <span id="error5"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="cpasswords" id="cpasswords" class="form-control" placeholder="confirm password">
                        <span id="error6"></span>
                    </div>
                    <div class="form-group">
                        <input type="file" id="files" name="files" class="custom-file" placeholder="votre Avartar" onchange="handleFiles(files)">

                    </div>
                    <div class="form-group">
                        <input type="submit" name="adds" id="adds" class="btn btn-success btn-block" value="Add User">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ******************************* -->
<!--edit user  The Modal -->
<div class="modal" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body px-4">
                <form action="" method="post" id="editform-data" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <!-- <div class="row"> -->
                    <!-- <div class="gauche" style="width:50%; padding-left:15px;"> -->
                    <div class="form-group ">
                        <input type="text" name="prenom" id="prenom" class="form-control" placeholder="votre prénom" pattern="[A-Za-z]+">
                    </div>
                    <div class="form-group ">
                        <input type="text" name="nom" id="nom" class="form-control" placeholder="votre nom" pattern="[A-Za-z]+">
                    </div>
                    <div class="form-group ">
                        <input type="email" name="email" id="email" class="form-control" placeholder="votre email">
                    </div>
                    <!-- </div> -->
                    <!--  <div class="droit float-left " id="moncerclediv2c1">
                            <span id="preview">
                                <img src="" id="monimg">
                            </span>

                        </div> -->
                    <!-- </div> -->
                    <div class="form-group">
                        <select class="form-control" name="type" id="type" type="text" required>
                            <option value="">--Please choose The Type--</option>
                            <option value="admin">Administrateur </option>
                            <option value="jouer">Joueur </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="login" id="login" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="file" name="photo" id="photo" class="form-control">
                        <span id="userimage"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="update" id="update" class="btn btn-primary btn-block" value="Edit User">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../ressources/js/user.js"></script>