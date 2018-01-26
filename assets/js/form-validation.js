


document.querySelector('.login-form .btn').addEventListener ('click', function(e){

  // get all the required inputs in the form
  let requiredInputs = document.querySelectorAll('.login-form input:required');
  let err = "";

  requiredInputs.forEach(function(inputElement){

    if (!inputElement.value){
      inputElement.classList.add('input-error');
      e.preventDefault();
      err = "Please fill all the required fields to log-in";
    }
    else {
      inputElement.classList.remove('input-error');
    }

  });

  // Display / Undisplay error massage for form validations
  document.getElementById('errorMsg').innerHTML = err;

});
