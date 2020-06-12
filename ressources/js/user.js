$(document).ready(function () {


    /************************************** */
    showAllUsers();

    function showAllUsers() {
        $.ajax({
            url: "../traitement/action.php",
            type: "POST",
            data: {
                action: "view"
            },
            success: function (data) {
                $('#showuser').html(data);

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






            }
        });
    }
    // update user
    $("body").on("click", ".editBtn", function (e) {
        //console.log("working");
        e.preventDefault();
        edit_id = $(this).attr('id');
        $.ajax({
            url: "../traitement/action.php",
            type: "POST",
            data: {
                edit_id: edit_id
            },
            success: function (response) {
                data = JSON.parse(response);
                $("#id").val(data.iduser);
                $("#prenom").val(data.prenom);
                $("#nom").val(data.nom);
                $("#email").val(data.email);
                $("#type").val(data.type);
                $("#login").val(data.login);
                $("#password").val(data.password);
                // $("#photo").val(data.photo);
                // var imag =data.photo;
                // var image = './images/avartar/'+imag;
                //  $("#monimg").attr('src',image);
                // console.log(image);
            }
        });
    });

    // update avec ajax
    $('#update').click(function (e) {
        if ($('#editform-data')[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
                url: "../traitement/action.php",
                type: "POST",
                data: $('#editform-data').serialize() + "&action=update",
                success: function (response) {
                    let timerInterval
                    Swal.fire({
                        title: 'user updated successfully!',
                        html: 'I will close in <b></b> milliseconds.',
                        timer: 1000,
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
                }
            });
        }
    });
    // delete ajax
    $("body").on("click", ".delBtn", function (e) {
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
                    url: "../traitement/action.php",
                    type: "POST",
                    data: {
                        del_id: del_id
                    },
                    success: function (response) {
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

 // lock user ajax
    $("body").on("click", ".lockbnt", function (e) {
        e.preventDefault();
        var tr = $(this).closest('tr');
        lock_id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, lock it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "../traitement/action.php",
                    type: "POST",
                    data: {
                        lock_id: lock_id
                    },
                    success: function (response) {
                        console.log(response);
                        data =JSON.parse(response);
                        if(data.error =="good"){
                            tr.css('background-color', '#ff666');
                            Swal.fire({
                            icon: 'success',
                            title: 'User locked successfully!',
                            showConfirmButton: false,
                            timer: 1500
                            })
                            $("#editModal").modal('hide');
                            $("#editform-data")[0].reset();
                             showAllUsers();
                        }else if (data.error =="connect") {
                            tr.css('background-color', '#ff666');
                             Swal.fire({
                            icon: 'success',
                            title: 'User not locked successfully!',
                            showConfirmButton: false,
                            timer: 1500
                            })
                            $("#editModal").modal('hide');
                            $("#editform-data")[0].reset();
                            showAllUsers();
                        }else{
                            tr.css('background-color', '#ff666');
                             Swal.fire({
                            icon: 'success',
                            title: 'User already blocked!',
                            showConfirmButton: false,
                            timer: 1500
                            })
                            $("#editModal").modal('hide');
                            $("#editform-data")[0].reset();
                            showAllUsers();
                        }
                        tr.css('background-color', '#ff666');
                        Swal.fire({
                            icon: 'success',
                            title: 'not locked  successfully!',
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
    $("body").on("click", ".infoBtn", function (e) {
        e.preventDefault();
        info_id = $(this).attr('id');
        $.ajax({
            url: "../traitement/action.php",
            type: "POST",
            data: {
                info_id: info_id
            },
            success: function (response) {
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
    $('#adds').click(function (e) {
        e.preventDefault();
        /******************************************* */
        if ((document.getElementById("noms").value != "") && (document.getElementById("files").value != "") && (document.getElementById("prenoms").value != "") && (document.getElementById("emails").value != "") && (document.getElementById("logins").value != "") && (document.getElementById("passwords").value != "") && (document.getElementById("types").value != "") && (document.getElementById("cpasswords").value != "")) {
            if ((document.getElementById("cpasswords").value) == (document.getElementById("passwords").value)) {


                var form = $('#samaform')[0];
                var data = new FormData(form);
                //data.append("text", document.getElementById("classe").value);
                $.ajax({
                    url: "../traitement/action.php",
                    type: "POST",
                    enctype: 'multipart/form-data',
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 600000,
                    data: data
                    ,
                    success: function (response) {
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

                            $("#samaform")[0].reset();
                            showAllUsers();
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'the two passwords do not match!'

                })
                document.getElementById("cpasswords").value = "";
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'please fill in all fields!'

            })
        }
    });

});
// add userlisterutilisateur
$('#addusersimple').click(function (e) {
    e.preventDefault();
    /******************************************* */
    if ((document.getElementById("noms").value != "") && (document.getElementById("files").value != "") && (document.getElementById("prenoms").value != "") && (document.getElementById("emails").value != "") && (document.getElementById("logins").value != "") && (document.getElementById("passwords").value != "") && (document.getElementById("types").value != "") && (document.getElementById("cpasswords").value != "")) {
        if ((document.getElementById("cpasswords").value) == (document.getElementById("passwords").value)) {


            var form = $('#addsimples')[0];
            var data = new FormData(form);
            //data.append("text", document.getElementById("classe").value);
            $.ajax({
                url: "../traitement/action.php",
                type: "POST",
                enctype: 'multipart/form-data',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                data: data
                ,
                success: function (response) {
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

                        $("#addsimples")[0].reset();
                        showAllUsers();
                    }
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'the two passwords do not match!'

            })
            document.getElementById("cpasswords").value = "";
        }
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'please fill in all fields!'

        })
    }
});







// function renvoyer() {
//     event.preventDefault();
//     var error = '';
//     if ((document.getElementById("noms").value != "") && (document.getElementById("files").value != "") && (document.getElementById("prenoms").value != "") && (document.getElementById("emails").value != "") && (document.getElementById("logins").value != "") && (document.getElementById("passwords").value != "") && (document.getElementById("types").value != "") && (document.getElementById("cpasswords").value != "")) {

//         if ((document.getElementById("cpasswords").value) == (document.getElementById("passwords").value)) {

//             var form = $('#samaform')[0];
//             var data = new FormData(form);
//             //data.append("text", document.getElementById("prenom").value);
//             $.ajax({
//                 url: '../traitement/action.php',
//                 type: 'POST',
//                 enctype: 'multipart/form-data',
//                 data: data,
//                 processData: false,
//                 contentType: false,
//                 cache: false,
//                 timeout: 600000,
//                 success: function (data) {
//                     //console.log(response);
//                     //alert(reponse);
//                     let timerInterval
//                     Swal.fire({
//                         title: 'User added successfully!',
//                         html: 'I will close in <b></b> milliseconds.',
//                         timer: 2000,
//                         timerProgressBar: true,
//                         onBeforeOpen: () => {
//                             Swal.showLoading()
//                             timerInterval = setInterval(() => {
//                                 const content = Swal.getContent()
//                                 if (content) {
//                                     const b = content.querySelector('b')
//                                     if (b) {
//                                         b.textContent = Swal.getTimerLeft()
//                                     }
//                                 }
//                             }, 100)
//                         },
//                         onClose: () => {
//                             clearInterval(timerInterval)
//                         }
//                     }).then((result) => {
//                         /* Read more about handling dismissals below */
//                         if (result.dismiss === Swal.DismissReason.timer) {
//                             console.log('I was closed by the timer');
//                             $("#addModal").modal('hide');
//                             $("#editform-data")[0].reset();
//                             showAllUsers();
//                         }
//                     })


//                 }
//             });
//         } else {
//             error = 2;
//         }

//     }
//     else {
//         error = 1;
//     }
//     if (error == 2) {
        // Swal.fire({
        //     icon: 'error',
        //     title: 'Oops...',
        //     text: 'the two passwords do not match!'

        // })
//     } else if (error == 1) {
        // Swal.fire({
        //     icon: 'error',
        //     title: 'Oops...',
        //     text: 'please fill in all fields!'

        // })
//     }

// }




/********************************* */
// add userg   var form = $('#addsimple')[0];
function envoyer() {
    event.preventDefault();
    var error = '';
    if ((document.getElementById("nom").value != "") && (document.getElementById("files").value != "") && (document.getElementById("prenom").value != "") && (document.getElementById("email").value != "") && (document.getElementById("login").value != "") && (document.getElementById("password").value != "") && (document.getElementById("type").value != "") && (document.getElementById("cpassword").value != "")) {

        if ((document.getElementById("cpassword").value) == (document.getElementById("password").value)) {

            var form = $('#addsimple')[0];
            var data = new FormData(form);
            //data.append("text", document.getElementById("prenom").value);
            $.ajax({
                url: '../traitement/action.php',
                type: 'POST',
                enctype: 'multipart/form-data',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    //console.log(response);
                    //alert(reponse);
                    let timerInterval
                    Swal.fire({
                        title: 'User added successfully!',
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


                }
            });
        } else {
            error = 2;
        }

    }
    else {
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
            reader.onload = (function (aImg) {
                return function (e) {
                    aImg.src = e.target.result;
                };
            })(img);

            reader.readAsDataURL(file);
        }

    }
}
