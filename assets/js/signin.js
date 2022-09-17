$(document).ready(function () {
  $("#login").submit(function (event) {
    let formData = {
      email: $("#email").val(),
      pass: $("#password").val(),
      sub: $("#loginsubmit").val(),
    };
    $.ajax({
      type: "POST",
      url: "assets/php/authentication.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      if (data == "1") {
        $("#login").html(
          $("#email").val() +
            "<span class='text-success fw-bold'> Welcome</span>"
        );
      } else {
        $("#login").html(
          "<span class='text-danger fw-bold'>check your username or password</span>"
        );
      }
    });
    event.preventDefault();
  });

  $.ajax({
    type: "GET",
    url: "assets/php/authentication.php?islogin=1",
  }).done(function (data) {
    if (data == "0") {
      // nothing just waiting to login...
    } else {
      $("#login").html(
        data + "<span class='text-success fw-bold'> Your are signed in</span>"
      );
    }
  });
});
