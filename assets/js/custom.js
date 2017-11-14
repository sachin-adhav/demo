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