$(document).ready(function () {
  $(".signup-form").submit(function (event) {
    var formData = {
      name: $("#f_name").val(),
      lname: $("#l_name").val(),
      email: $("#emailreg").val(),
      pass1: $("#password1").val(),
      pass2: $("#password2").val(),
      mob: $("#mobile").val(),
      sub: $("#submit").val(),
      address: $("#address").val(),
    };
    $.ajax({
      type: "POST",
      url: "assets/php/authentication.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      if (data == "1") {
        $("#resultreg").html(
          "<div class='alert alert-success p-2' role='alert' style='width:fit-content; position: relative;left: 50%; transform: translateX(-50%);'>registration was successful.</div>"
        );
        document.documentElement.scrollTop = 0;
      } else {
        $("#resultreg").html(
          "<div class='alert alert-danger p-2' role='alert' style='width:fit-content; position: relative;left: 50%; transform: translateX(-50%);'>registration failed.</div>"
        );
        document.documentElement.scrollTop = 0;
      }
    });
    event.preventDefault();
  });
});
