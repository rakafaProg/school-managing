
// Validate Log-in Form

document.querySelector('.login-form .submit').addEventListener ('click', function(e){
  //e.preventDefault();

  let requiredInputs = document.querySelectorAll('.login-form input:required');
  let err = "";

  requiredInputs.forEach(function(inputElement){

    if (!inputElement.value){
      inputElement.classList.add('error');
      e.preventDefault();
      err = "Please fill all the required fields to log-in";
    }
    else {
      inputElement.classList.remove('error');
    }

  });

  // Display / Undisplay error massage for form validations
  document.getElementById('errorMsg').innerHTML = err;

});


// get all the required inputs in the form
var requiredInputs =  document.querySelectorAll('.login-form input:required');

// Remove Errors when user try to fix them...
requiredInputs.forEach(function(inputElement){
  inputElement.addEventListener('focus', e=>{
    e.srcElement.classList.remove('error');
    document.getElementById('errorMsg').innerHTML = "";
  });
});
