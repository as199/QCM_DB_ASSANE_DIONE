$(document).ready(function () {
 
    $('#limite').change(function () {
        var str = "";
        $("#limite option:selected").each(function () {
            str += $(this).text() + " ";
        });
        //$("div").text(str);
        alert(str);
    });
    /************************************** */
   
    showAllQuestion();
    function showAllQuestion() {
      
        $.ajax({
            url: "../traitement/action.php",
            type: "POST",
            data: {
                action: "viewquestions"
            },
            success: function (data) {
                //console.log(response);
                $('#showquestion').html(data);
                
                $('table').DataTable({


                    pagingType: "simple_numbers",

                    // lengthMenu: [5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 25]
                    "language": {
                        "lengthMenu": 'Limite par page <select id="limite">' +
                            '<option value="5">5</option>' +
                            '<option value="6">6</option>' +
                            '<option value="7">7</option>' +
                            '<option value="8">8</option>' +
                            '<option value="9">9</option>' +
                            '<option value="10">10</option>' +
                            '<option value="11">11</option>' +
                            '<option value="12">12</option>' +
                            '<option value="13">13</option>' +
                            '<option value="14">14</option>' +
                            '<option value="15">15</option>' +
                            '<option value="16">16</option>' +
                            '<option value="17">17</option>' +
                            '<option value="18">18</option>' +
                            '<option value="13">13</option>' +
                            '<option value="20">20</option>' +
                            '<option value="21">21</option>' +
                            '<option value="22">22</option>' +
                            '<option value="23">23</option>' +
                            '<option value="24">24</option>' +
                            '<option value="25">25</option>' +
                            '<option value="-1">All</option>' +
                            '</select> '
                    }
                   
                });
                $("#limite").change(function () {
                 var limite = $("#limite").val();
                    $.ajax({
                        url: "../traitement/action.php",
                        type: "POST",
                        data: {
                            limite: limite
                        },
                        success:function(response){
                        //console.log(response);
                        }
                    });
                });
            }
        });
    }
    // recuperation du nombre de question par jeu
   
    //add questions
    $('#btnval').click(function (e) {
        if ($('#addQuestions')[0].checkValidity()) {
            e.preventDefault();

            $.ajax({
                url: "../traitement/action.php",
                type: "POST",
                data: $('#addQuestions').serialize() + "&action=addquestions",
                success: function (data) {

                    let timerInterval
                    Swal.fire({
                        title: 'Question added successfully!',
                        html: 'I will close in <b></b> milliseconds.',
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
                            $("#addQuestions")[0].reset();
                           // location.reload();
                        }
                    })

                }
            });
        }
    });




    // view quetion detail

    // view details user
    $("body").on("click", ".infoBtnq", function (e) {
        e.preventDefault();
        infos_id = $(this).attr('id');
        $.ajax({
            url: "../traitement/action.php",
            type: "POST",
            data: {
                infos_id: infos_id
            },
            success: function (response) {
                //console.log(response);
                data = JSON.parse(response);
                Swal.fire({
                    title: '<strong>Question Info : ID(' + data.idquestion + ')</strong>',
                    icon: 'info',
                    html: '<b>Question :</b>' + data.question + '<br><b>Rubrique :</b>' + data.rubrique + '<br><b>Type :</b>' + data.type + '<br><b>Score :</b>' + data.score + '<br><b>Réponse :</b>' + data.reponse + '<br><b>Vrai :</b>' + data.vrais,
                    showCancelButton: true,

                })
            }
        });
    });
// reour dans le jeu
    $('#retour').click(function (e) {
        e.preventDefault();
        $.ajax({
            url:'../traitement/action.php',
            type:'POST',
            success:function (response) {
                console.log(response);
               // window.location.href = './vue/joueur.php?page=0';
                
            }
        });
    });


    // delete ajax questions
    $("body").on("click", ".delBtnq", function (e) {
        e.preventDefault();
        var tr = $(this).closest('tr');
        delq_id = $(this).attr('id');
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
                    url: "../traitement/action.php",
                    type: "POST",
                    data: {
                        delq_id: delq_id
                    },
                    success: function (response) {
                        data =JSON.parse(response);
                        if(data.error =='faux'){
                            tr.css('background-color', '#ff666');
                            Swal.fire({
                                icon: 'success',
                                title: 'question deleted successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            // $("#editModal").modal('hide');
                            // $("#editform-data")[0].reset();
                            showAllQuestion();
                        }else{
                            tr.css('background-color', '#ff666');
                            Swal.fire({
                                icon: 'success',
                                title: 'question not deleted successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            // $("#editModal").modal('hide');
                            // $("#editform-data")[0].reset();
                            showAllQuestion();
                        }
                    }
                });
            }
        });
    });

    // update question
    $("body").on("click", ".editBtnq", function (e) {
        //console.log("working");
        e.preventDefault();
        editq_id = $(this).attr('id');
        $.ajax({
            url: "../traitement/action.php",
            type: "POST",
            data: {
                editq_id: editq_id
            },
            success: function (response) {
                data = JSON.parse(response);
                $("#id").val(data.idquestion);
                $("#question").val(data.question);
                $("#rubrique").val(data.rubrique);
                $("#typ").val(data.type);
                $("#score").val(data.score);

                // console.log(data);
            }
        });
    });

    // update avec ajax
    $('#updateq').click(function (e) {
        if ($('#editqform-data')[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
                url: "../traitement/action.php",
                type: "POST",
                data: $('#editqform-data').serialize() + "&action=updateq",
                success: function (response) {
                    data = JSON.parse(response);
                    if(data.error == "faux"){
                    let timerInterval
                    Swal.fire({
                        title: 'Question updated successfully!',
                        html: 'I will close in <b></b> milliseconds.',
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
                            location.reload();
                        }
                    })
                }else{
                        Swal.fire({
                            icon: 'success',
                            title: 'question not updated successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                }
                }
            });
        }
    });
    

});


