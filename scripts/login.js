import { validation } from "./Validation.js";
function validateSignupData(e) {
  let error = false;
  let form = document.getElementById("login-form");
  e.preventDefault();
  let username = document.getElementById("username").value;
  let password = document.getElementById("password").value;


  // username validation
  let userNameErrorStr = validation.usernameValidate(username);
  if(!error) error = userNameErrorStr.length > 0;
  document.getElementById("error-username").innerHTML = userNameErrorStr;

  // password validation
  let passwordErrorStr = validation.passwordValidate(password);
  if(!error) error = passwordErrorStr.length > 0;
  document.getElementById("error-password").innerHTML = passwordErrorStr;


  if (!error) form.submit();

}
document.getElementById("submit_btn").addEventListener("click",validateSignupData);