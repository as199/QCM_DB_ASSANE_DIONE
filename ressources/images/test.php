 $(document).ready(function () {
 $('#forms').validate({
 rules: {
 prenoms: "required",
 noms: "required",
 emails :"required",
 logins: {
 required: true,
 minlength: 2
 },
 passwords: {
 required: true,
 minlength: 5
 },
 cpasswords: {
 required: true,
 minlength: 5,
 equalTo: "#passwords"
 }
 },
 messages: {
 prenoms: "Veuillez saisir votre prenom!",
 noms: "Veuillez saisir votre nom!",
 logins: {
 required: "Veuillez saisir un login!",
 minlength: "Votre login doit contenir au moins 2 caractère"
 },
 passwords: {
 required: "Donnez un mot de passe",
 minlength: "Votre mot de passe doit contenir au moins 5 caractère"
 },
 cpasswords: {
 required: "Donnez un mot de passe",
 minlength: "Votre mot de passe doit contenir au moins 5 caractère",
 equalTo: "#Veuillez saisir un mot de passe identique au précédent!"
 }
 }
 e.preventDefault();
 if($('#prenoms').val()==""){
 $('#error1').text('Veuillez saisir un prenom!')
 }
 if($('#noms').val()==""){
 $('#error2').text('Veuillez saisir un nom!')
 }
 if($('#logins').val()==""){
 $('#error3').text('Veuillez saisir un login!')
 }
 if($('#emails').val()==""){
 $('#error4').text('Veuillez saisir un login!')
 }
 if($('#passwords').val()==""){
 $('#error5').text('Veuillez saisir un mot de passe!')
 }
 if($('#cpasswords').val()==""){
 $('#error6').text('Veuillez saisir un mot de passe identique au précédent!')
 }
 });

 });