/*******gener inputs */
var nbrow = 0;
var i = 0;
var t = 0;
function genere() {
    nbrow++;
    i++;
    var btngenerer = document.getElementById('generer');
    var choise = document.getElementById('select');
    var divInputs = document.getElementById('hautgener');
    var newInput = document.createElement('div');
    newInput.setAttribute('class', 'divgener');
    newInput.setAttribute('id', 'row_' + nbrow);
    if (typ.value == "choixmultiple") {
         newInput.innerHTML = '<div class="form-inline"><input class="form-control h-25 form-control-sm col-md-6 h-5" style="font-size: 17px;" type="text" name="rep[' + i + ']" id="inpgener" placeholder="reponse&nbsp;' + i + '">&nbsp;&nbsp; <input type="checkbox" class=" form-check form-check-input" id="materialUnchecked" name="vrais[]" value="' + i + '" id="checkgener">&nbsp;&nbsp;<i type="button" class="fas fa-trash-alt" style="font-size:30px;color:red;" onclick="ondelete(' + nbrow + ')"></i></div>'
            ;
        divInputs.appendChild(newInput);
    }
    if (typ.value == "choixsimple") {
        newInput.innerHTML = '<div class="form-inline"><input class="form-control h-25 form-control-sm col-md-6 h-5" type="text" style="font-size: 17px;" name="rep[' + i + ']" id="inpgener" placeholder="reponse&nbsp;' + i + '">&nbsp;&nbsp;<input type="radio"  class=" form-check form-check-input" id="materialUnchecked" name="vrais" value="' + i + '" id="checkgener">&nbsp;&nbsp;<i type="button" class="fas fa-trash-alt" style="font-size:30px;color:red;" onclick="ondelete(' + nbrow + ')"></i></div>'
            ;
        divInputs.appendChild(newInput);
    }
    if (typ.value == "choixtext") {

        newInput.innerHTML = '<div class="form-inline" > <input class="form-control h-25 form-control-sm col-md-6 h-5" type="text" style="font-size: 17px;" name="rep" id="inpgener" placeholder="reponse&nbsp;' + i + '"></div>'
            ;
        divInputs.appendChild(newInput);
        if (i > 0) {
            generer.setAttribute('disabled', 'disabled');
        }
    }

}
function ondelete(n) {
    var target = document.getElementById('row_' + n);
    target.remove();

}
$("select").change(function () {
    var str = "";
    $("select option:selected").each(function () {
        str += $(this).text() + " ";
    });
    //$("div").text(str);
    alert(str);
})

