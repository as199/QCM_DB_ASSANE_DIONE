<div class="container" id="fixe">
    <div class="row">

        <div class="col-lg-6">
            <!-- <button type="button" class="btn btn-primary m-1 float-right hide" data-toggle="modal" data-target="#addQuestions"><i class="fas fa-user-plus fa-lg"></i>&nbsp;&nbsp;Add New User</button> -->
        </div>
    </div>
    <hr class="my-1">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive" id="showquestion" style="height:560px;overflow:scroll;">
                <h3 class="text-center text-success" style="margin-top:150px">Loading&nbsp;&nbsp;<i class="fas fa-sync-alt fa-spin text-success"></i></h3>

            </div>
        </div>
    </div>

</div>


<!--edit question  The Modal -->
<div class="modal" id="editqModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body px-4 container">
                <form action="" method="post" id="editqform-data" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationDefault01">Questions</label>
                            <textarea name="question" class="form-control" id="question" cols="30" rows="2" required></textarea>

                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="validationDefault01">Rubrique</label>
                            <select class="custom-select" id="rubrique" name="rubrique" required>
                                <option selected disabled value="">Choose your rubric...</option>
                                <option value="tous">Tous*</option>
                                <option value="sport">Sport</option>
                                <option value="culturegeneral">Culture Général</option>
                                <option value="informatique">Informatique</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label for="validationDefault03">Scores</label>
                            <input type="text" class="form-control" id="score" name="score" pattern="^(1|2|3|4|5|6|7|8|9)[0-9]*$" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="validationDefault04">Type</label>
                            <select class="custom-select" id="typ" name="type" required>
                                <option selected disabled value="">Choose your type...</option>
                                <option value="choixmultiple">multiple choice</option>
                                <option value="choixsimple">simple choice</option>
                                <option value="choixtext">text choice</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3 btngener">
                            <label for="validationDefault03">Generer</label><br>
                            <button type="button" id="generer" name="genereur" onclick="genere()"><i class='fas fa-plus-square ' style='font-size:40px;color:blue'></i></button>
                        </div>
                    </div>
                    <div class=" form-group col-md-12" style="width: 100%" id="divgener">
                        <div class="hautgener" id="hautgener">
                            <div class="divgener" id="row_0">

                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="updateq" id="updateq" class="btn btn-primary btn-block" value="Edit Question">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!--add question  The Modal -->
<div class="modal" id="editqModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body px-4 container">
                <form action="" method="post" id="addQuestions" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationDefault01">Questions</label>
                            <textarea name="question" class="form-control" id="question" cols="30" rows="2" required></textarea>

                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="validationDefault01">Rubrique</label>
                            <select class="custom-select" id="rubrique" name="rubrique" required>
                                <option selected disabled value="">Choose your rubric...</option>
                                <option value="tous">Tous*</option>
                                <option value="sport">Sport</option>
                                <option value="culturegeneral">Culture Général</option>
                                <option value="informatique">Informatique</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label for="validationDefault03">Scores</label>
                            <input type="text" class="form-control" id="score" name="score" pattern="^(1|2|3|4|5|6|7|8|9)[0-9]*$" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="validationDefault04">Type</label>
                            <select class="custom-select" id="typ" name="type" required>
                                <option selected disabled value="">Choose your type...</option>
                                <option value="choixmultiple">multiple choice</option>
                                <option value="choixsimple">simple choice</option>
                                <option value="choixtext">text choice</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3 btngener">
                            <label for="validationDefault03">Generer</label><br>
                            <button type="button" id="generer" name="genereur" onclick="genere()"><i class='fas fa-plus-square ' style='font-size:40px;color:blue'></i></button>
                        </div>
                    </div>
                    <div class=" form-group col-md-12" style="width: 100%" id="divgener">
                        <div class="hautgener" id="hautgener">
                            <div class="divgener" id="row_0">

                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="btnval" id="btnval" class="btn btn-primary btn-block" value="Edit Question">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../ressources/js/question.js"></script>