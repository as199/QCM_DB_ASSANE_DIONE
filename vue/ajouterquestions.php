<form method="post" id="addQuestions" action="">
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="validationDefault01">Questions</label>
            <textarea name="question" class="form-control" id="" cols="30" rows="2" required></textarea>

        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="validationDefault01">Rubrique</label>
            <select class="custom-select" name="rubrique" required>
                <option selected disabled value="">Choose your rubric...</option>
                <option value="tous">Tous*</option>
                <option value="sport">Sport</option>
                <option value="culturegeneral">Culture Général</option>
                <option value="informatique">Informatique</option>
            </select>
        </div>
    </div>
    <div class="form-row">
    <form class="form-inline">
            <div class="form-group mb-2">

                
                <input type="text" class="form-control" name="score" placeholder="score" pattern="^(1|2|3|4|5|6|7|8|9)[0-9]*$" required>

            </div>
            <div class="form-group mx-sm-3 mb-2">
                <select class="custom-select" id="typ" name="type" required>
                    <option selected disabled value="">Choose your type...</option>
                    <option value="choixmultiple">multiple choice</option>
                    <option value="choixsimple">simple choice</option>
                    <option value="choixtext">text choice</option>
                </select>
            </div>
            <button type="button" id="generer" name="genereur" onclick="genere()"><i class='fas fa-plus-square ' style='font-size:40px;color:blue'></i></button>

        
    </div>
    <div class=" form-group " id="divgener">
        <div class="hautgener" id="hautgener">
            <div class="divgener" id="row_0">

            </div>

        </div>

    </div>
    <button class="btn btn-primary" id="btnval" name="valquestion" type="submit">Valider</button>
</form>
<script src="../ressources/js/question.js"></script>
