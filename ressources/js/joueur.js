$(document).ready(function () {

    // choix du rubrique du joueur
    $('#rubrique').click(function (e) {
        if ($('#form-rubrique')[0].checkValidity()) {
            e.preventDefault();

            $.ajax({
                url: "../traitement/action.php",
                type: "POST",
                data: $('#form-rubrique').serialize() + "&action=rubiquechoisi",
                success: function (response) {
                    // data = JSON.parse(response);
                    // console.log(response);
                    window.location.href = '../vue/joueur.php?page=0'
                    // if(data.error=="bon"){
                    // window.location.href ='../../vue/joueur.php?page=0'
                    // }
                    // let timerInterval
                    //  Swal.fire({
                    //      title: 'Choice validated successfully!',
                    //      html: 'you will be redirected in <b></b> milliseconds.',
                    //      timer: 2000,
                    //      timerProgressBar: true,
                    //      onBeforeOpen: () => {
                    //          Swal.showLoading()
                    //          timerInterval = setInterval(() => {
                    //              const content = Swal.getContent()
                    //              if (content) {
                    //                  const b = content.querySelector('b')
                    //                  if (b) {
                    //                      b.textContent = Swal.getTimerLeft()
                    //                  }
                    //              }
                    //          }, 100)
                    //      },
                    //      onClose: () => {
                    //          clearInterval(timerInterval)
                    //      }
                    //  }).then((result) => {
                    //      /* Read more about handling dismissals below */
                    //      if (result.dismiss === Swal.DismissReason.timer) {
                    //          console.log('I was closed by the timer');
                    //          location.reload();
                    //          window.location.href = data.error;
                    //      }
                    //  })

                }
            });
        }
    });




});
