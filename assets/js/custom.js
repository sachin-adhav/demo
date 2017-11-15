$( document ).ready(function() {
    
    $("#LoginButton").click(function() {
      $("ul.nav pull-right > dropdown").attr("class", "dropdown open");
      var url = $("#base_url").val();
      var email = $("#inputLoginEmail").val();
      var password = $("#inputLoginPassword").val();

      if(email == ""){
        $("ul.nav pull-right > dropdown").attr("class", "dropdown open");
        $("#LoginEmail_err").css("display", "block");
        $("#LoginEmail_err").html("Enter email");
        return false;
      }else if(password == ""){
        $("ul.nav pull-right > dropdown").attr("class", "dropdown open");
        $("#LoginPassword_err").css("display", "block");
        $("#LoginPassword_err").html("Enter password");
        return false;
      }else{
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: url+'home/signIn',
            data: {loginemail: email, loginpassword: password},
            success: function (result) {
              var data = result;
              console.log("Success :- "+data.success);
              if(data.error){
                if(data.error == "Record not found"){
                  $("#Loginerror_err").css("display", "block");
                  $("#Loginerror_err").html("Record not found");
                }else if(data.error == "Something went wrong"){
                  $("#Loginerror_err").css("display", "block");
                  $("#Loginerror_err").html("Something went wrong");
                }
              }else if(data.success == "Login Successfully"){
                window.location.href = url+"home/";
              } 
            },
            error: function (result) {
                console.log('An error occurred.');
                console.log(result);
            },
        });
      }
      
    });
});

function validateRegistrationForm(){
  var title = $("#title_id").val();
  var first_name = $("#inputFname").val();;
  var last_name = $("#inputLname").val();;
  var email = $("#inputEmail").val();;
  var password = $("#inputPassword").val();;
  
  if(title == ""){
  	$("#title_err").css("display", "block");
  	return false;
  }else{
  	$("#title_err").css("display", "none");
  }

  if(first_name == ""){
  	$("#fname_err").css("display", "block");
  	return false;
  }else{
  	$("#fname_err").css("display", "none");
  }

  if(last_name == ""){
  	$("#lname_err").css("display", "block");
  	return false;
  }else{
  	$("#lname_err").css("display", "none");
  }

  if(email == ""){
  	$("#email_err").css("display", "block");
  	return false;
  }else{
  	$("#email_err").css("display", "none");
  }

  if(password == ""){
  	$("#password_err").css("display", "block");
  	return false;
  }else{
  	$("#password_err").css("display", "none");
  }

}