$(document).ready(function() {
   // login form
   $('#logText').html('Login');
   $('#logForm').submit(function(e) {
      e.preventDefault();
      $('#responseDiv').removeClass('bg-danger').addClass('bg-success').show();
      $('#message').html('Checking...');
      $('#logText').html('Wait...');
      $('#submit').prop('disabled', true);
      var user = $('#logForm').serialize();
      var login = function() {
         $.ajax({
            type: 'POST',
            url: url + 'auth/auth_admin',
            dataType: 'json',
            data: user,
            success: function(response) {
               $('#message').html(response.message);
               $('#logText').html('Login');
               $('#submit').prop('disabled', false);
               if (response.error) {
                  $('#responseDiv').removeClass('bg-success').addClass('bg-danger').show();
                  $('#username').focus();
               } else {
                  $('#responseDiv').removeClass('bg-danger').addClass('bg-success').show();
                  setTimeout(function() {
                     location.reload();
                  }, 1000);
               }
            }
         });
      };
      setTimeout(login, 1000);
   });

   $('#logFormUser').submit(function(e) {
      e.preventDefault();
      $('#responseDiv').removeClass('bg-danger').addClass('bg-success').show();
      $('#message').html('Checking...');
      $('#logText').html('Wait...');
      $('#submit').prop('disabled', true);
      var user = $('#logFormUser').serialize();
      var login = function() {
         $.ajax({
            type: 'POST',
            url: url + 'auth/auth_user',
            dataType: 'json',
            data: user,
            success: function(response) {
               $('#message').html(response.message);
               $('#logText').html('Login');
               $('#submit').prop('disabled', false);
               if (response.error) {
                  $('#responseDiv').removeClass('bg-success').addClass('bg-danger').show();
                  $('#username').focus();
               } else {
                  $('#responseDiv').removeClass('bg-danger').addClass('bg-success').show();
                  setTimeout(function() {
                     window.location = url+response.link;
                  }, 1000);
               }
            }
         });
      };
      setTimeout(login, 1000);
   });

   // registrasi form
   $('#regText').html('Registrasi');
   $('#regForm').submit(function(e) {
      e.preventDefault();
      $('#responseDiv').removeClass('bg-danger').addClass('bg-success').show();
      $('#message').html('Checking Account...');
      $('#regText').html('Please wait...');
      $('#submit').prop('disabled', true);
      var user = $('#regForm').serialize();
      var reg_akun = function() {
         $.ajax({
            type: 'POST',
            url: url + 'auth/regis',
            dataType: 'json',
            data: user,
            success: function(response) {
               $('#message').html(response.message);
               $('#regText').html('Registrasi');
               $('#submit').prop('disabled', false);
               if (response.error) {
                  $('#responseDiv').removeClass('bg-success').addClass('bg-danger').show();
               } else {
                  $('#responseDiv').removeClass('bg-danger').addClass('bg-success').show();
                  $('#regForm')[0].reset();
                  if (response.reseler){
                     setTimeout(function() {
                        window.location = url+'user/reseler_toko_baru/'+response.reseler;
                     }, 2000);
                  } else{
                     setTimeout(function() {
                        window.location = url+'auth/login_user';
                     }, 2000);
                  }
               }
            }
         });
      };
      setTimeout(reg_akun, 2000);
   });
});