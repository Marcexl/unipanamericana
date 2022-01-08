/*
 * mixed by marcexl
 * version 05102021
 *
 */

$(document).ready(function(){

  $('#lastname').on('input', function() {
    var c = this.selectionStart,
        r = /[^a-z \ \Ã± \u00E0-\u00FC]/gi,
        v = $(this).val();

    if(r.test(v))
    {
      $(this).val(v.replace(r, ''));
      c--;
    }
    this.setSelectionRange(c, c);
  });

  $('#firstname').on('input', function() {
    var c = this.selectionStart,
        r = /[^a-z \ \Ã± \u00E0-\u00FC]/gi,
        v = $(this).val();
    if(r.test(v)) {
      $(this).val(v.replace(r, ''));
      c--;
    }
    this.setSelectionRange(c, c);
  });

  $('#empresa').on('input', function() {
    var c = this.selectionStart,
        r = /[^0-9 a-z \Ã± \u00E0-\u00FC \.]/gi,
        v = $(this).val();
    if(r.test(v)) {
      $(this).val(v.replace(r, ''));
      c--;
    }
    this.setSelectionRange(c, c);
  });
  
  $('#mobilephone').on('input', function() {
    var c = this.selectionStart,
        r = /[^0-9]/gi,
        v = $(this).val();
    if(r.test(v)) {
      $(this).val(v.replace(r, ''));
      c--;
    }
    this.setSelectionRange(c, c);
  });

});



function sendForm(){
	$("#formulario").submit();
}

/* VALIDATE */
var msg  = "Completa este campo obligatorio";
var msg1 = "Indique un email valido";

$("#formulario").validate({

  ignore: '.select2-input, .select2-focusser',
  rules: {
    'lastname': {required: true, minlength:2}, 
    'firstname': {required: true, minlength:2},
    'email': {required: true},
    'mobilephone': {required: true},
    'empresa': {required: true},
    'posgrado': {required: true}
    },
  
  messages: {
    'lastname':  msg,
    'firstname': msg,
    'email': msg1,
    'mobilephone': msg,
    'empresa': msg,
    'posgrado': msg
  },

  submitHandler: function(form){ 
    $.ajax({
      type: "POST",
      url: "mail.php",
      data: $("#formulario").serialize(),
      error: function(msj){
        alert("Ha ocurrido un error.");
        console.log(msj);
      }, 
      success: function(res) 
      {
        var data = JSON.parse(res);

        if(data['send'] == true)
        { 
          setTimeout(function()
          { 
            location = "gracias.php";     
          }, 200);
        } 
        else 
        {
          $("#loader").fadeOut('slow');

          var msj = data['msj'];
          alert(msj);
        
        }
      }
    })//ajax
  }
})//validate
